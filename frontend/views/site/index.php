<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Display Name : ' . Yii::$app->user->identity->user_name;
?>
<style>
    .panel-second{
        background: #eeeeee;
        padding: 10px;
        min-height: 250px;
        border-top: 2px solid #009cd9;
        border-radius: 5px;
    }
    table.table tr {
        border: none;
    }
    .table-rmbrder{
        margin-top: 25px;
    }
</style>
<div class="row" style="margin-top: 90px;"
     <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?php // Html::a('<i class="fa-th-list"></i><span> Manage Admin Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                <div class="panel-body">
                    <div class="row" style="margin-bottom: 40px;">
                        <div class="col-md-8">
                            <div class="col-md-4">
                                <img src="<?= Yii::$app->homeUrl; ?>images/user-4.png"/>
                                <input type="file"/>
                                <button type="submit">Upload Photo</button>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= Yii::$app->homeUrl; ?>images/user-4.png"/>
                                <input type="file"/>
                                <button type="submit">Upload Photo</button>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= Yii::$app->homeUrl; ?>images/user-4.png"/>
                                <input type="file"/>
                                <button type="submit">Upload Photo</button>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel-second">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Contact Details:</h4>
                                </div>
                                <table class="table table-borderless table-rmbrder">
                                    <tr>
                                        <th>Distributor Id</th>
                                        <td>: <?= $employee->user_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Full Name</th>
                                        <td>: <?= $employee->distributor_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile No.</th>
                                        <td>: <?= $employee->mobile_number ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email ID</th>
                                        <td>: <?= $employee->email ?></td>
                                    </tr>
                                    <tr>
                                        <th>Privilege Card No </th>
                                        <td>: </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel-second">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Bank Details Details:</h4>
                                </div>
                                <table class="table table-borderless table-rmbrder">
                                    <tr>
                                        <th>Bank Name</th>
                                        <td>: <?= $employee_details->bank_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Branch Name</th>
                                        <td>: <?= $employee_details->branch ?></td>
                                    </tr>
                                    <tr>
                                        <th>Account No</th>
                                        <td>: <?= $employee_details->account_no ?></td>
                                    </tr>
                                    <tr>
                                        <th>IFSC / Code </th>
                                        <td>: <?= $employee_details->ifsc_code ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pan Card</th>
                                        <td>: <?= $employee_details->pan_number ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel-second">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Membership Details:</h4>
                                </div>
                                <table class="table table-borderless table-rmbrder">
                                    <tr>
                                        <th>Rank</th>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <th>DOB </th>
                                        <td>: <?= $employee_details->dob ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Join</th>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <th>Joining Amt / BV</th>
                                        <td>: <?= $employee_package->price . ' / ' . $employee_package->bv ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status </th>
                                        <td>: <?= $employee->status == 1 ? 'Active' : '' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>