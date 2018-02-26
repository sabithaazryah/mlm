<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */

$this->title = 'New Epin Request';
$this->params['breadcrumbs'][] = ['label' => 'Epin Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epin-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
