<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Display Name : ' . Yii::$app->user->identity->user_name;
?>
<div class="container-fluid dashbord_content_wrapper dashboard-index">
    <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <ul class="dashbord_list balnce_info">
                    <li><span class="round green"></span>235<span class="label">Balance Amount</span></li>
                    <li><span class="round blue"></span>123<span class="label">Repurchase Amount</span></li>
                    <li><span class="round icon_round"><img src="images/icon-ip.png" alt="" class="img-responsive"></span>103.78.16.213<span class="label">Your IP</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <ul class="dashbord_list member_info">
                    <li><?= Yii::$app->user->identity->user_name ?><span class="label">Member ID</span></li>
                    <li class="button_wrapper"><a href="#" class="btn-common">ID Card Download</a></li>
                    <li class="button_wrapper"><a href="#" class="btn-common">ID Card Download</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <ul class="dashbord_list upload_list">
                    <li class="">
                        <?php
                        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
                        ?>
                        <label>Choose File<?= $form->field($model_profile, 'photo')->fileInput(['style' => 'display:none;'])->label(FALSE) ?></label>
                        <?= Html::submitButton('Upload Photo', ['class' => 'btn-common btn-profile', 'name' => 'profile-button', 'style' => '']) ?>
                        <?php ActiveForm::end(); ?>
                    </li>
                    <li class="">
                        <?php
                        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
                        ?>
                        <label>Choose File<?= $form->field($model_pan, 'photo')->fileInput(['style' => 'display:none;'])->label(FALSE) ?></label>
                        <?= Html::submitButton('Upload Pancard', ['class' => 'btn-common', 'name' => 'pan-button', 'style' => '']) ?>
                        <?php ActiveForm::end(); ?>
                    </li>
                    <li class="">
                        <?php
                        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
                        ?>
                        <label>Choose File<?= $form->field($model_bank, 'photo')->fileInput(['style' => 'display:none;'])->label(FALSE) ?></label>
                        <?= Html::submitButton('Upload Bank Details', ['class' => 'btn-common btn-bank', 'name' => 'bank-button', 'style' => '']) ?>
                        <?php ActiveForm::end(); ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <div class="header_wrapper"><span class="icon_wrapper"><img src="images/icon-flag.png" alt="" class="img-responsive"></span>Contact Details <a href="" class="actions"><span></span> <span></span> <span></span></a></div>
                <ul class="dashbord_list">
                    <li class=""><span>Distributor Id :</span> <?= $employee->user_name ?></li>
                    <li class=""><span>Full Name :</span> <?= $employee->distributor_name ?></li>
                    <li class=""><span>Mobile No :</span> <?= $employee->mobile_number ?></li>
                    <li class=""><span>Email ID :</span> <?= $employee->email ?></li>
                    <li class=""><span>Privilege Card No :</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <div class="header_wrapper"><span class="icon_wrapper"><img src="images/icon-bank.png" alt="" class="img-responsive"></span>Bank Details <a href="" class="actions"><span></span> <span></span> <span></span></a></div>
                <ul class="dashbord_list">
                    <li class=""><span>Bank Name :</span> <?= $employee_details->bank_name ?></li>
                    <li class=""><span>Branch Name :</span> <?= $employee_details->branch ?></li>
                    <li class=""><span>Account No :</span> <?= $employee_details->account_no ?></li>
                    <li class=""><span>IFSC / Code :</span> <?= $employee_details->ifsc_code ?></li>
                    <li class=""><span>Pan Card :</span> <?= $employee_details->pan_number ?></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="block_wrapper">
                <div class="header_wrapper"><span class="icon_wrapper"><img src="images/icon-membership.png" alt="" class="img-responsive"></span>Membership Details<a href="" class="actions"><span></span> <span></span> <span></span></a></div>
                <ul class="dashbord_list">
                    <li class=""><span>Rank :</span></li>
                    <li class=""><span>DOB :</span> <?= $employee_details->dob ?></li>
                    <li class=""><span>Date of Join :</span> Sep 28 2016 6:45PM</li>
                    <li class=""><span>Joining Amt / BV :</span> <?= $employee_package->price . ' / ' . $employee_package->bv ?></li>
                    <li class=""><span>Status :</span> <?= $employee->status == 1 ? 'Active' : '' ?></li>
                </ul>
            </div>
        </div>

    </div>
</div>
