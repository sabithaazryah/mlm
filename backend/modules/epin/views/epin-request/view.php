<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\EpinDetailsWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'package_id',
                                'value' => function($data) {
                                    if (isset($data->package_id)) {
                                        $package = common\models\Packages::findOne($data->package_id);
                                        return $package->name . ' - ' . $package->amount;
                                    } else {
                                        return '';
                                    }
                                },
                                'filter' => ArrayHelper::map(\common\models\Packages::find()->asArray()->all(), 'id', function($model) {
                                            return $model['name'] . ' - ' . $model['amount'];
                                        }),
                            ],
                            'epin',
                            [
                                'attribute' => 'status',
                                'filter' => ['0' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '3' => 'Used', '4' => 'Transfer'],
                                'value' => function ($model) {
                                    if ($model->status == 0) {
                                        return 'Pending';
                                    } elseif ($model->status == 1) {
                                        return 'Approved';
                                    } elseif ($model->status == 2) {
                                        return 'Rejected';
                                    } elseif ($model->status == 3) {
                                        return 'Used';
                                    } elseif ($model->status == 4) {
                                        return 'Transfer';
                                    }
                                },
                                'filter' => ['0' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '3' => 'Used', '4' => 'Transfer'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:100px;'],
                                'header' => 'Actions',
                                'template' => '{approve}{reject}',
                                'buttons' => [
                                    'approve' => function ($url, $model) {
                                        if ($model->status == 0) {
                                            return Html::a('Approve', $url, [
                                                        'title' => Yii::t('app', 'approve'),
                                                        'class' => 'btn btn-secondary',
                                                        'style' => 'padding: 4px 10px;border-radius: 5px;',
                                            ]);
                                        }
                                    },
                                    'reject' => function ($url, $model) {
                                        if ($model->status == 0) {
                                            return Html::a('Reject', $url, [
                                                        'title' => Yii::t('app', 'reject'),
                                                        'class' => 'btn btn-red',
                                                        'style' => 'border-radius: 5px;padding: 4px 14px;',
                                            ]);
                                        }
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'approve') {
                                        $url = Url::to(['approve', 'id' => $model->id]);
                                        return $url;
                                    }
                                    if ($action === 'reject') {
                                        $url = Url::to(['reject', 'id' => $model->id]);
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


