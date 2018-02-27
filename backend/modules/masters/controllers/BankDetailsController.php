<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\BankDetails;
use common\models\BankDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankDetailsController implements the CRUD actions for BankDetails model.
 */
class BankDetailsController extends Controller {

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
     * Lists all BankDetails models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BankDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BankDetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BankDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new BankDetails();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Bank Details Added Successfully');
            return $this->redirect(['index']);
        }
        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing BankDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Bank Details Updated Successfully');
            return $this->redirect(['index']);
        }
        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BankDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BankDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BankDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BankDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
