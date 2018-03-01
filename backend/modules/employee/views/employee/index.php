<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
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
//                                                'placement_name',
//                                                'placement_id',
                                                'distributor_name',
//                                                'placement',
                                                // 'epin',
                                                // 'epin_number',
                                                // 'pin_price',
                                                // 'bv',
                                                // 'referal_id',
                                                // 'father_name',
                                                // 'dob',
                                                // 'gender',
                                                // 'mobile_number',
                                                // 'pincode',
                                                // 'post_office',
                                                // 'state',
                                                // 'city',
                                                // 'house_name',
                                                // 'taluk',
                                                // 'address:ntext',
                                                // 'email:email',
                                                // 'nominee_name',
                                                // 'nominee_relation',
                                                // 'ifsc_code',
                                                // 'account_no',
                                                // 'bank_name',
                                                // 'branch',
                                                // 'pan_number',
                                                // 'password',
                                                'user_name',
                                                // 'status',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn',
                                                    'template' => '{view}'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


