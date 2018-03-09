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

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid dashbord_content_wrapper">
        <div class="row">
                <div class="form_wrapper">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <div class="form_header">
                                Registration Details
                        </div>
                        <?= common\widgets\Alert::widget(); ?>
                        <div class="form_content">
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group field-employee-placement_name">
                                                        <label class="control-label" for="employee-placement_name">Placement Name *</label>
                                                        <input type="hidden" id="employee-placement_name" class="form-control" name="Employee[placement_name]" aria-required="true" aria-invalid="true" value="<?= $placement_details->id ?>">
                                                        <input type="text" id="" class="form-control" name="" aria-required="true" aria-invalid="true" value="<?= $placement_details->distributor_name ?>" readonly>
                                                        <p class="help-block help-block-error"></p>
                                                </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'placement_id')->textInput(['readonly' => true, 'value' => $placement_details->user_name])->label('Placement ID *') ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'distributor_name')->textInput()->label('Distributor Name *') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'placement')->dropDownList($placement_arr)->label('Placement *') ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <?php $epin = PinRequestDetails::find()->where(['parent_id' => Yii::$app->user->id, 'status' => 1])->all() ?>
                                                                        <?= $form->field($model, 'epin')->dropDownList(ArrayHelper::map($epin, 'id', 'epin'), ['prompt' => '--Select--'])->label('E-pin *') ?>
                                                                </div>
                                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <input type="text" id="employee-epin_number" class="form-control" name="" aria-required="true" aria-invalid="true"  readonly style="margin-top:28px">
                                                                </div>
                                                        </div>

                                                </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'referal_id')->textInput() ?>
                                        </div>
                                        <!--                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Pin Price/BV</label>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <input class="form-control">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <input class="form-control">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>-->



                                </div>
                        </div>



                        <div class="form_header">
                                Personal Information
                        </div>

                        <div class="form_content">
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'father_name')->textInput()->label('Father / Husband Name') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
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
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'gender')->dropDownList(['1' => 'Male', '2' => 'Female']) ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'mobile_number')->textInput()->label('Mobile Number*') ?>
                                        </div>
                                </div>
                        </div>



                        <div class="form_header">
                                Detailed Address
                        </div>

                        <div class="form_content">
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'pincode')->textInput()->label('6 Digit Pincode *') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'post_office')->textInput()->label('Nearest Postoffice') ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?php $state = State::find()->where(['status' => 1])->all(); ?>
                                                <?= $form->field($user_details, 'state')->dropDownList(ArrayHelper::map($state, 'id', 'state'), ['prompt' => '--Select--'])->label('State *') ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'city')->textInput()->label('District / City *') ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'house_name')->textInput()->label('Door No / House Name *') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'taluk')->textInput()->label('Taluk *') ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'address')->textInput()->label('Address *') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'email')->textInput()->label('E-Mail ID') ?>
                                        </div>
                                </div>
                        </div>

                        <div class="form_header">
                                Nominee Details
                        </div>

                        <div class="form_content">
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'nominee_name')->textInput() ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'nominee_relation')->dropDownList(['' => '--Select--', '1' => 'Brother', '2' => 'Daughter', '3' => 'Father', '4' => 'Husband', '5' => 'Mother', '6' => 'Son', '7' => 'Sister', '8' => 'Wife']) ?>
                                        </div>

                                </div>
                        </div>

                        <div class="form_header">
                                Account Details
                        </div>
                        <div class="form_content">
                                <div class="row">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'ifsc_code')->textInput() ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'account_no')->textInput() ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'bank_name')->textInput() ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'branch')->textInput() ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'pan_number')->textInput() ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'password')->passwordInput() ?>
                                        </div>

                                </div>
                        </div>

                        <div class="form_header">
                                Product Selection
                        </div>

                        <div class="form_content">
                                <div class="row">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'prefered_dispatch')->dropDownList(['1' => 'Courier'])->label('Preferred Dispatch *') ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'selected_price')->textInput(['readonly' => true]) ?>
                                        </div>

                                </div>
                        </div>
<input type="hidden" name="token" value="<?php echo rand(10000, 100000); ?>">
                        <div class="form_footer">
                                <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="checkbox">
                                                        <label>
                                                                <input type="checkbox" data-ng-model="example.check">
                                                                <span class="box"></span>
                                                                I accept Terms & Conditions
                                                        </label>
                                                </div>

                                                <div class="checkbox">
                                                        <label>
                                                                <input type="checkbox" data-ng-model="example.check">
                                                                <span class="box"></span>
                                                                I heard & understood in my Own language
                                                        </label>
                                                </div>

                                        </div>

                                        <div class="col-md-6 col-sm-12 col-xs-12 button-container">
                                                <?= Html::submitButton('Submit', ['class' => 'btn-common btn-form', 'style' => '']) ?>
                                                <?= Html::a('Clear', ['/employee/create'], ['class' => 'btn-common btn-form']) ?>
                                        </div>

                                </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                </div>
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
                                        $("#employeedetails-selected_price").val(res['amount']);
                                        $("#employee-pin_price").val(res['amount']);
                                        $("#employee-bv").val(res['bv']);
                                }
                        });
                });

                $(document).on('blur', '#employee-referal_id', function (e) {
                        var member_id = $(this).val();

                        if (member_id != '') {
                                $.ajax({
                                        type: 'POST',
                                        cache: false,
                                        async: false,
                                        data: {member_id: member_id},
                                        url: '<?= Yii::$app->homeUrl; ?>employee/check-member-exist',
                                        success: function (data) {
                                                if (data == 0) {
                                                        if ($("#employee-referal_id").parent().next(".validation").length == 0) // only add if not added
                                                        {
                                                                $("#employee-referal_id").parent().after("<div class='validation' style='color:#cc3f44;margin-left: 4px;font-size: 11px;'>This member doesn't exist.</div>");
                                                        }

                                                } else {
                                                        $('.validation').remove();
                                                }

                                        }
                                });
                        }
                });

                $(document).on('submit', '#form-signup', function (e) {
                        var member_id = $('#employee-referal_id').val();

                        if (member_id != '') {
                                $.ajax({
                                        type: 'POST',
                                        cache: false,
                                        async: false,
                                        data: {member_id: member_id},
                                        url: '<?= Yii::$app->homeUrl; ?>employee/check-member-exist',
                                        success: function (data) {
                                                if (data == 0) {
                                                        if ($("#employee-referal_id").parent().next(".validation").length == 0) // only add if not added
                                                        {
                                                                $("#employee-referal_id").parent().after("<div class='validation' style='color:#cc3f44;margin-left: 4px;font-size: 11px;'>This member doesn't exist.</div>");
                                                        }
                                                        e.preventDefault();
                                                        return false;

                                                } else {
                                                        $('.validation').remove();
                                                        return true;
                                                }

                                        }
                                });
                        }
                });
        });



</script>