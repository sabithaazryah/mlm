<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
USE common\models\Employee;
use common\models\EmployeePackage;
Use common\models\ProfileUploads;
use yii\web\UploadedFile;

class DashboardController extends \yii\web\Controller {

    public $layout = '@app/views/layouts/dashboard';

    public function actionIndex() {
        $profile_exist = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 1])->one();
        if (empty($profile_exist)) {
            $model_profile = new ProfileUploads();
        } else {
            $model_profile = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 1])->one();
        }
        $pan_exist = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 2])->one();
        if (empty($pan_exist)) {
            $model_pan = new ProfileUploads();
        } else {
            $model_pan = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 2])->one();
        }
        $bank_exist = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 3])->one();
        if (empty($bank_exist)) {
            $model_bank = new ProfileUploads();
        } else {
            $model_bank = ProfileUploads::find()->where(['customer_id' => Yii::$app->user->identity->id, 'type' => 3])->one();
        }
        $model_profile->setScenario('create');
        $model_pan->setScenario('create');
        $model_bank->setScenario('create');
        $employee = Employee::findOne(Yii::$app->user->identity->id);
        $employee_details = \common\models\EmployeeDetails::find()->where(['employee_id' => Yii::$app->user->identity->id])->one();
        $employee_package = \common\models\EmployeePackage::find()->where(['employee_id' => Yii::$app->user->identity->id])->one();
        if (isset($_POST['profile-button'])) {
            $files = UploadedFile::getInstance($model_profile, 'photo');
            $this->UploadImages($model_profile, 1, $files);
        }
        if (isset($_POST['pan-button'])) {
            $files = UploadedFile::getInstance($model_pan, 'photo');
            $this->UploadImages($model_pan, 2, $files);
        }
        if (isset($_POST['bank-button'])) {
            $files = UploadedFile::getInstance($model_bank, 'photo');
            $this->UploadImages($model_bank, 3, $files);
        }
        return $this->render('index', [
                    'employee' => $employee,
                    'employee_details' => $employee_details,
                    'employee_package' => $employee_package,
                    'model_pan' => $model_pan,
                    'model_bank' => $model_bank,
                    'model_profile' => $model_profile,
        ]);
    }

    public function UploadImages($model, $type, $files) {
        $model->type = $type;
        $model->customer_id = Yii::$app->user->identity->id;
        if (!empty($files)) {
            $model->photo = $files->extension;
        }
        if ($type == 1) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/profile_picture/';
        } elseif ($type == 2) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/pancard/';
        } elseif ($type == 3) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/bank_details/';
        }
        if ($model->save()) {
            if (!empty($files)) {
                $this->upload($model, $files, $path);
            }
        }
        return TRUE;
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

}
