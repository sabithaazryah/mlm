<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Packages;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <h5 class="title-caption">Registration Details</h5>

        
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'> 
                        <div class="form-group field-employee-placement_name">
                            <label class="control-label" for="employee-placement_name">Placement Name *</label>
                            <input type="hidden" id="employee-placement_name" class="form-control" name="Employee[placement_name]" aria-required="true" aria-invalid="true" value="<?= $placement_details->id ?>">
                            <input type="text" id="" class="form-control" name="" aria-required="true" aria-invalid="true" value="<?= $placement_details->distributor_name ?>" readonly>
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>     <?= $form->field($model, 'placement_id')->textInput(['readonly' => true, 'value' => $placement_details->user_name])->label('Placement ID *') ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'distributor_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'placement')->dropDownList($placement_arr)->label('Placement *') ?>
        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'> 
            <?php
            $packages = Packages::find()->where(['status' => 1])->all();
            ?>
            <?= $form->field($model, 'epin')->dropDownList(\yii\helpers\ArrayHelper::map($packages, 'id', 'name'), ['prompt' => '--Select--']) ?>

        </div>
    </div>
    <div class="row">
        <h5 class="title-caption">Personal Information</h5>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'father_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?php
            if (isset($model->dob)) {
                $user_details->dob = date('d-m-Y', strtotime($user_details->dob));
            }
            ?>

            <?=
            DatePicker::widget([
                'model' => $user_details,
                'form' => $form,
                'type' => DatePicker::TYPE_INPUT,
                'attribute' => 'dob',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',
                ]
            ]);
            ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'gender')->dropDownList(['1' => 'Male', '2' => 'Female']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">

        <h5 class="title-caption">Detailed Address</h5>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'pincode')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'post_office')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'state')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'house_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'taluk')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'address')->textarea(['rows' => 5]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">

        <h5 class="title-caption">Nominee Details</h5>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'nominee_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($user_details, 'nominee_relation')->dropDownList(['' => '--Select--', '1' => 'Brother', '2' => 'Daughter', '3' => 'Father', '4' => 'Husband', '5' => 'Mother', '6' => 'Son', '7' => 'Sister', '8' => 'Wife']) ?>

        </div>

    </div>
    <div class="row">

        <h5 class="title-caption">Bank Details</h5>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'ifsc_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'account_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($user_details, 'pan_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

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
