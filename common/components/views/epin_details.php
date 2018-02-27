<?php

use yii\helpers\Html;
?>
<style>
    .appoint{
        width: 100%;
    }
    .appoint .value{
        font-weight: bold;
        text-align: left;
    }
    .appoint .labell{
        text-align: left;
    }
    .appoint .colen{

    }
    .appoint td{
        padding: 10px;

    }
    .appoint  .labell{
        width:10% !important;
    }
</style>
<table class="appoint">
    <tr>
        <td class="labell">Amount Deposited</td><td class="value">:
            <?= $model->amount_deposited; ?>
        </td>
        <td class="labell">Bank Name</td><td class="value">:
            <?php
            if (isset($model->bank_name)) {
                $bank = common\models\BankDetails::findOne($model->bank_name);
                if (!empty($bank))
                    echo $bank->bank_name;
            }
            ?>
        </td>
        <td class="labell">Type</td>
        <td class="value">:
            <?php
            if ($model->type == 1) {
                echo 'RTGS';
            } elseif ($model->type == 2) {
                echo 'NEFT';
            } elseif ($model->type == 3) {
                echo 'Cash Deposit';
            } elseif ($model->type == 4) {
                echo 'IMPS';
            } else {
                echo '';
            }
            ?>
        </td>
    </tr>

    <tr>
        <td class="labell">Transaction ID</td><td class="value">:
            <?php
            echo $model->transaction_id;
            ?>
        </td>
        <td class="labell">Depositor Name</td><td class="value">:
            <?php
            echo $model->name;
            ?>
        </td>
        <td class="labell">Depositor Phone</td><td class="value">:
            <?php
            echo $model->phone_number;
            ?>
        </td>
    </tr>
    <tr>
        <td class="labell">Number of E-PIN</td><td class="value">:
            <?php
            echo $model->number_of_pin;
            ?>
        </td>
        <td class="labell">Document</td><td class="value">:
            <a href="<?= Yii::$app->homeUrl; ?>../uploads/pin_request_document/<?= $model->id ?>.<?= $model->slip ?>" target="_blank">7.jpeg</a>
        </td>
        <td class="labell"></td><td class="value">
        </td>
    </tr>

</table>

