<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\BankDetails;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epin-request-form">
    <?= \common\widgets\Alert::widget(); ?>
    <?php $form = ActiveForm::begin(['id' => 'epin-submit']); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'amount_deposited')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php $banks = ArrayHelper::map(BankDetails::findAll(['status' => 1]), 'id', 'bank_name'); ?>
            <?= $form->field($model, 'bank_name')->dropDownList($banks, ['prompt' => '-Choose a Bank-']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList(['1' => 'RTGS', '2' => 'NEFT', '3' => 'Cash Deposit', '4' => 'IMPS']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php
            $numbers = Yii::$app->SetValues->Number();
            ?>
            <?= $form->field($model, 'number_of_pin')->dropDownList($numbers, ['prompt' => '- select -']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'slip')->fileInput() ?>
        </div>
    </div>
    <div class="row" id="package-details-content" style="margin-bottom: 15px;">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function () {

        /*
         * on change of number of packages
         * return number of select input for add package details
         */

        $(document).on('change', '#epinrequest-number_of_pin', function (e) {
            var deposit_amount = $('#epinrequest-amount_deposited').val();
            var no_of_pin = $(this).val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {deposit_amount: deposit_amount, no_of_pin: no_of_pin},
                url: '<?= Yii::$app->homeUrl; ?>epin-request/add-package-details',
                success: function (data) {
                    $("#package-details-content").html(data);
                }
            });
        });

        /*
         * on change of packages set amount to data-val attribute
         */

        $(document).on('change', '.package-detail', function (e) {
            var current_id = $(this).attr('id');
            var data_val = $('option:selected', this).attr('data-val');
            $('#' + current_id).attr('data-amount', data_val);
        });

        /*
         * on submit of form check deposited amount and packages selected
         */

        $(document).on('submit', '#epin-submit', function (e) {
            var deposit_amount = $('#epinrequest-amount_deposited').val();
            var no_of_pin = $('#epinrequest-number_of_pin').val();
            var tot_amount = 0;
            for (i = 1; i <= no_of_pin; i++) {
                var amt = parseFloat($('#package-' + i).attr('data-amount'));
                tot_amount = tot_amount + amt;
            }
            if (tot_amount > deposit_amount) {
                alert('Package amount and deposited amount does not match.')
                return false;
            } else {
                return true;
            }
        });

    });
</script>
