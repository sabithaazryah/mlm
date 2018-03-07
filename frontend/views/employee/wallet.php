<?php

use yii\helpers\Html;
Use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EpinRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wallet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid dashbord_content_wrapper">
        <div class="row">
                <div class="form_wrapper">
                        <div class="form_header">
                                <?= Html::encode($this->title) ?>
                        </div>
                        <div class="panel-body table-responsive">



                                <div class="epin-request-view">
                                        <div class="row" style="margin-left: 0">
                                                <div class="col-md-3">
                                                        Name   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee->distributor_name ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Username   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee->user_name ?>
                                                </div>
                                        </div>

                                        <div class="row" style="margin-left: 0;margin-top: 15px">
                                                <div class="col-md-3">
                                                        Total Left BV   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee_wallet->total_left_bv ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Total Right BV   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee_wallet->total_right_bv ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Current Left BV   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee_wallet->current_left_bv ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Current Right BV   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee_wallet->current_right_bv ?>
                                                </div>
                                        </div>

                                        <div class="row" style="margin-left: 0;margin-top: 15px">
                                                <div class="col-md-3">
                                                        Sponsorship Bonous   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $commission_amount ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Commission Amount  &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $matched_amount ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Serviice Charge Deducted   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $service_charge ?>
                                                </div>

                                                <div class="col-md-3">
                                                        Tax  Deducted   &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $tax ?>
                                                </div>


                                        </div>

                                        <div class="row" style="margin-left: 0;margin-top: 15px">
                                                <div class="col-md-3">
                                                        Total  Wallet  Amount  &nbsp; &nbsp; :   &nbsp; &nbsp; <?= $employee_wallet->wallet ?>
                                                </div>
                                        </div>


                                </div>

                        </div>
                </div>
        </div>
</div>

