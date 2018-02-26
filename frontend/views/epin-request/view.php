<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Epin Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epin-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'amount_deposited',
            'bank_name',
            'type',
            'transaction_id',
            'name',
            'phone_number',
            'number_of_pin',
            'package_for_each_pin',
            'slip',
            'status',
            'CB',
            'UB',
            'DOC',
            'DOU',
        ],
    ]) ?>

</div>
