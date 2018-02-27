<?php

namespace frontend\controllers;

use Yii;
use common\models\Employee;

class EmployeeController extends \yii\web\Controller {

        public function actionCreate() {
                $model = new Employee();
                $model->setScenario('create');
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $epin = \common\models\PinRequestDetails::findOne($model->epin);
                        $model->user_name = $epin->epin;
                        $model->dob = date('Y-m-d', strtotime($model->dob));
                        $model->password = Yii::$app->security->generatePasswordHash($model->password);
                        if ($model->save()) {
                                $epin->epin_status = 1;
                                $epin->save();
                                return $this->redirect(['purahse', 'id' => $model->id]);
                        }
                }

                return $this->render('create', ['model' => $model]);
        }

        public function actionPurchase($id = null) {
                die('dds');
        }

        public function actionEmployeeid() {
                if (Yii::$app->request->isAjax) {
                        $employee_id = Yii::$app->request->post('employee');
                        $employee_details = Employee::findOne($employee_id);
                        if (!empty($employee_details)) {
                                echo $employee_details->user_name;
                        }
                }
        }

        public function actionEpin() {
                if (Yii::$app->request->isAjax) {
                        $epin = Yii::$app->request->post('epin');
                        $epin_details = \common\models\PinRequestDetails::findOne($epin);
                        $package_detail = \common\models\Packages::findOne($epin_details->package_id);
                        if (!empty($package_detail)) {
                                $data = ['amount' => $package_detail->amount, 'bv' => $package_detail->bv];
                                echo json_encode($data);
                        }
                }
        }

}
