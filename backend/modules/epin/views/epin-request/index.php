<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\BankDetails;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EpinRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Epin Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epin-request-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?php //  Html::a('<i class="fa-th-list"></i><span> Create Epin Request</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                            'amount_deposited',
                            [
                                'attribute' => 'bank_name',
                                'value' => function($data) {
                                    if (isset($data->bank_name)) {
                                        return BankDetails::findOne($data->bank_name)->bank_name;
                                    } else {
                                        return '';
                                    }
                                },
                                'filter' => ArrayHelper::map(BankDetails::find()->asArray()->all(), 'id', 'bank_name'),
                            ],
                            [
                                'attribute' => 'type',
                                'filter' => ['1' => 'RTGS', '2' => 'NEET', '3' => 'Cash Deposit', '4' => 'IMP'],
                                'value' => function ($model) {
                                    if ($model->type == 1) {
                                        return 'RTGS';
                                    } elseif ($model->type == 2) {
                                        return 'NEET';
                                    } elseif ($model->type == 3) {
                                        return 'Cash Deposit';
                                    } elseif ($model->type == 4) {
                                        return 'IMP';
                                    }
                                },
                                'filter' => ['1' => 'RTGS', '2' => 'NEET', '3' => 'Cash Deposit', '4' => 'IMP'],
                            ],
                            'transaction_id',
                            'name',
                            'phone_number',
                            'number_of_pin',
                            // 'package_for_each_pin',
                            [
                                'attribute' => 'slip',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    if ($data->slip != '') {
                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/../uploads/pin_request_document/' . $data->id . '.' . $data->slip;
                                        if (file_exists($dirPath)) {
                                            return \yii\helpers\Html::a($data->id . '.' . $data->slip, ['/../uploads/pin_request_document/' . $data->id . '.' . $data->slip], ['target' => '_blank']);
                                        } else {
                                            return 'No Image';
                                        }
                                    } else {
                                        return 'No Image';
                                    }
                                },
                            ],
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


