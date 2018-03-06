<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PinRequestDetails;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */

$this->title = 'Pin Transfer';
$this->params['breadcrumbs'][] = ['label' => 'Epin Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid dashbord_content_wrapper">
    <div class="row">
        <div class="form_wrapper">
            <?php
            $form = ActiveForm::begin();
            ?>
            <div class="form_header">
                <?= Html::encode($this->title) ?>
            </div>

            <div class="form_content">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'member_id')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'transfer_from')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->id])->label(FALSE) ?>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <?php $e_pins = ArrayHelper::map(PinRequestDetails::findAll(['status' => 1, 'parent_id' => Yii::$app->user->id]), 'epin', 'epin'); ?>
                        <?= $form->field($model, 'epin')->dropDownList($e_pins, ['prompt' => 'Choose a E-Pin']) ?>
                    </div>
                </div>
            </div>
            <div class="form_footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12 button-container">
                        <?= Html::submitButton('Transfer', ['class' => 'btn-common btn-form', 'name' => 'login', 'style' => '']) ?>
                        <?= Html::a('Clear', ['/epin-request/epin-transfer'], ['class' => 'btn-common btn-form']) ?>
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

        $(document).on('blur', '#epintransfer-member_id', function (e) {
            var member_id = $(this).val();
            if (member_id != '') {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    async: false,
                    data: {member_id: member_id},
                    url: '<?= Yii::$app->homeUrl; ?>epin-request/check-member-exist',
                    success: function (data) {
                        if (data == 0) {
                            alert('This member does not exist.');
                            $("#epintransfer-member_id").val('');
                        }
                    }
                });
            }
        });
    });
</script>