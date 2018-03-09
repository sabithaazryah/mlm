<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wallet History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//            'type',
                            'date',
                                [
                                'attribute' => 'type',
                                'value' => function($model) {
                                    if ($model->type == 1) {
                                        return 'BV Match';
                                    } else if ($model->type == 2) {
                                        return 'Commission Added';
                                    }
                                }
                            ],
                                [
                                'attribute' => 'match_bv',
                                'value' => function($model) {
                                    if ($model->type == 1)
                                        return $model->match_bv;
                                    else if ($model->type == 2)
                                        return '';
                                },
                            ],
                                [
                                'header' => 'Amount Added',
                                'attribute' => 'current_wallet_amount',
                                'value' => function($model) {
                                    if ($model->type == 1) {
                                        return $model->current_wallet_amount-$model->previous_wallet_amount+$model->company_amount;
                                    } else if ($model->type == 2) {
                                        return $model->commision;
                                    }
                                }
                            ],
                        // 'match_bv',
                        //'current_wallet_amount',
                        //'company',
                        //'company_amount',
                        //'tax',
                        //'tax_amount',
                        //'service_charge',
                        //'service_charge_amount',
                        //'commision',
                        //'date',
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


