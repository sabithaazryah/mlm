<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'placement_name') ?>

    <?= $form->field($model, 'placement_id') ?>

    <?= $form->field($model, 'distributor_name') ?>

    <?= $form->field($model, 'placement') ?>

    <?php // echo $form->field($model, 'epin') ?>

    <?php // echo $form->field($model, 'epin_number') ?>

    <?php // echo $form->field($model, 'pin_price') ?>

    <?php // echo $form->field($model, 'bv') ?>

    <?php // echo $form->field($model, 'referal_id') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'post_office') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'house_name') ?>

    <?php // echo $form->field($model, 'taluk') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'nominee_name') ?>

    <?php // echo $form->field($model, 'nominee_relation') ?>

    <?php // echo $form->field($model, 'ifsc_code') ?>

    <?php // echo $form->field($model, 'account_no') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'branch') ?>

    <?php // echo $form->field($model, 'pan_number') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'user_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
