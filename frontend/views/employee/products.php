<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use common\models\Employee;
use common\models\PinRequestDetails;
use yii\helpers\ArrayHelper;
use common\models\State;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
        <?php $form = ActiveForm::begin(['id' => '']); ?>
        <input type="hidden" name="employee" value="<?= $employee ?>"/>
        <div class="row">

                <label>Customer Id : </label><?= $employee_data->user_name ?>
                <label>Ref ID : </label><?= $employee_data->referal_id ?>
        </div>

        <div class="row">

                <table class="table table-bordered table-striped">
                        <tr>
                                <th>Sl.No</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Tiotal Amount / BV</th>
                        </tr>

                        <?php
                        $p = 0;
                        foreach ($model as $value) {
                                $p++;
                                ?>
                                <tr>
                                        <td><?= $p ?></td>
                                        <td><?= $value->product_name ?>
                                                <input type="hidden" name="create[product][]" value="<?= $value->id ?>" class="form-control"/></td>
                                        <td><input type="text" name="create[price][]" value="<?= $value->price ?>" readonly="true"/></td>
                                        <td><select name="create[qty][]"  class="form-control product-qty" id="<?= $value->id ?>">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                </select></td>
                                        <td>
                                                <input type="text" name="create[amount][]" readonly="true" id="productamount-<?= $value->id ?>"/>
                                                <input type="text" name="create[bv][]" style="margin-left: 10px" readonly="true" id="productbv-<?= $value->id ?>"/>
                                        </td>
                                </tr>

                        <?php }
                        ?>
                </table>


        </div>

        <div class="row">

                <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('.product-qty').change(function () {
                        var product = $(this).attr('id');
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {qty: $(this).val(), product: product},
                                url: homeUrl + 'employee/product-details',
                                success: function (data) {
                                        var res = $.parseJSON(data);
                                        $("#productamount-" + product).val(res['amount']);
                                        $("#productbv-" + product).val(res['bv']);
                                }
                        });
                });


        });
</script>