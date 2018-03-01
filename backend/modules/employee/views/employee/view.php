<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Employee;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = $model->distributor_name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Employee</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="employee-view">


                                                <h5 class="title-caption">User Details</h5>
                                                <table class="table table-striped table-bordered">

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('user_name'); ?></b></td>
                                                                <td> <?= $model->distributor_name ?></td>

                                                                <td><b>User ID</b></td>
                                                                <td> <?= $model->user_name ?></td>

                                                        </tr>
                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('placement_name'); ?></b></td>
                                                                <?php
                                                                $placement_name = Employee::findOne($model->placement_name);
                                                                ?>
                                                                <td> <?= $placement_name->distributor_name . '( ' . $placement_name->user_name . ')' ?></td>

                                                                <td><b><?= $model->getAttributeLabel('placement'); ?></b></td>
                                                                <td>
                                                                        <?php
                                                                        if ($model->placement == 1) {
                                                                                echo 'Right';
                                                                        } else if ($model->placement == 2) {
                                                                                echo 'Left';
                                                                        }
                                                                        ?>
                                                                </td>

                                                        </tr>
                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('referal_id'); ?></b></td>
                                                                <?php
                                                                $referal_name = Employee::findOne($model->referal_id);
                                                                ?>
                                                                <td>
                                                                        <?= $referal_name->distributor_name ?>
                                                                </td>

                                                                <td><b></b></td>
                                                                <td></td>

                                                        </tr>


                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('father_name'); ?></b></td>
                                                                <td> <?= $placement_name->father_name ?></td>

                                                                <td><b><?= $model->getAttributeLabel('dob'); ?></b></td>
                                                                <td> <?= date('d-m-Y', strtotime($model->dob)) ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('gender'); ?></b></td>
                                                                <td>  <?php
                                                                        if ($model->gender == 1) {
                                                                                echo 'Male';
                                                                        } else if ($model->gender == 2) {
                                                                                echo 'Female';
                                                                        }
                                                                        ?></td>

                                                                <td><b><?= $model->getAttributeLabel('mobile_number'); ?></b></td>
                                                                <td> <?= $model->mobile_number ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('pincode'); ?></b></td>
                                                                <td>  <?= $model->pincode ?></td>
                                                                <td><b><?= $model->getAttributeLabel('post_office'); ?></b></td>
                                                                <td> <?= $model->post_office ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('city'); ?></b></td>
                                                                <td>  <?= $model->city ?></td>
                                                                <td><b><?= $model->getAttributeLabel('house_name'); ?></b></td>
                                                                <td> <?= $model->house_name ?></td>
                                                        </tr>


                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('taluk'); ?></b></td>
                                                                <td>  <?= $model->taluk ?></td>
                                                                <td><b><?= $model->getAttributeLabel('address'); ?></b></td>
                                                                <td> <?= $model->address ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('email'); ?></b></td>
                                                                <td>  <?= $model->email ?></td>
                                                                <td><b><?= $model->getAttributeLabel('nominee_name'); ?></b></td>
                                                                <td> <?= $model->nominee_name ?></td>
                                                        </tr>

                                                        <tr>

                                                                <td><b><?= $model->getAttributeLabel('nominee_relation'); ?></b></td>
                                                                <td> <?php
                                                                        if ($model->nominee_relation == 1) {
                                                                                echo 'Brother';
                                                                        } else if ($model->nominee_relation == 2) {
                                                                                echo 'Daughter';
                                                                        } else if ($model->nominee_relation == 3) {
                                                                                echo 'Father';
                                                                        } else if ($model->nominee_relation == 4) {
                                                                                echo 'Husband';
                                                                        } else if ($model->nominee_relation == 5) {
                                                                                echo 'Mother';
                                                                        } else if ($model->nominee_relation == 6) {
                                                                                echo 'Son';
                                                                        } else if ($model->nominee_relation == 7) {
                                                                                echo 'Sister';
                                                                        } else if ($model->nominee_relation == 8) {
                                                                                echo 'Wife';
                                                                        }
                                                                        ?></td>
                                                                <td><b><?= $model->getAttributeLabel('ifsc_code'); ?></b></td>
                                                                <td>  <?= $model->ifsc_code ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('account_no'); ?></b></td>
                                                                <td>  <?= $model->account_no ?></td>
                                                                <td><b><?= $model->getAttributeLabel('bank_name'); ?></b></td>
                                                                <td> <?= $model->bank_name ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b><?= $model->getAttributeLabel('branch'); ?></b></td>
                                                                <td>  <?= $model->branch ?></td>
                                                                <td><b><?= $model->getAttributeLabel('pan_number'); ?></b></td>
                                                                <td> <?= $model->pan_number ?></td>
                                                        </tr>

                                                </table>


                                                <h5 class="title-caption">Business Volume (BV) and Commission</h5>

                                                <table class="table table-striped table-bordered">
                                                        <tr>
                                                                <td><b>Total Left BV</b></td>
                                                                <td></td>

                                                                <td><b>Current Left BV</b></td>
                                                                <td></td>
                                                        </tr>




                                                        <tr>
                                                                <td><b>Total Right BV</b></td>
                                                                <td></td>

                                                                <td><b>Current Right BV</b></td>
                                                                <td></td>
                                                        </tr>

                                                        <tr>
                                                                <td><b>Commission</b></td>
                                                                <td></td>

                                                                <td><b></b></td>
                                                                <td></td>
                                                        </tr>
                                                </table>



                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


