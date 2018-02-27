<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 20px; height: 36px; width:100px']) ?>
                </div>   </div>

        <?php ActiveForm::end(); ?>

</div>
