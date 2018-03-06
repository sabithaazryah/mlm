<?php

namespace backend\modules\employee\controllers;

use Yii;
use common\models\Employee;
use common\models\EmployeeDetails;
use common\models\EmployeeTree;
use common\models\EmployeePackage;
use common\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = NULL, $type = NULL) {
        if ($id != '') {
            $type = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $type);
        }

        if ($type == 1) {
            $placement_arr = array('1' => 'Right');
        } elseif ($type == 2) {
            $placement_arr = array('2' => 'Left');
        } else {
            $placement_arr = array('1' => 'Right', '2' => 'Left');
        }

        if ($id != '') {
            $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
            $placement_details = Employee::find()->where(['id' => $id])->one();
        } else {
            $placement_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }

        $model = new Employee();
        $user_details = new EmployeeDetails();
        $model->setScenario('create');
        $user_details->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $user_details->load(Yii::$app->request->post()) && $user_details->validate() && Yii::$app->SetValues->Attributes($model)) {
            $epin = \common\models\Packages::findOne($model->epin);
            $user_details->dob = date('Y-m-d', strtotime($user_details->dob));
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->status = 3;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save() && $user_details->save() && $this->PackageHistory($model)) {
                    $user_details->employee_id = $model->id;
                    $user_details->save();
                    $transaction->commit();
                    $epin->status = 3;
                    $epin->save();
                    $model->user_name = 'MLM' . (sprintf('%05d', $model->id));
                    $model->display_name = $model->user_name;
                    $model->save();
                    $package = EmployeePackage::find()->where(['employee_id' => $model->id])->orderBy(['id' => SORT_DESC])->one();
                    $this->EmployeeTree($model, $package);
                    return $this->redirect(['treeview/tree-structure/index']);
                    //  return $this->redirect(['purchase', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', "There was a problem creating new user. Please try again.");
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', "There was a problem creating new user. Please try again.");
            }
            // $this->sendMail($model);
            //  $this->EmployeeTree($model);
        }
        return $this->render('create', [
                    'model' => $model,
                    'user_details' => $user_details,
                    'placement_details' => $placement_details,
                    'placement_arr' => $placement_arr,
        ]);
    }

    public function PackageHistory($model) {

        $package = \common\models\Packages::findOne($epin->package_id);
        $package_history = new EmployeePackage();
        $package_history->employee_id = $model->id;
        $package_history->package_id = $model->epin;
        $package_history->price = $package->amount;
        $package_history->bv = $package->bv;
        $package_history->package_date = date('Y-m-d');

        if ($package_history->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function EmployeeTree($model, $package) {
        $package_details = \common\models\Packages::findOne($package->package_id);

        $employee_tree = new EmployeeTree;
        $employee_tree->employee_id = $model->id;
        $employee_tree->save();

        $parent_details = EmployeeTree::find()->where(['employee_id' => $model->placement_name])->one(); /* new employee parent row exists */
        if (!empty($parent_details)) {
            if ($model->placement == 1) { /* if new employee is parent right child */
                $parent_details->right_child = $parent_details->right_child . ',' . $model->id;
                $parent_details->total_right_bv = $parent_details->total_right_bv + $package_details->bv;
                $parent_details->current_right_bv = $parent_details->current_right_bv + $package_details->bv;
            } else if ($model->placement == 2) { /* left child */
                $parent_details->left_child = $parent_details->left_child . ',' . $model->id;
                $parent_details->total_left_bv = $parent_details->total_left_bv + $package_details->bv;
                $parent_details->current_left_bv = $parent_details->current_left_bv + $package_details->bv;
            }
            $parent_details->save();
        } else {

            $parentemployee_tree = new EmployeeTree;
            $parentemployee_tree->employee_id = $model->placement_name;
            if ($model->placement == 1) {
                $parentemployee_tree->right_child = $model->id;
                $parentemployee_tree->total_right_bv = $parentemployee_tree->total_right_bv + $package_details->bv;
                $parentemployee_tree->current_right_bv = $parentemployee_tree->current_right_bv + $package_details->bv;
            } else if ($model->placement == 2) {
                $parentemployee_tree->left_child = $model->id;
                $parentemployee_tree->total_left_bv = $parentemployee_tree->total_left_bv + $package_details->bv;
                $parentemployee_tree->current_left_bv = $parentemployee_tree->current_left_bv + $package_details->bv;
            }
            $parentemployee_tree->save();
        }

        \Yii::$app->db->createCommand("update employee_tree set left_child =  concat(left_child,',$model->id'), total_left_bv=total_left_bv + $package_details->bv,current_left_bv=current_left_bv + $package_details->bv   WHERE FIND_IN_SET('$model->placement_name', left_child)")->execute();
        \Yii::$app->db->createCommand("update employee_tree set right_child = concat(right_child,',$model->id'),total_right_bv=total_right_bv + $package_details->bv,current_right_bv=current_right_bv + $package_details->bv   WHERE FIND_IN_SET('$model->placement_name', right_child)")->execute();
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

//        public function actionBvget() {
//                $model = new \common\models\EmployeeTree;
//                if ($model->load(Yii::$app->request->post())) {
//                        $parents= \common\models\EmployeeTree::find()->where([''])
//                }
//
//                return $this->render('bv_get', [
//                            'model' => $model,
//                ]);
//        }
}
