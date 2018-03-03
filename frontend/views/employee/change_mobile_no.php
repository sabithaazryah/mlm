<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Mobile Number';
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row" style="margin-top: 90px;">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?php // Html::a('<i class="fa-th-list"></i><span> Manage Admin Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                <div class="panel-body">
                    <div class="employee-create">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php
                        $form = ActiveForm::begin(
                                        [
                                            'id' => 'change mobile no',
                                            'method' => 'post',
                                            'options' => [
                                                'class' => 'login-form fade-in-effect'
                                            ]
                                        ]
                        );
                        ?><button class="btn btn-info" style="border-radius: 5px;float:right;" id="get-otp">GET OTP</button>
                        <?= $form->field($model, 'old_mobile_no')->textInput() ?>

                        <?= $form->field($model, 'new_mobile_no')->textInput() ?>

                        <?= $form->field($model, 'otp')->textInput()->label('OTP') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'float:right;']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<script>
    $(document).ready(function () {

        /*
         * on blur function check member exist
         * return true if member exist otherwise show error message
         */

        $(document).on('click', '#get-otp', function (e) {
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