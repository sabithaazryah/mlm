<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
    .form-group {
        margin-bottom: 0px;
    }
</style>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="employee-create">
                        <?php
                        $form = ActiveForm::begin(
                                        [
                                            'id' => 'forgot-email',
                                            'method' => 'post',
                                            'options' => [
                                                'class' => 'login-form fade-in-effect'
                                            ]
                                        ]
                        );
                        ?>
                        <?php if (Yii::$app->session->hasFlash('success')):
                            ?>
                            <div class="alert alert-success" role="alert" style="padding: 8px;
                                 width: 100%;">
                                 <?= Yii::$app->session->getFlash('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-danger" role="alert" style="width: 100%;padding: 7px;">
                                <?= Yii::$app->session->getFlash('error') ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class = "form-group col-md-12">
                                <div class = "form-group field-adminusers-password" style="width: 100%">
                                    <label style = "font-weight:bold;">Enter old Password:</label>
                                    <input type = "password" id = "new-password" class = "form-control" name = "old-password" autofocus = "false" required>
                                    <p class = "help-block help-block-error"></p>
                                </div>

                            </div>

                            <div class = "form-group col-md-12">
                                <div class = "form-group field-adminusers-password" style="width: 100%">
                                    <label style = "font-weight:bold;">Enter new Password:</label>
                                    <input type = "password" id = "new-password" class = "form-control" name = "new-password" autofocus = "false" required>
                                    <p class = "help-block help-block-error"></p>
                                </div>

                            </div>
                            <div class = "form-group col-md-12">
                                <div class = "form-group field-adminusers-password" style="width: 100%">
                                    <label style = "font-weight:bold;">Confirm Password:</label>
                                    <input type = "password" id = "confirm-password" class = "form-control" name = "confirm-password" autofocus = "false" required>
                                    <p class = "help-block help-block-error"></p>
                                </div>

                            </div>
                        </div>

                        <div class = "form-group">
                            <button type = "submit" class = "btn btn-secondary" style="float:right;margin-top: 10px;">Submit</button>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>