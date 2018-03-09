<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login_container">
    <div class="login_wrapper_container">
        <div class="login_wrapper">
            <div class="left_wrapper">
                <h3>Forgot Password<span>Let us help you<br>Type your username / email ID in the field below to receive your validation code by email</span></h3>

                <div class="logo_wrapper"><img src="<?= Yii::$app->homeUrl; ?>dash/images/login-logo.png" alt="" class="img-responsive"></div>
            </div>

            <div class="right_wrapper">
                <div class="field_wrapper">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <div class="form-group field-employee-user_name">
                        <label class="control-label" for="employee-user_name">Enter User Name / Email</label>
                        <input type="text" id="employee-user_name" class="form-control" name="Employee[user_name]" autofocus="">

                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'button_wrapper btn-common', 'name' => 'login-button']) ?>
                    </div>
                    <div class="login_info">
                        <a href="<?= Yii::$app->homeUrl; ?>site/index">Login to your account ?</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
