<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Employee;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Create Employee';
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
                                <div class="panel-body">
                                        <div class="employee-create">
                                                <?php $form = ActiveForm::begin(); ?>
                                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                        <?php $employees = Employee::find()->where(['status' => 1])->all(); ?>
                                                        <?= $form->field($model, 'employee_id')->dropdownList(ArrayHelper::map($employees, 'id', 'distributor_name')) ?>

                                                </div>

                                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
                                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
                                                </div>
                                                <?php ActiveForm::end(); ?>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

