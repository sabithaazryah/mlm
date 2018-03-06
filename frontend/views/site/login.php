<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login_container">
    <div class="login_wrapper_container">
        <div class="login_wrapper">
            <div class="left_wrapper">
                <h3>Sign In <span>Armnet Lifestyle sign in to access your account</span></h3>

                <div class="logo_wrapper"><img src="<?= Yii::$app->homeUrl; ?>dash/images/login-logo.png" alt="" class="img-responsive"></div>
            </div>

            <div class="right_wrapper">
                <div class="field_wrapper">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'user_name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>




                    <div class="form-group">
                        <?= Html::submitButton('LOGIN', ['class' => 'button_wrapper btn-common', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
