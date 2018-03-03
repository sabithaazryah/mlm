<?php

namespace frontend\controllers;

use Yii;
use common\models\Employee;
use common\models\EmployeePackage;
use common\models\Products;
use yii\db\Expression;
use common\models\EmployeeTree;
use common\models\EmployeeDetails;
use common\models\ChangeMobile;

class EmployeeController extends \yii\web\Controller {

    public function actionCreate($id = NULL, $type = NULL) {

        Yii::$app->session['user-password'] = '';

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
            $epin = \common\models\PinRequestDetails::findOne($model->epin);
            $model->user_name = $epin->epin;
            $user_details->dob = date('Y-m-d', strtotime($user_details->dob));
            Yii::$app->session['user-password'] = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->status = 3;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save() && $user_details->save() && $this->PackageHistory($model, $epin)) {
                    $transaction->commit();
                    $epin->status = 3;
                    $epin->save();
                    return $this->redirect(['purchase', 'id' => $model->id]);
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
                    'placement_arr' => $placement_arr,]);
    }

    public function PackageHistory($model, $epin) {

        $package = \common\models\Packages::findOne($epin->package_id);
        $package_history = new EmployeePackage();
        $package_history->employee_id = $model->id;
        $package_history->package_id = $epin->package_id;
        $package_history->price = $package->amount;
        $package_history->bv = $package->bv;
        $package_history->package_date = date('Y-m-d');

        if ($package_history->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function actionPurchase($id = null) {
        $employee = Employee::findOne($id);
        $products = Products::find()->where(['status' => 1])->all();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $employee_id = Yii::$app->request->post('employee');
            $employee = Employee::findOne($employee_id);
            $employee->status = 1;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($this->Create($data, $employee_id) && $employee->save()) {
                    $package = EmployeePackage::find()->where(['employee_id' => $employee->id])->orderBy(['id' => SORT_DESC])->one();
                    $this->EmployeeTree($employee, $package);
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', 'Customer added successfully');
                    return $this->redirect(['tree']);
                } else {
                    die('else');
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', "There was a problem creating new userr. Please try again.");
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', "There was a problem creating new user. Please try again.");
            }
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
        if ($this->AddProductDetails($arr, $employee_id)) {
            return TRUE;
        } else {
            return False;
        }
    }

    public function AddProductDetails($arr, $employee_id) {
        $flag = 0;
        foreach ($arr as $val) {
            if ($val['qty'] != '' && $val['amount'] != '') {
                $model = new \common\models\EmployeeProducts();
                $model->employee_id = $employee_id;
                $model->product_id = $val['product'];
                $model->price = $val['price'];
                $model->qty = $val['qty'];
                $model->total_amount = $val['amount'];
                $model->total_bv = $val['bv'];
                if ($model->save()) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
        }

        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function sendMail($user) {
        if ($user->email != '') {
            $message = Yii::$app->mailer->compose('new-registration', ['model' => $user, 'user_password' => Yii::$app->session['user-password']])
                    ->setFrom('no-replay@smartway.in')
                    ->setTo($user->email)
                    ->setSubject('Registration successfull');
            $message->send();
            return TRUE;
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
            $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
            $emp_details = Employee::find()->where(['id' => $id])->one();
        } else {
            $emp_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        return $this->render('tree-view', [
                    'emp_details' => $emp_details,
        ]);
    }

    public function actionTreeSearch() {
        if (Yii::$app->request->post()) {
            $distributor = $_POST['distributor_name'];
            $emp = Employee::find()->where(['user_name' => $distributor])->one();
            if (!empty($emp)) {
                return $this->redirect(['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp->id)]);
            }
        } return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCron() {

        $users = EmployeeTree::find()->all();
        foreach ($users as $user) {
            if ($user->current_left_bv > $user->current_right_bv) {
                $bv_match = $user->current_right_bv;
                $user->current_left_bv = $user->current_left_bv - $user->current_right_bv;
                $user->current_right_bv = 0;
                $previou_wallet = $user->wallet;
                $user->wallet = $user->wallet + ($bv_match * 15);
            } else if ($user->current_right_bv > $user->current_left_bv) {
                $bv_match = $user->current_left_bv;
                $user->current_right_bv = $user->current_right_bv - $user->current_left_bv;
                $user->current_left_bv = 0;
                $previou_wallet = $user->wallet;
                $user->wallet = $user->wallet + ($bv_match * 15);
            } else if ($user->current_right_bv == $user->current_left_bv) {
                $bv_match = $user->current_left_bv;
                $user->current_right_bv = 0;
                $user->current_left_bv = 0;
                $previou_wallet = $user->wallet;
                $user->wallet = $user->wallet + ($bv_match * 15);
            }
            $user->save();
            if ($user->wallet > 0) {
                $wallet_history = new \common\models\WalletHistory();
                $wallet_history->employee_id = $user->employee_id;
                $wallet_history->match_bv = $bv_match;
                $wallet_history->previous_wallet_amount = $previou_wallet;
                $wallet_history->current_wallet_amount = $user->wallet;
                $wallet_history->date = date('Y-m-d');
                $wallet_history->save();
            }
        }
    }

    public function actionChangePassword() {
        $model = new \common\models\ChangePassword();
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('succes', 'Password changed successfully.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('change_password', [
                    'model' => $model,
                    'user' => $user,
        ]);
    }

    protected function findModel($id) {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangeMobileNo() {
        $model = new ChangeMobile();
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->mobile_number = $model->new_mobile_no;
            if ($user->save()) {
                $otp_data = \common\models\OtpRequest::find()->where(['customer_id' => Yii::$app->user->identity->id])->one();
                $otp_data->delete();
                Yii::$app->session->setFlash('succes', 'Mobile No  changed successfully.');
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('change_mobile_no', [
                    'model' => $model,
                    'user' => $user,
        ]);
    }

    public function actionGetOtp() {
        if (Yii::$app->request->isAjax) {
            $model = new \common\models\OtpRequest();
            $otp = $this->RandomOtp();
            $model->customer_id = Yii::$app->user->identity->id;
            $model->otp = $otp;
            $model->date = date('Y-m-d H:i:s');
            if ($model->save()) {
                return $model->otp;
            } else {
                return '';
            }
        }
    }

    /**
     * Generate Random E-PIN.
     */
    public function RandomOtp() {
        $digits = 5;
        $nrRand = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $otp = trim($nrRand);
        $otp_exist = \common\models\OtpRequest::find()->where(['otp' => $otp])->one();
        if (empty($otp_exist)) {
            return $otp;
        } else {
            return $this->RandomOtp();
        }
    }

}
