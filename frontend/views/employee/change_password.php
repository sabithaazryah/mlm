<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid dashbord_content_wrapper">
    <div class="row">
        <div class="form_wrapper">
            <?= \common\widgets\Alert::widget(); ?>
            <?php
            $form = ActiveForm::begin();
            ?>
            <div class="form_header">
                <?= Html::encode($this->title) ?>
            </div>

            <div class="form_content">
                <div class="row">
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'password')->passwordInput()->label('Old Password *') ?>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'new_password')->passwordInput()->label('new_password *') ?>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'confirm_password')->passwordInput()->label('confirm_password *') ?>
                    </div>
                </div>
            </div>
            <div class="form_footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12 button-container">
                        <?= Html::submitButton('Reset Password', ['class' => 'btn-common btn-form', 'name' => 'login', 'style' => '']) ?>
                        <?= Html::a('Clear', ['/employee/change-password'], ['class' => 'btn-common btn-form']) ?>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>