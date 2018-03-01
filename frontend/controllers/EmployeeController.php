<?php

namespace frontend\controllers;

use Yii;
use common\models\Employee;
use common\models\EmployeePackage;
use common\models\Products;

class EmployeeController extends \yii\web\Controller {

    public function actionCreate($id = NULL, $type = NULL) {
        if ($type == 1) {
            $placement_arr = array('1' => 'Right');
        } elseif ($type == 2) {
            $placement_arr = array('2' => 'Left');
        } else {
            $placement_arr = array('1' => 'Right', '2' => 'Left');
        }
        if ($id != '') {
            $placement_details = Employee::find()->where(['id' => $id])->one();
        } else {
            $placement_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        $model = new Employee();
        $package_history = new EmployeePackage();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $epin = \common\models\PinRequestDetails::findOne($model->epin);
            $model->user_name = $epin->epin;
            $model->dob = date('Y-m-d', strtotime($model->dob));
            $not_encrypted_password = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save()) {
                $epin->epin_status = 1;
                $epin->save();
                $package_history->employee_id = $model->id;
                $package_history->package_id = $epin->package_id;
                $package_history->package_date = date('Y-m-d');
                $package_history->save();
                $this->sendMail($model, $not_encrypted_password);
                return $this->redirect(['purchase', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'placement_details' => $placement_details,
                    'placement_arr' => $placement_arr,
                        ]
        );
    }

    public function actionPurchase($id = null) {
        $employee = Employee::findOne($id);
        $products = Products::find()->where(['status' => 1])->all();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $employee_id = Yii::$app->request->post('employee');
            $this->Create($data, $employee_id);
            Yii::$app->getSession()->setFlash('success', 'Customer added successfully');

            return $this->redirect('create');
        }
        return $this->render('products', ['model' => $products, 'employee' => $id, 'employee_data' => $employee]);
    }

    public function Create($data, $employee_id) {

        $arr = [];
        $create = $data['create'];
        $i = 0;

        foreach ($create['product'] as $val) {
            $arr[$i]['product'] = $val;
            $i++;
        }

        $i = 0;
        foreach ($create['price'] as $val) {
            $arr[$i]['price'] = $val;
            $i++;
        }

        $i = 0;
        foreach ($create['qty'] as $val) {
            $arr[$i]['qty'] = $val;
            $i++;
        }

        $i = 0;
        foreach ($create['amount'] as $val) {
            $arr[$i]['amount'] = $val;
            $i++;
        }

        $i = 0;
        foreach ($create['bv'] as $val) {
            $arr[$i]['bv'] = $val;
            $i++;
        }
        $this->AddProductDetails($arr, $employee_id);
    }

    public function AddProductDetails($arr, $employee_id) {
        foreach ($arr as $val) {
            if ($val['qty'] != '' && $val['amount'] != '') {
                $model = new \common\models\EmployeeProducts();
                $model->employee_id = $employee_id;
                $model->product_id = $val['product'];
                $model->price = $val['price'];
                $model->qty = $val['qty'];
                $model->total_amount = $val['amount'];
                $model->total_bv = $val['bv'];
                $model->save();
            }
        }
    }

    public function sendMail($user, $not_encrypted_password) {
        if ($user->email != '') {
            $message = Yii::$app->mailer->compose('new-registration', ['model' => $user, 'user_password' => $not_encrypted_password])
                    ->setFrom('no-replay@smartway.in')
                    ->setTo($user->email)
                    ->setSubject('Registration successfull');
            $message->send();
            return TRUE;
        }
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

    public function actionProductDetails() {
        if (Yii::$app->request->isAjax) {
            $product = Yii::$app->request->post('product');
            $qty = Yii::$app->request->post('qty');
            $product_details = Products::findOne($product);
            if (!empty($product_details)) {
                $total_amount = $product_details->price * $qty;
                $total_bv = $product_details->bv * $qty;
                $data = ['amount' => $total_amount, 'bv' => $total_bv];
                echo json_encode($data);
            }
        }
    }

    public function actionTree($id = NULL) {
        if ($id != NULL) {
            $emp_details = Employee::find()->where(['id' => $id])->one();
        } else {
            $emp_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        return $this->render('tree-view', [
                    'emp_details' => $emp_details,
        ]);
    }

}
