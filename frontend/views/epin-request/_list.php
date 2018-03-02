<?php

use yii\helpers\Html;
use common\models\PinRequestDetails;
?>
<div style="border: 1px solid #b9b9b9;padding: 0px 10px;margin: 8px 0px;">
    <div class="epin-request-master-view">
        <?= common\components\EpinDetailsWidget::widget(['id' => $model->id]) ?>
    </div>
    <?php
    $pin_details = PinRequestDetails::find()->where(['master_id' => $model->id])->all();
    ?>
    <div class="epin-request-view">
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Package Name</th>
                    <th>E-PIN</th>
                    <th>Status</th>
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
                            <?php
                            if ($value->status == 0) {
                                echo 'Pending';
                            } elseif ($value->status == 1) {
                                echo 'Approved';
                            } elseif ($value->status == 2) {
                                echo 'Rejected';
                            } elseif ($value->status == 3) {
                                echo 'Used';
                            } elseif ($value->status == 4) {
                                echo 'Transfer';
                            }
                            ?>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

