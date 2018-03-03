<?php

use yii\helpers\Html;
Use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EpinRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Epin Requests History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epin-request-index">

    <div class="row" style="margin-top: 70px;">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-transform: uppercase;padding-top: 13px;"><?= Html::encode($this->title) ?></h3>
                    <?= Html::a('<i class="fa fa-plus"></i><span> New Epin Request</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float: right']) ?>
                </div>
                <div class="panel-body">
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                        'pager' => [
                            'firstPageLabel' => 'first',
                            'lastPageLabel' => 'last',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'maxButtonCount' => 3,
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


