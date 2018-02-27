<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">

                <h5 class="title-caption">Registration Details</h5>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'placement_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'placement_id')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'distributor_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'placement')->dropDownList(['1' => 'Right', '2' => 'Left']) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'epin')->textInput() ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pin_price')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'referal_id')->textInput() ?>

                </div>
        </div>
        <div class="row">
                <h5 class="title-caption">Personal Information</h5>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (isset($model->dob)) {
                                $model->dob = date('d-m-Y', strtotime($model->dob));
                        }
                        ?>

                        <?=
                        DatePicker::widget([
                            'model' => $model,
                            'form' => $form,
                            'type' => DatePicker::TYPE_INPUT,
                            'attribute' => 'dob',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['1' => 'Male', '2' => 'Female']) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

                </div>
        </div>
        <div class="row">

                <h5 class="title-caption">Detailed Address</h5>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput() ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'post_office')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'state')->textInput() ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'house_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'taluk')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 5]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div>
        </div>
        <div class="row">

                <h5 class="title-caption">Nominee Details</h5>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nominee_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'nominee_relation')->dropDownList(['' => '--Select--', '1' => 'Brother', '2' => 'Daughter', '3' => 'Father', '4' => 'Husband', '5' => 'Mother', '6' => 'Son', '7' => 'Sister', '8' => 'Wife']) ?>

                </div>

        </div>
        <div class="row">

                <h5 class="title-caption">Bank Details</h5>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'ifsc_code')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pan_number')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '2' => 'Disabled']) ?>

                </div>    </div>
        <div class="row">
                <div class='col-md-12 col-sm-12 col-xs-12'>
                        <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
                        </div>
                </div>
        </div>
        <?php ActiveForm::end(); ?>

</div>
