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

$this->title = 'Modify Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid dashbord_content_wrapper">
        <div class="row">
                <div class="form_wrapper">
                        <?php $form = ActiveForm::begin(['id' => 'signup-update']); ?>
                        <div class="form_header">
                                Registration Details
                        </div>
                        <?= common\widgets\Alert::widget(); ?>
                        <div class="form_content">

                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'display_name')->textInput() ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($model, 'distributor_name')->textInput(['readonly' => true]) ?>
                                        </div>
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
                                                <?= $form->field($user_details, 'ifsc_code')->textInput(['readonly' => true]) ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'account_no')->textInput(['readonly' => true]) ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'bank_name')->textInput(['readonly' => true]) ?>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'branch')->textInput(['readonly' => true]) ?>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($user_details, 'pan_number')->textInput(['readonly' => true]) ?>
                                        </div>



                                </div>
                        </div>



                        <div class="form_footer">
                                <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">


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

                $(document).on('submit', '#signup-update', function (e) {
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


