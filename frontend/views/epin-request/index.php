<?php

use yii\helpers\Html;
Use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EpinRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Epin Requests History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid dashbord_content_wrapper">
    <div class="row">
        <div class="form_wrapper">
            <div class="form_header">
                <?= Html::encode($this->title) ?>
                <?= Html::a('<i class="fa fa-plus"></i><span> New Epin Request</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float: right']) ?>
            </div>
            <div class="panel-body table-responsive">
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

