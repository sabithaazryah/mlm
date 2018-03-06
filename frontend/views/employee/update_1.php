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
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body"><div class="epin-request-create">
                        <div class="site-signup">


                            <?= common\widgets\Alert::widget(); ?>
                            <div class="row">
                                <label></label>
                                <?php $form = ActiveForm::begin(['id' => 'signup-update']); ?>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'display_name')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($model, 'distributor_name')->textInput(['readonly' => true]) ?>
                                </div>

                                <div class="col-md-4">
                                    <?= $form->field($model, 'referal_id')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'father_name')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?php
                                    if (isset($user_details->dob) && $user_details->dob != '0000-00-00') {
                                        $user_details->dob = date('d-m-Y', strtotime($user_details->dob));
                                    } else {
                                        $user_details->dob = '';
                                    }
                                    ?>

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
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'gender')->dropDownList(['1' => 'Male', '2' => 'Female']) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($model, 'mobile_number')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'pincode')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'post_office')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?php $state = State::find()->where(['status' => 1])->all(); ?>
                                    <?= $form->field($user_details, 'state')->dropDownList(ArrayHelper::map($state, 'id', 'state'), ['prompt' => '--Select--']) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'city')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'house_name')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'taluk')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'address')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($model, 'email')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'nominee_name')->textInput() ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'nominee_relation')->dropDownList(['' => '--Select--', '1' => 'Brother', '2' => 'Daughter', '3' => 'Father', '4' => 'Husband', '5' => 'Mother', '6' => 'Son', '7' => 'Sister', '8' => 'Wife']) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'ifsc_code')->textInput(['readonly' => true]) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'account_no')->textInput(['readonly' => true]) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'bank_name')->textInput(['readonly' => true]) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'branch')->textInput(['readonly' => true]) ?>
                                </div><div class="col-md-4">
                                    <?= $form->field($user_details, 'pan_number')->textInput(['readonly' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'style' => 'float:right;']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
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