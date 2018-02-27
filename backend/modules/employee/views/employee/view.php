<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Employee</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="employee-view">
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
            'placement_name',
            'placement_id',
            'distributor_name',
            'placement',
            'epin',
            'epin_number',
            'pin_price',
            'bv',
            'referal_id',
            'father_name',
            'dob',
            'gender',
            'mobile_number',
            'pincode',
            'post_office',
            'state',
            'city',
            'house_name',
            'taluk',
            'address:ntext',
            'email:email',
            'nominee_name',
            'nominee_relation',
            'ifsc_code',
            'account_no',
            'bank_name',
            'branch',
            'pan_number',
            'password',
            'user_name',
            'status',
            'CB',
            'UB',
            'DOC',
            'DOU',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


