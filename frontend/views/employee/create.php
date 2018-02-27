<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <div class="row">

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="col-md-4">
                        <?= $form->field($model, 'placement_name')->textInput(['autofocus' => true]) ?>
                </div><div class="col-md-4">
                        <?= $form->field($model, 'placement_id') ?>
                </div><div class="col-md-4">
                        <?= $form->field($model, 'distributor_name')->textInput() ?>
                </div><div class="col-md-4">
                        <?= $form->field($model, 'placement')->dropDownList(['1' => 'Right', '2' => 'Left']) ?>
                </div><div class="col-md-4">
                        <?= $form->field($model, 'epin')->textInput() ?>
                </div><div class="col-md-4">
                        <?= $form->field($model, 'pin_price')->textInput() ?>
                </div><div class="col-md-4">
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
                        <?= $form->field($model, 'state')->textInput() ?>
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
                        <?= $form->field($model, 'user_name')->textInput() ?>
                </div>
        </div>

        <div class="row">

                <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
</div>
</div>
