<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use common\models\Employee;

$this->title = 'PROFIT CLUB GENEALOGY DETAILS';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #page-wrapper{
        padding: 0px;
    }
</style>

<div id="page-wrapper" class="genealogy_page_wrapper">

    <div class="genealogy_header">
        <h4>Profit Club Genealogy Details</h4>
        <?= Html::beginForm(['employee/tree-search'], 'post') ?>
        <label for="">DISTRIBUTOR ID</label>
        <div class="input_wrapper">
            <input type="text" value="<?= $emp_details->user_name ?>" name="distributor_name"/>
            <span><?= Html::submitButton('<i class="fa fa-search"></i>', ['style' => 'background: transparent;border: none;']) ?></span>
        </div>
        <?= Html::a('BACK', Yii::$app->request->referrer, ['class' => 'btn-common']) ?>
        <?= Html::endForm() ?>
    </div>


    <div class="container-fluid dashbord_content_wrapper">
        <div class="row">
            <div class="genealogy_wrapper">
                <div class="hv-container">
                    <div class="hv-wrapper">

                        <!-- Key component -->
                        <div class="hv-item">
                            <?php
                            $subchild1_right = 0;
                            $subchild1_left = 0;
                            $subchild2_right = 0;
                            $subchild2_left = 0;
                            $subchild3_right = 0;
                            $subchild3_left = 0;
                            if (!empty($emp_details)) {
                                ?>
                                <?php
                                $emp_details_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_details->id])->one();
                                if (isset($emp_details_bv)) {
                                    $emp_details_bv_total_left_bv = $emp_details_bv->total_left_bv;
                                    $emp_details_bv_current_left_bv = $emp_details_bv->current_left_bv;
                                    $emp_details_bv_total_right_bv = $emp_details_bv->total_right_bv;
                                    $emp_details_bv_current_right_bv = $emp_details_bv->current_right_bv;
                                } else {
                                    $emp_details_bv_total_left_bv = 0.00;
                                    $emp_details_bv_current_left_bv = 0.00;
                                    $emp_details_bv_total_right_bv = 0.00;
                                    $emp_details_bv_current_right_bv = 0.00;
                                }
                                ?>
                                <div class="hv-item-parent">
                                    <div class="person">
                                        <div class="detail">
                                            <p>Total Left BV : <?= $emp_details_bv_total_left_bv ?></p>
                                            <p>Total Right BV : <?= $emp_details_bv_total_right_bv ?></p>
                                            <p>Current Left BV : <?= $emp_details_bv_current_left_bv ?></p>
                                            <p>Current Right BV : <?= $emp_details_bv_current_right_bv ?></p>
                                        </div>
                                        <div class="person_img_wrapper">
                                            <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_details->id)], ['class' => '', 'style' => '']) ?>
                                        </div>
                                        <p class="name">
                                            <?= $emp_details->distributor_name ?><b><?= $emp_details->user_name ?></b>
                                        </p>
                                    </div>
                                </div>
                                <div class="hv-item-children">
                                    <?php
                                    $emp_child1_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_details->id])->one();
                                    $emp_child1_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_details->id])->one();
                                    ?>
                                    <?php
                                    if (!empty($emp_child1_left)) {
                                        $subchild1_left = 1;
                                        ?>
                                        <?php
                                        $total_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_child1_left->id])->one();
                                        if (isset($total_bv)) {
                                            $total_bv_total_left_bv = $total_bv->total_left_bv;
                                            $total_bv_current_left_bv = $total_bv->current_left_bv;
                                            $total_bv_total_right_bv = $total_bv->total_right_bv;
                                            $total_bv_current_right_bv = $total_bv->current_right_bv;
                                        } else {
                                            $total_bv_total_left_bv = 0.00;
                                            $total_bv_current_left_bv = 0.00;
                                            $total_bv_total_right_bv = 0.00;
                                            $total_bv_current_right_bv = 0.00;
                                        }
                                        ?>
                                        <div class="hv-item-child">
                                            <!-- Key component -->
                                            <div class="hv-item">

                                                <div class="hv-item-parent">
                                                    <div class="person">
                                                        <div class="detail">
                                                            <p>Total Left BV : <?= $total_bv_total_left_bv ?></p>
                                                            <p>Total Right BV : <?= $total_bv_total_right_bv ?></p>
                                                            <p>Current Left BV : <?= $emp_details_bv_current_left_bv ?></p>
                                                            <p>Current Right BV : <?= $total_bv_current_right_bv ?></p>
                                                        </div>

                                                        <div class="person_img_wrapper">
                                                            <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id)], ['class' => '', 'style' => '']) ?>
                                                        </div>
                                                        <p class="name">
                                                            <?= $emp_child1_left->distributor_name ?><b><?= $emp_child1_left->user_name ?></b>
                                                        </p>
                                                    </div>
                                                    <?php
                                                    $emp_subchild1_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_child1_left->id])->one();
                                                    $emp_subchild1_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_child1_left->id])->one();
                                                    ?>
                                                </div>
                                                <div class="hv-item-children">
                                                    <?php
                                                    if (!empty($emp_subchild1_left)) {
                                                        $subchild2_left = 1;
                                                        ?>
                                                        <?php $emp_subchild1_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild1_left->id])->one() ?>
                                                        <div class="hv-item-child">
                                                            <div class="hv-item-parent">
                                                                <div class="person">
                                                                    <div class="detail">
                                                                        <p>Total Left BV : <?= $emp_subchild1_left_bv->total_left_bv ?></p>
                                                                        <p>Total Right BV : <?= $emp_subchild1_left_bv->total_right_bv ?></p>
                                                                        <p>Current Left BV : <?= $emp_subchild1_left_bv->current_left_bv ?></p>
                                                                        <p>Current Right BV : <?= $emp_subchild1_left_bv->current_right_bv ?></p>
                                                                    </div>

                                                                    <div class="person_img_wrapper">
                                                                        <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id)], ['class' => '', 'style' => '']) ?>
                                                                    </div>
                                                                    <p class="name">
                                                                        <?= $emp_subchild1_left->distributor_name ?><b><?= $emp_subchild1_left->user_name ?></b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="hv-item-children">
                                                                <?php
                                                                $emp_subchild3_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild1_left->id])->one();
                                                                $emp_subchild3_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild1_left->id])->one();
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild3_left)) {
                                                                    ?>
                                                                    <?php $emp_subchild3_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild3_left->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild3_left_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild3_left_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild3_left_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild3_left_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_left->id)], ['class' => '', 'style' => '']) ?>
                                                                                <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild3_left->distributor_name ?><b><?= $emp_subchild3_left->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild3_right)) {
                                                                    ?>

                                                                    <?php $emp_subchild3_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild3_right->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild3_right_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild3_right_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild3_right_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild3_right_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_right->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild3_right->distributor_name ?><b><?= $emp_subchild3_right->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person">
                                                                                <div class="person_img_wrapper addmore">
                                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                                </div>
                                                                                <p class="name">
                                                                                    Join<b>Here</b>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="hv-item-child">
                                                            <div class="person hv-has-child">
                                                                <div class="person_img_wrapper addmore">
                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                </div>
                                                                <p class="name">
                                                                    Join<b>Here</b>
                                                                </p>
                                                            </div>

                                                            <div class="hv-item-children">

                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>


                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    <?php }
                                                    ?>
                                                    <?php
                                                    if (!empty($emp_subchild1_right)) {
                                                        $subchild2_right = 1;
                                                        ?>
                                                        <?php $emp_subchild1_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild1_right->id])->one() ?>
                                                        <div class="hv-item-child">
                                                            <div class="hv-item-parent">
                                                                <div class="person">
                                                                    <div class="detail">
                                                                        <p>Total Left BV : <?= $emp_subchild1_right_bv->total_left_bv ?></p>
                                                                        <p>Total Right BV : <?= $emp_subchild1_right_bv->total_right_bv ?></p>
                                                                        <p>Current Left BV : <?= $emp_subchild1_right_bv->current_left_bv ?></p>
                                                                        <p>Current Right BV : <?= $emp_subchild1_right_bv->current_right_bv ?></p>
                                                                    </div>

                                                                    <div class="person_img_wrapper">
                                                                        <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id)], ['class' => '', 'style' => '']) ?>
                                                                    </div>
                                                                    <p class="name">
                                                                        <?= $emp_subchild1_right->distributor_name ?><b><?= $emp_subchild1_right->user_name ?></b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="hv-item-children">
                                                                <?php
                                                                $emp_subchild4_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild1_right->id])->one();
                                                                $emp_subchild4_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild1_right->id])->one();
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild4_left)) {
                                                                    ?>
                                                                    <?php $emp_subchild4_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild4_left->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild4_left_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild4_left_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild4_left_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild4_left_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild4_left->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild4_left->distributor_name ?><b><?= $emp_subchild4_left->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild4_right)) {
                                                                    ?>

                                                                    <?php $emp_subchild4_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild4_right->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild4_right_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild4_right_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild4_right_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild4_right_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild4_right->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild4_right->distributor_name ?><b><?= $emp_subchild4_right->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="hv-item-child">
                                                            <div class="person hv-has-child">
                                                                <div class="person_img_wrapper addmore">
                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                </div>
                                                                <p class="name">
                                                                    Join<b>Here</b>
                                                                </p>
                                                            </div>

                                                            <div class="hv-item-children">

                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>


                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else {
                                        ?>
                                        <div class="hv-item-child">
                                            <!-- Key component -->
                                            <div class="hv-item">

                                                <div class="hv-item-parent">
                                                    <div class="person">
                                                        <div class="person_img_wrapper addmore">
                                                            <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_details->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                        </div>
                                                        <p class="name">
                                                            Join<b>Here</b>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="hv-item-children">

                                                    <div class="hv-item-child">
                                                        <div class="person hv-has-child">
                                                            <div class="person_img_wrapper">
                                                            </div>
                                                            <p class="name">
                                                                Vacant<b></b>
                                                            </p>
                                                        </div>

                                                        <div class="hv-item-children">

                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>


                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="hv-item-child">
                                                        <div class="person hv-has-child">
                                                            <div class="person_img_wrapper">
                                                            </div>
                                                            <p class="name">
                                                                Vacant<b></b>
                                                            </p>
                                                        </div>

                                                        <div class="hv-item-children">

                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>


                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <?php
                                    if (!empty($emp_child1_right)) {
                                        $subchild1_right = 1;
                                        ?>
                                        <?php $emp_child1_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_child1_right->id])->one() ?>
                                        <div class="hv-item-child">
                                            <!-- Key component -->
                                            <div class="hv-item">

                                                <div class="hv-item-parent">
                                                    <div class="person">
                                                        <div class="detail">
                                                            <p>Total Left BV : <?= $emp_child1_right_bv->total_left_bv ?></p>
                                                            <p>Total Right BV : <?= $emp_child1_right_bv->total_right_bv ?></p>
                                                            <p>Current Left BV : <?= $emp_child1_right_bv->current_left_bv ?></p>
                                                            <p>Current Right BV : <?= $emp_child1_right_bv->current_right_bv ?></p>
                                                        </div>

                                                        <div class="person_img_wrapper">
                                                            <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id)], ['class' => '', 'style' => '']) ?>
                                                        </div>
                                                        <p class="name">
                                                            <?= $emp_child1_right->distributor_name ?><b><?= $emp_child1_right->user_name ?></b>
                                                        </p>
                                                    </div>
                                                    <?php
                                                    $emp_subchild2_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_child1_right->id])->one();
                                                    $emp_subchild2_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_child1_right->id])->one();
                                                    ?>
                                                </div>
                                                <div class="hv-item-children">
                                                    <?php
                                                    if (!empty($emp_subchild2_left)) {
                                                        $subchild3_left = 1;
                                                        ?>
                                                        <?php $emp_subchild1_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild1_left->id])->one() ?>
                                                        <div class="hv-item-child">
                                                            <div class="hv-item-parent">
                                                                <div class="person">
                                                                    <div class="detail">
                                                                        <p>Total Left BV : <?= $emp_subchild1_left_bv->total_left_bv ?></p>
                                                                        <p>Total Right BV : <?= $emp_subchild1_left_bv->total_right_bv ?></p>
                                                                        <p>Current Left BV : <?= $emp_subchild1_left_bv->current_left_bv ?></p>
                                                                        <p>Current Right BV : <?= $emp_subchild1_left_bv->current_right_bv ?></p>
                                                                    </div>

                                                                    <div class="person_img_wrapper">
                                                                        <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_left->id)], ['class' => '', 'style' => '']) ?>
                                                                    </div>
                                                                    <p class="name">
                                                                        <?= $emp_subchild2_left->distributor_name ?><b><?= $emp_subchild2_left->user_name ?></b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="hv-item-children">
                                                                <?php
                                                                $emp_subchild5_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild2_left->id])->one();
                                                                $emp_subchild5_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild2_left->id])->one();
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild5_left)) {
                                                                    ?>
                                                                    <?php $emp_subchild5_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild5_left->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild5_left_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild5_left_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild5_left_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild5_left_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild5_left->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild5_left->distributor_name ?><b><?= $emp_subchild5_left->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild5_right)) {
                                                                    ?>

                                                                    <?php $emp_subchild5_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild5_right->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild5_right_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild5_right_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild5_right_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild5_right_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild5_right->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild5_right->distributor_name ?><b><?= $emp_subchild5_right->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person">
                                                                                <div class="person_img_wrapper addmore">
                                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                                </div>
                                                                                <p class="name">
                                                                                    Join<b>Here</b>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="hv-item-child">
                                                            <div class="person hv-has-child">
                                                                <div class="person_img_wrapper addmore">
                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                </div>
                                                                <p class="name">
                                                                    Join<b>Here</b>
                                                                </p>
                                                            </div>

                                                            <div class="hv-item-children">

                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>


                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    <?php }
                                                    ?>
                                                    <?php
                                                    if (!empty($emp_subchild2_right)) {
                                                        $subchild3_right = 1;
                                                        ?>
                                                        <?php $emp_subchild2_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild2_right->id])->one() ?>
                                                        <div class="hv-item-child">
                                                            <div class="hv-item-parent">
                                                                <div class="person">
                                                                    <div class="detail">
                                                                        <p>Total Left BV : <?= $emp_subchild2_right_bv->total_left_bv ?></p>
                                                                        <p>Total Right BV : <?= $emp_subchild2_right_bv->total_right_bv ?></p>
                                                                        <p>Current Left BV : <?= $emp_subchild2_right_bv->current_left_bv ?></p>
                                                                        <p>Current Right BV : <?= $emp_subchild2_right_bv->current_right_bv ?></p>
                                                                    </div>

                                                                    <div class="person_img_wrapper">
                                                                        <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_right->id)], ['class' => '', 'style' => '']) ?>
                                                                    </div>
                                                                    <p class="name">
                                                                        <?= $emp_subchild2_right->distributor_name ?><b><?= $emp_subchild2_right->user_name ?></b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="hv-item-children">
                                                                <?php
                                                                $emp_subchild6_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild2_right->id])->one();
                                                                $emp_subchild6_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild2_right->id])->one();
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild6_left)) {
                                                                    ?>
                                                                    <?php $emp_subchild6_left_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild6_left->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild6_left_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild6_left_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild6_left_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild6_left_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild6_left->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild6_left->distributor_name ?><b><?= $emp_subchild6_left->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <?php
                                                                if (!empty($emp_subchild6_right)) {
                                                                    ?>

                                                                    <?php $emp_subchild6_right_bv = \common\models\EmployeeTree::find()->where(['employee_id' => $emp_subchild6_right->id])->one() ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="detail">
                                                                                <p>Total Left BV : <?= $emp_subchild6_right_bv->total_left_bv ?></p>
                                                                                <p>Total Right BV : <?= $emp_subchild6_right_bv->total_right_bv ?></p>
                                                                                <p>Current Left BV : <?= $emp_subchild6_right_bv->current_left_bv ?></p>
                                                                                <p>Current Right BV : <?= $emp_subchild6_right_bv->current_right_bv ?></p>
                                                                            </div>

                                                                            <div class="person_img_wrapper">
                                                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'dash/images/placeholder-img.png" alt="" class="img-responsive">', ['genealogy-view', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild6_left->id)], ['class' => '', 'style' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?= $emp_subchild6_right->distributor_name ?><b><?= $emp_subchild6_right->user_name ?></b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } else {
                                                                    ?>
                                                                    <div class="hv-item-child">
                                                                        <div class="person">
                                                                            <div class="person_img_wrapper addmore">
                                                                                <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                Join<b>Here</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="hv-item-child">
                                                            <div class="person hv-has-child">
                                                                <div class="person_img_wrapper addmore">
                                                                    <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => '']) ?>
                                                                </div>
                                                                <p class="name">
                                                                    Join<b>Here</b>
                                                                </p>
                                                            </div>

                                                            <div class="hv-item-children">

                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>


                                                                <div class="hv-item-child">
                                                                    <div class="person">
                                                                        <div class="person_img_wrapper">
                                                                        </div>
                                                                        <p class="name">
                                                                            VACANT<b></b>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else {
                                        ?>
                                        <div class="hv-item-child">
                                            <!-- Key component -->
                                            <div class="hv-item">

                                                <div class="hv-item-parent">
                                                    <div class="person">
                                                        <div class="person_img_wrapper addmore">
                                                            <?= Html::a('+', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_details->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                        </div>
                                                        <p class="name">
                                                            Join<b>Here</b>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="hv-item-children">

                                                    <div class="hv-item-child">
                                                        <div class="person hv-has-child">
                                                            <div class="person_img_wrapper">
                                                            </div>
                                                            <p class="name">
                                                                Vacant<b></b>
                                                            </p>
                                                        </div>

                                                        <div class="hv-item-children">

                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>


                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="hv-item-child">
                                                        <div class="person hv-has-child">
                                                            <div class="person_img_wrapper">
                                                            </div>
                                                            <p class="name">
                                                                Vacant<b></b>
                                                            </p>
                                                        </div>

                                                        <div class="hv-item-children">

                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>


                                                            <div class="hv-item-child">
                                                                <div class="person">
                                                                    <div class="person_img_wrapper">
                                                                    </div>
                                                                    <p class="name">
                                                                        Vacant<b></b>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>

                    <div class="tree_labels">
                        <ul>
                            <li>
                                <div class="person_img_wrapper gold">
                                    <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                </div>
                                <label>GOLD</label>
                            </li>
                            <li>
                                <div class="person_img_wrapper platinum">
                                    <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                </div>
                                <label>platinum</label></li>
                            <li>
                                <div class="person_img_wrapper addmore">
                                    <a href="#">+</a>
                                </div>
                                <label>Add more</label>
                            </li>
                            <li>
                                <div class="person_img_wrapper">

                                </div>
                                <label>Vacant</label>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>