<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */

$this->title = 'Create Epin Request';
$this->params['breadcrumbs'][] = ['label' => 'Epin Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid dashbord_content_wrapper">
    <div class="row">
        <div class="form_wrapper">
            <?= \common\widgets\Alert::widget(); ?>
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>

