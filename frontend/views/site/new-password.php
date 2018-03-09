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
                <h3>Forgot Password<span>Dear user, Please Enter Your New Password!</span></h3>

                <div class="logo_wrapper"><img src="<?= Yii::$app->homeUrl; ?>dash/images/login-logo.png" alt="" class="img-responsive"></div>
            </div>

            <div class="right_wrapper">
                <div class="field_wrapper">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <div class="form-group">
                        <div class="form-group field-employee-password">
                            <label class="control-label" for="new-password">new Password</label>
                            <input type="password" id="new-password" class="form-control" name="new-password" autofocus="false" required>
                            <p class="help-block help-block-error"></p>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-group field-employee-password">
                            <label class="control-label" for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password" autofocus="false" required>
                            <p class="help-block help-block-error"></p>
                        </div>

                    </div>
                    <div style="font-size: 12px;
                         color: hsla(0, 100%, 50%, 0.81);">

                        <?= Yii::$app->session->getFlash('error'); ?>
                        <?= Yii::$app->session->getFlash('success'); ?>
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
