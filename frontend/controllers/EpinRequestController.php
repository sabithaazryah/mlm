<?php

namespace frontend\controllers;

use Yii;
use common\models\EpinRequest;
use common\models\EpinRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Packages;
use common\models\PinRequestDetails;
use common\models\EpinTransfer;

/**
 * EpinRequestController implements the CRUD actions for EpinRequest model.
 */
class EpinRequestController extends Controller {

    public $layout = '@app/views/layouts/dashboard';

    /**
     * {@inheritdoc}
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
     * Lists all EpinRequest models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EpinRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 3;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EpinRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EpinRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EpinRequest();

        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $files = UploadedFile::getInstance($model, 'slip');
            if (!empty($files)) {
                $model->slip = $files->extension;
            }
            $model->customer_id = Yii::$app->user->id;
            if ($model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->save() && $this->SaveDetails($model, $data)) {
                        $transaction->commit();
                        if (!empty($files)) {
                            $this->upload($model, $files);
                        }
                        Yii::$app->session->setFlash('success', "New E-PIN Request Send Successfully");
                        $model = new EpinRequest();
                    } else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "There was a problem creating new invoice. Please try again.");
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', "There was a problem creating new invoice. Please try again.");
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Save Pin request details for each pin.
     * @return mixed
     */
    public function SaveDetails($model, $data) {
        $flag = 0;
        foreach ($data['package'] as $value) {
            $pin_details = new PinRequestDetails();
            $pin_details->master_id = $model->id;
            $pin_details->parent_id = $model->customer_id;
            $pin_details->package_id = $value;
            if ($pin_details->save()) {
                $flag = 1;
            } else {
                $flag = 0;
            }
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Upload Material photos.
     * @return mixed
     */
    public function Upload($model, $files) {
        if (isset($files) && !empty($files)) {
            $files->saveAs(Yii::$app->basePath . '/../uploads/pin_request_document/' . $model->id . '.' . $files->extension);
        }
        return TRUE;
    }

    /**
     * Updates an existing EpinRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EpinRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EpinRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EpinRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EpinRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddPackageDetails() {
        $data = '';
        if (Yii::$app->request->isAjax) {
            $deposit_amount = $_POST['deposit_amount'];
            $number_of_pin = $_POST['no_of_pin'];
            $packages = Packages::find()->all();
            $data = $this->renderPartial('_form_packages', [
                'number_of_pin' => $number_of_pin,
                'packages' => $packages,
            ]);
        }
        return $data;
    }

    public function actionEpinTransfer() {
        $model = new EpinTransfer();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->transfer_from = Yii::$app->user->id;
            $old_pindetails = PinRequestDetails::find()->where(['epin' => $model->epin, 'parent_id' => $model->transfer_from])->one();
            $model->epin_details_id = $old_pindetails->id;
            $model->DOC = date('Y-m-d');
            if ($this->CheckExist($model)) {
                $transfer_person = \common\models\Employee::find()->where(['user_name' => $model->member_id])->one();
                $model->transfer_to = $transfer_person->id;
                $old_pindetails->parent_id = $transfer_person->id;
                $old_pindetails->transer_id = Yii::$app->user->id;
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->save() && $old_pindetails->update()) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Pin Transfered Successfully");
                        $model = new EpinTransfer();
                    } else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "There was a problem transfer pin. Please try again.");
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', "There was a problem transfer pin. Please try again.");
                }
            } else {
                Yii::$app->session->setFlash('error', "This member does not exist.");
            }
        }
        return $this->render('_form_transfer', [
                    'model' => $model,
        ]);
    }

    public function CheckExist($model) {
        $member_exist = \common\models\Employee::find()->where(['user_name' => $model->member_id])->one();
        if (!empty($member_exist)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function actionCheckMemberExist() {
        $data = 0;
        if (Yii::$app->request->isAjax) {
            $member_id = $_POST['member_id'];
            $member_exist = \common\models\Employee::find()->where(['user_name' => $member_id])->one();
            if (!empty($member_exist)) {
                $data = 1;
            }
        }
        return $data;
    }

}
