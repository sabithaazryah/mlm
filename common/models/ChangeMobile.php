<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangeMobile extends Model {

    public $old_mobile_no;
    public $new_mobile_no;
    public $otp;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['old_mobile_no', 'new_mobile_no', 'otp'], 'required'],
            ['old_mobile_no', 'validateMobileNo'],
            ['otp', 'validateOtp'],
        ];
    }

    public function validateOtp($attribute, $params) {
        if (!$this->hasErrors()) {
            $otp_data = OtpRequest::find()->where(['otp' => $this->otp,'id' => Yii::$app->user->identity->id])->one();
            if(empty($otp_data)){
                $this->addError($attribute, 'Incorrect OTP.');
            }
        }
    }
    
    public function validateMobileNo($attribute, $params) {
        if (!$this->hasErrors()) {
            $mobile_data = Employee::find()->where(['mobile_number' => $this->old_mobile_no,'id' => Yii::$app->user->identity->id])->one();
            if(empty($mobile_data)) {
                $this->addError($attribute, 'Incorrect old Mobile No.');
            } 
        }
    }
}
