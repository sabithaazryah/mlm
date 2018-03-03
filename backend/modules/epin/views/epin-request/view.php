<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\EpinDetailsWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */

$this->title = 'Pin Request Details';
$this->params['breadcrumbs'][] = ['label' => 'Epin Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Epin Request</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body">
                    <div class="epin-request-master-view">
                        <?= EpinDetailsWidget::widget(['id' => $model->id]) ?>
                    </div>
                    <div class="epin-request-view">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Package Name</th>
                                    <th>E-PIN</th>
                                    <th style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($pin_details as $value) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <?php
                                            if (isset($value->package_id)) {
                                                $package = common\models\Packages::findOne($value->package_id);
                                                echo $package->name . ' - ' . $package->amount;
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($value->epin)) {
                                                echo $value->epin;
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($value->status == 0) { ?>
                                                <?= Html::a('Approve', ['/epin/epin-request/approve', 'id' => $value->id], ['class' => 'btn btn-secondary', 'style' => 'padding: 4px 10px;border-radius: 5px;']) ?>
                                                <?= Html::a('Reject', ['/epin/epin-request/reject', 'id' => $value->id], ['class' => 'btn btn-red', 'style' => 'border-radius: 5px;padding: 4px 14px;']) ?>
                                                <?php
                                            } elseif ($value->status == 1) {
                                                echo '<h5 style="font-weight: 600;color: green;">Approved</h5>';
                                            } elseif ($value->status == 2) {
                                                echo '<h5 style="font-weight: 600;color: red;">Rejected</h5>';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


