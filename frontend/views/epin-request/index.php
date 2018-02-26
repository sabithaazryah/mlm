<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EpinRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Epin Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epin-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Epin Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'amount_deposited',
            'bank_name',
            'type',
            'transaction_id',
            //'name',
            //'phone_number',
            //'number_of_pin',
            //'package_for_each_pin',
            //'slip',
            //'status',
            //'CB',
            //'UB',
            //'DOC',
            //'DOU',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
