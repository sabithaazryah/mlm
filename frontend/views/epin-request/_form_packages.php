<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EpinRequest */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
for ($i = 1; $i <= $number_of_pin; $i++) {
    ?>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" for="epinrequest-type">Package <?= $i ?></label>
            <select id="package-<?= $i ?>" class="form-control" name="package[<?= $i ?>]" aria-required="true" aria-invalid="false">
                <option value="">select package</option>
                <?php foreach ($packages as $value) { ?>
                    <option value = "<?= $value->id ?>"><?= $value->name . ' - ' . $value->amount ?></option>
                <?php }
                ?>
        </select>
    </div>
</div>
<?
}
?>