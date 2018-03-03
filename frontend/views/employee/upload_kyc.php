<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Upload Your KYC';
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row" style="margin-top: 90px;">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <?php // Html::a('<i class="fa-th-list"></i><span> Manage Admin Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

            <div class="panel-body">
                <div class="col-md-4">
                    <?php if (!$model->isNewRecord) { ?>
                        <div>
                            <h4>KYC DOCUMENT</h4>
                            <img src="<?= Yii::$app->homeUrl; ?>uploads/profile_uploads/kyc_document/<?= $model->id ?>.<?= $model->photo ?>" width="250" height="250"/>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="col-md-4">


                    <div class="employee-create">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php
                        $form = ActiveForm::begin(
                                        [
                                            'id' => 'upload-kyc',
                                            'method' => 'post',
                                            'options' => [
                                                'class' => 'login-form fade-in-effect'
                                            ]
                                        ]
                        );
                        ?>
                        <?php $proof_types = ['1' => 'Aadhaar Card', '2' => 'License', '3' => 'Voters Id']; ?>
                        <?= $form->field($model, 'proof_type')->dropDownList($proof_types, ['prompt' => '-Choose a Proof Type-']) ?>
                        <?= $form->field($model, 'photo')->fileInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Upload Photo', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'float:right;']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

        </div>
    </div>
</div>