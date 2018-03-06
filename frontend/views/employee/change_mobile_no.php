<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Mobile Number';
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
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-info" style="border-radius: 5px;float:right;font-weight: 600;" id="get-otp">GET OTP</button>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'old_mobile_no')->textInput()->label('Old Mobile No *') ?>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'new_mobile_no')->textInput()->label('New Mobile No *') ?>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'otp')->textInput()->label('OTP *') ?>
                    </div>
                </div>
            </div>
            <div class="form_footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12 button-container">
                        <?= Html::submitButton('Submit', ['class' => 'btn-common btn-form', 'name' => 'login', 'style' => '']) ?>
                        <?= Html::a('Clear', ['/employee/change-mobile-no'], ['class' => 'btn-common btn-form']) ?>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        /*
         * on blur function check member exist
         * return true if member exist otherwise show error message
         */

        $(document).on('click', '#get-otp', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {},
                url: '<?= Yii::$app->homeUrl; ?>employee/get-otp',
                success: function (data) {
                    if (data != '') {
                        alert('Your OTP Number is : ' + data);
                    }
                }
            });
        });
    });
</script>