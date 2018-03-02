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

$this->title = 'Wallet Purchase';
$this->params['breadcrumbs'][] = $this->title;
$count = count($model);
$employee_package = \common\models\EmployeePackage::find()->where(['employee_id' => $employee_data->id])->orderBy(['id' => SORT_DESC])->one();
?>
<div class="site-signup">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'employee-wallet']); ?>

        <input type="hidden" name="employee" value="<?= $employee ?>"/>
        <input type="hidden" name="employee_total_price" id="employee_total_price" value="<?= $employee_package->price ?>"/>
        <input type="hidden" name="employee_total_bv" id="employee_total_bv" value="<?= $employee_package->bv ?>"/>
        <input type="hidden" name="product_count" id="product_count" value="<?= $count ?>"/>
        <div class="row">

                <label>Customer Id : </label><?= $employee_data->user_name ?><br>
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
                                        <td><select name="create[qty][]"  class="form-control product-qty" id="<?= $value->id ?>" count="<?= $p ?>">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                </select>
                                        </td>
                                        <td>
                                                <input type="text" name="create[amount][]" readonly="true" id="productamount-<?= $p ?>"/>
                                                <input type="text" name="create[bv][]" style="margin-left: 10px" readonly="true" id="productbv-<?= $p ?>"/>
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
                        var count = $(this).attr('count');
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {qty: $(this).val(), product: product},
                                url: homeUrl + 'employee/product-details',
                                success: function (data) {
                                        var res = $.parseJSON(data);
                                        $("#productamount-" + count).val(res['amount']);
                                        $("#productbv-" + count).val(res['bv']);
                                        var status = checkprice();
                                        if (status == 1) {
                                                alert('Choosed product amount/bv exceeds your package amount/bv!!');
                                        }
                                }
                        });
                });

                $(document).on('submit', '#employee-wallet', function (e) {
                        var status = checkprice();
                        if (status == 1) {
                                alert('Choosed product amount/bv exceeds your package amount/bv!!');
                                e.preventDefault();
                                return false;
                        } else {
                                return true;
                        }
                });


        });
        function checkprice() {
                var flag = 0;
                var employee_price = $('#employee_total_price').val();
                var employee_bv = $('#employee_total_bv').val();
                var count = $('#product_count').val();
                var product_total_price = 0;
                var product_total_bv = 0;
                for ($i = 0; $i <= count; $i++) {
                        var product_price = 0;
                        var product_bv = 0;
                        if ($('#productamount-' + $i).val()) {
                                product_price = $('#productamount-' + $i).val();
                                product_total_price += parseInt(product_price);
                                product_bv = $('#productbv-' + $i).val();
                                product_total_bv += parseInt(product_bv);
                        }

                }
                if (product_total_price > employee_price || product_total_bv > employee_bv) {
                        flag = 1;
                }
                return flag;

        }
</script>