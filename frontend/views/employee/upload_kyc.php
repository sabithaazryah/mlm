<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Upload Your KYC';
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid dashbord_content_wrapper">
    <div class="row">
        <div class="form_wrapper">
            <?= \common\widgets\Alert::widget(); ?>
            <?php
            $form = ActiveForm::begin();
            ?>
            <div class="form_header">
                <?= Html::encode($this->title) ?>
            </div>

            <div class="form_content">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <?php if (!$model->isNewRecord) { ?>
                            <div>
                                <h4>KYC DOCUMENT</h4>
                                <img src="<?= Yii::$app->homeUrl; ?>uploads/profile_uploads/kyc_document/<?= $model->id ?>.<?= $model->photo ?>" width="250" height="250"/>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <?php $proof_types = ['1' => 'Aadhaar Card', '2' => 'License', '3' => 'Voters Id']; ?>
                            <?= $form->field($model, 'proof_type')->dropDownList($proof_types, ['prompt' => '-Choose a Proof Type-']) ?>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <?= $form->field($model, 'photo')->fileInput() ?>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 button-container">
                            <?= Html::submitButton('Upload Photo', ['class' => 'btn-common btn-form', 'name' => 'login', 'style' => '']) ?>
                            <?= Html::a('Clear', ['/employee/change-password'], ['class' => 'btn-common btn-form']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>