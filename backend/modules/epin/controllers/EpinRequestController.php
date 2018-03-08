<?php

namespace backend\modules\epin\controllers;

use Yii;
use common\models\EpinRequest;
use common\models\EpinRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PinRequestDetails;
use common\models\PinRequestDetailsSearch;

/**
 * EpinRequestController implements the CRUD actions for EpinRequest model.
 */
class EpinRequestController extends Controller {

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
         * Lists all EpinRequest models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new EpinRequestSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single EpinRequest model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $searchModel = new PinRequestDetailsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['master_id' => $id]);
//        $pin_details = PinRequestDetails::find()->where(['master_id' => $id])->all();
                return $this->render('view', [
                            'model' => $this->findModel($id),
//                    'pin_details' => $pin_details,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Creates a new EpinRequest model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new EpinRequest();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing EpinRequest model.
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
         * Deletes an existing EpinRequest model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
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
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        /**
         * Approve Pin request.
         */
        public function actionApprove($id) {
                $e_pin = $this->RandomEpin();
                $model = PinRequestDetails::findOne($id);
                if (!empty($model)) {
                    $model->approved_date = date('Y-m-d H:i:s');
                        $model->status = 1;
                        $model->epin = $e_pin;
                        $model->update();
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

        /**
         * Generate Random E-PIN.
         */
        public function RandomEpin() {
                $firstPart = 'ARM';
                $digits = 4;
                $nrRand = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $epin = trim($firstPart) . trim($nrRand);
                $epin_exist = PinRequestDetails::find()->where(['epin' => $epin])->one();
                if (empty($epin_exist)) {
                        return $epin;
                } else {
                        return $this->RandomEpin();
                }
        }

        /**
         * Reject Pin request.
         */
        public function actionReject($id) {
                $model = PinRequestDetails::findOne($id);
                if (!empty($model)) {
                        $model->status = 2;
                        $model->update();
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

}
