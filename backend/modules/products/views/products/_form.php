<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'product_name')->textInput(['autocomplete' => 'off']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'canonical_name')->textInput(['readonly' => TRUE]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                </div>
        </div>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'photo')->fileInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bv')->textInput(['maxlength' => true, 'readonly' => TRUE]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>
        </div>
        <div class="row">
                <div class='col-md-12 col-sm-12 col-xs-12'>
                        <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
                        </div>
                </div>
        </div>
        <?php ActiveForm::end(); ?>

</div>
<script>
        $(document).ready(function () {
                $('#products-product_name').keyup(function () {
                        var name = slug($(this).val());
                        $('#products-canonical_name').val(slug($(this).val()));
                });
                $('#products-price').keyup(function () {
                        var price = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {price: price},
                                url: homeUrl + 'products/products/bv',
                                success: function (data) {
                                        $('#products-bv').val(parseFloat(data));
                                }
                        });

                });
                var slug = function (str) {
                        var $slug = '';
                        var trimmed = $.trim(str);
                        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                                replace(/-+/g, '-').
                                replace(/^-|-$/g, '');
                        return $slug.toLowerCase();
                };
        });
</script>
