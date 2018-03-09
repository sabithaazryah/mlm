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
use common\models\ProfileUploads;
use yii\web\UploadedFile;

class EmployeeController extends \yii\web\Controller {

        public $layout = '@app/views/layouts/dashboard';

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
                        $user_details->dob = date('Y-m-d', strtotime($user_details->dob));
                        Yii::$app->session['user-password'] = $model->password;
                        $model->password = Yii::$app->security->generatePasswordHash($model->password);
                        // $model->status = 3;
                        $model->status = 1;
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                if ($model->save() && $user_details->save() && $this->PackageHistory($model, $epin)) {
                                        $user_details->employee_id = $model->id;
                                        $user_details->save();
                                        $transaction->commit();
                                        $epin->status = 3;
                                        $epin->save();
                                        $model->user_name = 'ARM' . (sprintf('%05d', $model->id));
                                        $model->display_name = $model->user_name;
                                        $model->update();
                                       // $this->sendMail($model);
                                        $package = EmployeePackage::find()->where(['employee_id' => $model->id])->orderBy(['id' => SORT_DESC])->one();

                                        return $this->redirect(['genealogy-view']);
                                        //  return $this->redirect(['purchase', 'id' => $model->id]);
                                        
                                } else {
                                        $transaction->rollBack();
                                        Yii::$app->session->setFlash('error', "There was a problem creating new user. Please try again.");
                                }
                        } catch (Exception $e) {
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('error', "There was a problem creating new user. Please try again.");
                        }
                        // 
                        //  $this->EmployeeTree($model);
                }

                return $this->render('create', [
                            'model' => $model,
                            'user_details' => $user_details,
                            'placement_details' => $placement_details,
                            'placement_arr' => $placement_arr,]);
        }

        public function PackageHistory($model, $epin) {
                $flag = 0;
                $package = \common\models\Packages::findOne($epin->package_id);
                $package_history = new EmployeePackage();
                $package_history->employee_id = $model->id;
                $package_history->package_id = $epin->package_id;
                $package_history->price = $package->amount;
                $package_history->bv = $package->bv;
                $package_history->package_date = date('Y-m-d');

                if ($package_history->save()) {

                        if ($this->EmployeeTree($model, $package_history)) {

                                $flag = 1;
                        }
                }
                if ($flag == 1) {
                        return true;
                } else {
                        return false;
                }
        }

        public function EmployeeTree($model, $package) {
                $flag = 0;
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

                        if ($parent_details->save()) {
                                if ($this->PDV($model)) {
                                        if ($this->Cron()) {
                                                $flag = 1;
                                        }
                                }
                        }
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
                        // $parentemployee_tree->save();
                        if ($parentemployee_tree->save()) {

                                if ($this->PDV($model)) {

                                        if ($this->Cron()) {

                                                $flag = 1;
                                        }
                                }
                        }
                }

                \Yii::$app->db->createCommand("update employee_tree set left_child =  concat(left_child,',$model->id'), total_left_bv=total_left_bv + $package_details->bv,current_left_bv=current_left_bv + $package_details->bv   WHERE FIND_IN_SET('$model->placement_name', left_child)")->execute();
                \Yii::$app->db->createCommand("update employee_tree set right_child = concat(right_child,',$model->id'),total_right_bv=total_right_bv + $package_details->bv,current_right_bv=current_right_bv + $package_details->bv   WHERE FIND_IN_SET('$model->placement_name', right_child)")->execute();
                if ($flag == 1) {
                        return true;
                } else {
                        return false;
                }
        }

        public function PDV($model) {
                $flag = 0;
                if (isset($model->referal_id) && $model->referal_id != '') {
                        $referrer = Employee::find()->where(['user_name' => $model->referal_id])->one();
                } else {
                        $referrer = Employee::findOne($model->placement_name);
                }
                $package = EmployeePackage::find()->where(['employee_id' => $model->id])->one();
                $package_amount = \common\models\Packages::findOne($package->package_id)->amount;
                $tax = \common\models\Settings::findOne(5)->value;
                $service = \common\models\Settings::findOne(6)->value;
                if (!empty($referrer)) {
                        $commission = \common\models\Settings::findOne(2)->value;
                        $pdv_amount = ($package_amount * $commission) / 100;
                        $employee_wallet = EmployeeTree::find()->where(['employee_id' => $referrer->id])->one();
                        $previou_wallet = $employee_wallet->wallet;
                        $tax_amount = ($pdv_amount * $tax) / 100;
                        $service_amount = ($pdv_amount * $service) / 100;
                        $commission_sent = $pdv_amount - $tax_amount - $service_amount;
                        $employee_wallet->wallet = $employee_wallet->wallet + $commission_sent;
                        $employee_wallet->save();
                        if ($this->WalletHistory(2, $employee_wallet, $previou_wallet, $commission, 0, $tax_amount, 0, $service_amount, $pdv_amount))
                                $flag = 1;
                }
                if ($flag == 1) {
                        return true;
                } else {
                        return false;
                }
        }

        public function Cron() {

                $flag = 0;
                $users = EmployeeTree::find()->all();
                $bv_commission = \common\models\Settings::findOne(3)->value;
                $company_percent = \common\models\Settings::findOne(4)->value;
                $tax = \common\models\Settings::findOne(5)->value;
                $service = \common\models\Settings::findOne(6)->value;

                foreach ($users as $user) {
                        $bv_match = 0;
                        $bv_amount = 0;
                        $tax_amount = 0;
                        $service_amount = 0;
                        $user_wallet = 0;

                        if ($user->current_left_bv > $user->current_right_bv) {

                                if ($user->current_right_bv > 0) {
                                        
                                        $bv_match = $user->current_right_bv;
                                        $user->current_left_bv = $user->current_left_bv - $user->current_right_bv;
                                        $user->current_right_bv = 0;
                                        $previou_wallet = $user->wallet;
                                }
                        } else if ($user->current_right_bv > $user->current_left_bv) {
                                if ($user->current_left_bv > 0) {
                                       
                                        $bv_match = $user->current_left_bv;
                                        $user->current_right_bv = $user->current_right_bv - $user->current_left_bv;
                                        $user->current_left_bv = 0;
                                        $previou_wallet = $user->wallet;
                                }
                        } else if ($user->current_right_bv == $user->current_left_bv) {
                                if ($user->current_right_bv) {
                                        $bv_match = $user->current_left_bv;
                                        $user->current_right_bv = 0;
                                        $user->current_left_bv = 0;
                                        $previou_wallet = $user->wallet;
                                }
                        }

                        if ($bv_match > 0) {

                                $bv_amount = $bv_match * $bv_commission;
                                $company_commission = ($bv_amount * $company_percent) / 100;
                                $tax_amount = ($bv_amount * $tax) / 100;
                                $service_amount = ($bv_amount * $service) / 100;
                                $user_wallet = $bv_amount - $company_commission;

                                $user->wallet = $user->wallet + $user_wallet;

                                if ($user->save()) {

                                        if ($user_wallet > 0) {
                                                if ($this->WalletHistory(1, $user, $previou_wallet, $bv_match, $tax, $tax_amount, $service, $service_amount, 0, $bv_commission, $company_commission))
                                                        $flag = 1;
                                        }
                                }else {
                                        die('elseretr');
                                }
                        } else {
                                $flag = 1;
                        }
                }
                if ($flag == 1) {
                        return true;
                } else {
                        return false;
                }
        }

        public function WalletHistory($type, $user, $previou_wallet, $bv_match, $tax, $tax_amount, $service, $service_amount, $commision, $company = null, $company_amount = null) {

                $wallet_history = new \common\models\WalletHistory();
                $wallet_history->type = $type;
                $wallet_history->employee_id = $user->employee_id;
                $wallet_history->match_bv = $bv_match;
                $wallet_history->previous_wallet_amount = $previou_wallet;
                $wallet_history->current_wallet_amount = $user->wallet;
                $wallet_history->tax = $tax;
                $wallet_history->tax_amount = $tax_amount;
                $wallet_history->service_charge = $service;
                $wallet_history->service_charge_amount = $service_amount;
                $wallet_history->commision = $commision;
                $wallet_history->company = $company;
                $wallet_history->company_amount = $company_amount;
                $wallet_history->date = date('Y-m-d');
                if ($wallet_history->save()) {
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
                                if ($employee->save()) {
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
                if (!empty($create)) {
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
                                ->setFrom('no-replay@armnetlifestyle.com')
                                ->setTo($user->email)
                                ->setSubject('Registration successfull');
                        $message->send();
                        return TRUE;
                }
        }




        public function actionUpdate() {
                $id = \Yii::$app->user->id;
                $model = Employee::findOne($id);
                $model->setScenario('update');
                $user_details = EmployeeDetails::find()->where(['employee_id' => $id])->one();
                $user_details->setScenario('update');
                if ($model->load(Yii::$app->request->post()) && $model->validate() && $user_details->load(Yii::$app->request->post()) && $user_details->validate()) {
                        $user_details->dob = date('Y-m-d', strtotime($user_details->dob));
                        $model->save();
                        $user_details->save();
                        Yii::$app->session->setFlash('success', "Updated Successfully");
                }

                return $this->render('update', [
                            'model' => $model,
                            'user_details' => $user_details,
                ]);
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
                                return json_encode($data);
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

        public function actionGenealogyView($id = NULL) {
                if ($id != NULL) {
                        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                        $emp_details = Employee::find()->where(['id' => $id])->one();
                } else {
                        $emp_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
                }
                return $this->render('genealogy-view', [
                            'emp_details' => $emp_details,
                ]);
        }

        public function actionTreeSearch() {
                if (Yii::$app->request->post()) {
                        $distributor = $_POST['distributor_name'];
                        $emp = Employee::find()->where(['user_name' => $distributor])->one();
                        if (!empty($emp)) {
                                return $this->redirect(['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp->id)]);
                        }
                } return $this->redirect(Yii::$app->request->referrer);
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
                        echo'hai';
                        exit;
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

        public function actionUploadKyc() {
                $file_exist = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 4])->one();
                if (empty($file_exist)) {
                        $model = new ProfileUploads();
                } else {
                        $model = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 4])->one();
                }
                $model->setScenario('kycupload');
                if ($model->load(Yii::$app->request->post())) {
                        $model->customer_id = Yii::$app->user->identity->id;
                        $model->type = 4;
                        $files = UploadedFile::getInstance($model, 'photo');
                        if (!empty($files)) {
                                $model->photo = $files->extension;
                        }
                        if ($model->validate() && $model->save()) {
                                if (!empty($files)) {
                                        $path = Yii::$app->basePath . '/../uploads/profile_uploads/kyc_document/';
                                        $this->upload($model, $files, $path);
                                }
                                Yii::$app->session->setFlash('succes', 'KYC Document Upload successfully.');
                        }
                        return $this->redirect(Yii::$app->request->referrer);
                }
                return $this->render('upload_kyc', [
                            'model' => $model,
                ]);
        }

        /**
         * Upload Material photos.
         * @return mixed
         */
        public function Upload($model, $files, $path) {
                if (isset($files) && !empty($files)) {
                        $files->saveAs($path . $model->id . '.' . $files->extension);
                }
                return TRUE;
        }

        public function actionCheckMemberExist() {
                $data = 0;
                if (Yii::$app->request->isAjax) {
                        $member_id = $_POST['member_id'];
                        $member_exist = Employee::find()->where(['user_name' => $member_id])->one();
                        if (!empty($member_exist)) {
                                $data = 1;
                        }
                }
                return $data;
        }

        public function actionWallet() {
                  $id = Yii::$app->user->id;
                $employee = Employee::findOne($id);
                $employee_package = EmployeePackage::find()->where(['employee_id' => $id])->one();
                $employee_wallet = EmployeeTree::find()->where(['employee_id' => $id])->one();
                $commission_amount = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 2])->sum('commision');
                $commission_tax_amount = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 2])->sum('tax_amount');
                $commission_service_amount = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 2])->sum('service_charge_amount');
                $service_charge = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 1])->sum('service_charge_amount');
                $tax = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 1])->sum('tax_amount');
                $user_bv_matched = \common\models\WalletHistory::find()->where(['employee_id' => $id, 'type' => 1])->all();
                $matched_amount = 0;
                foreach ($user_bv_matched as $value) {
                        $deducted_amount = 0;
                        $matchamount = $value->current_wallet_amount - $value->previous_wallet_amount;
                        $deducted_amount = $matchamount + $value->company_amount;
                        $matched_amount += $deducted_amount;
                }
                return $this->render('wallet', [
                            'employee' => $employee, 'employee_wallet' => $employee_wallet, 'commission_amount' => $commission_amount, 'service_charge' => $service_charge,
                            'matched_amount' => $matched_amount, 'tax' => $tax, 'commission_tax_amount' => $commission_tax_amount, 'commission_service_amount' => $commission_service_amount,
                ]);
        }
        
        public function actionWalletHistory() {

        $searchModel = new \common\models\WalletHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['employee_id' => Yii::$app->user->identity->id]);

        return $this->render('wallet-history', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
        
   

}
