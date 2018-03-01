<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use common\models\Employee;
use common\models\PinRequestDetails;
use yii\helpers\ArrayHelper;
use common\models\State;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>
    <?= common\widgets\Alert::widget(); ?>
    <div class="row">

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-md-4">
            <div class="form-group field-employee-placement_name">
                <label class="control-label" for="employee-placement_name">Placement Name</label>
                <input type="hidden" id="employee-placement_name" class="form-control" name="Employee[placement_name]" aria-required="true" aria-invalid="true" value="<?= $placement_details->id ?>">
                <input type="text" id="" class="form-control" name="" aria-required="true" aria-invalid="true" value="<?= $placement_details->distributor_name ?>" readonly>
                <p class="help-block help-block-error"></p>
            </div>
        </div><div class="col-md-4">
            <?= $form->field($model, 'placement_id')->textInput(['readonly' => true, 'value' => $placement_details->user_name]) ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'distributor_name')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'placement')->dropDownList($placement_arr) ?>
        </div><div class="col-md-2">
            <?php $epin = PinRequestDetails::find()->where(['parent_id' => Yii::$app->user->id, 'status' => 1, 'epin_status' => 0])->all() ?>
            <?= $form->field($model, 'epin')->dropDownList(ArrayHelper::map($epin, 'id', 'epin'), ['prompt' => '--Select--']) ?>
        </div><div class="col-md-2">
            <?= $form->field($model, 'epin_number')->textInput(['style' => 'margin-top: 33px;'])->label(FALSE) ?>
        </div>
        <?= $form->field($model, 'pin_price')->hiddenInput()->label(FALSE) ?>
        <?= $form->field($model, 'bv')->hiddenInput()->label(FALSE) ?>
        <div class="col-md-4">
            <?= $form->field($model, 'referal_id')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'father_name')->textInput() ?>
        </div><div class="col-md-4">
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
        </div><div class="col-md-4">
            <?= $form->field($model, 'gender')->dropDownList(['1' => 'Male', '2' => 'Female']) ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'mobile_number')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'pincode')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'post_office')->textInput() ?>
        </div><div class="col-md-4">
            <?php $state = State::find()->where(['status' => 1])->all(); ?>
            <?= $form->field($model, 'state')->dropDownList(ArrayHelper::map($state, 'id', 'state'), ['prompt' => '--Select--']) ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'city')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'house_name')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'taluk')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'address')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'email')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'nominee_name')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'nominee_relation')->dropDownList(['' => '--Select--', '1' => 'Brother', '2' => 'Daughter', '3' => 'Father', '4' => 'Husband', '5' => 'Mother', '6' => 'Son', '7' => 'Sister', '8' => 'Wife']) ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'ifsc_code')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'account_no')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'bank_name')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'branch')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'pan_number')->textInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'prefered_dispatch')->dropDownList(['1' => 'Courier']) ?>
        </div><div class="col-md-4">
            <?= $form->field($model, 'selected_price')->textInput(['readonly' => true]) ?>
        </div>
    </div>

    <div class="row">

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#employee-placement_name').change(function () {
            $.ajax({
                type: 'POST',
                cache: false,
                data: {employee: $(this).val()},
                url: homeUrl + 'employee/employeeid',
                success: function (data) {
                    $("#employee-placement_id").val(data);
                }
            });
        });

        $('#employee-epin').change(function () {
            $.ajax({
                type: 'POST',
                cache: false,
                data: {epin: $(this).val()},
                url: homeUrl + 'employee/epin',
                success: function (data) {
                    var res = $.parseJSON(data);
                    $("#employee-epin_number").val(res['amount']);
                    $("#employee-selected_price").val(res['amount']);
                    $("#employee-pin_price").val(res['amount']);
                    $("#employee-bv").val(res['bv']);
                }
            });
        });
    });
</script>