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
                             <?= Html::a('<i class="fa fa-plus"></i><span> Wallet History</span>', ['wallet-history'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float: right']) ?>
                        </div>
                        <div class="panel-body table-responsive">


                            
                                <div class="epin-request-view">
                                    <div class="col-md-12">
                                        <div class="row" >
                                                <div class="col-md-12">
                                                    <label>  Name   </label> :    <?= $employee->distributor_name ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label> Username   </label> :   <?= $employee->user_name ?>
                                                </div>
                                        </div>

                                        <div class="row" >
                                                <div class="col-md-12">
                                                    <label>   Total Left BV </label>   :    <?= $employee_wallet->total_left_bv ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>Total Right BV </label>  :   <?= $employee_wallet->total_right_bv ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label> Current Left BV </label>  :   <?= $employee_wallet->current_left_bv ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label> Current Right BV</label>   :   <?= $employee_wallet->current_right_bv ?>
                                                </div>
                                        </div>

                                        <div class="row" >
                                                <div class="col-md-12">
                                                    <label>Sponsorship Bonous </label>  :   <?= $commission_amount ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label> Commission Amount </label> :   <?= $matched_amount ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label> Serviice Charge Deducted </label>  :   <?= $service_charge+$commission_service_amount ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>Tax  Deducted  </label> :   <?= $tax+$commission_tax_amount ?>
                                                </div>


                                        </div>

                                        <div class="row">
                                                <div class="col-md-12">
                                                    <label> Total  Wallet  Amount </label> :   <?= $employee_wallet->wallet ?>
                                                </div>
                                        </div>


                                </div>
                            </div>

                        </div>
                </div>
        </div>
</div>

