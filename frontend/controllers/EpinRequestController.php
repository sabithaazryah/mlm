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

/**
 * EpinRequestController implements the CRUD actions for EpinRequest model.
 */
class EpinRequestController extends Controller {

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
                if (Yii::$app->request->isAjax) {
                        $deposit_amount = $_POST['deposit_amount'];
                        $number_of_pin = $_POST['no_of_pin'];
                        $packages = Packages::find()->all();
                        $data = $this->renderPartial('_form_packages', [
                            'number_of_pin' => $number_of_pin,
                            'packages' => $packages,
                        ]);
                        echo $data;
                }
        }

}
