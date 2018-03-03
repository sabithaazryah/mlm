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

<div class="row" style="margin-top: 70px;">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="epin-request-create">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php $form = ActiveForm::begin(['id' => 'epin-submit']); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($model, 'member_id')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'customer_id')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->id])->label(FALSE) ?>
                            </div>
                            <div class="col-md-3">
                                <?php $e_pins = ArrayHelper::map(PinRequestDetails::findAll(['status' => 1, 'parent_id' => Yii::$app->user->id]), 'epin', 'epin'); ?>
                                <?= $form->field($model, 'epin')->dropDownList($e_pins, ['prompt' => 'Choose a E-Pin']) ?>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?= Html::submitButton('Transfer', ['class' => 'btn btn-success', 'style' => 'float:left;padding: 8px 15px;margin-top: 32px;']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
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
