<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use common\models\Employee;

$this->title = 'Register';
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
        <form>
            <label for="">DISTRIBUTOR ID</label>
            <div class="input_wrapper">
                <input type="text">
                <span><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-search.png" alt="" class="img-responsive"></span>
            </div>
            <a href="#" class="btn-common">BACK</a>
        </form>
    </div>


    <div class="container-fluid dashbord_content_wrapper">
        <div class="row">
            <div class="genealogy_wrapper">
                <div class="hv-container">
                    <div class="hv-wrapper">

                        <!-- Key component -->
                        <div class="hv-item">

                            <div class="hv-item-parent">
                                <div class="person">
                                    <div class="person_img_wrapper">
                                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                    </div>
                                    <p class="name">
                                        MAHESH H<b>SW53848</b>
                                    </p>
                                </div>
                            </div>

                            <div class="hv-item-children">

                                <div class="hv-item-child">
                                    <!-- Key component -->
                                    <div class="hv-item">

                                        <div class="hv-item-parent">
                                            <div class="person">
                                                <div class="person_img_wrapper gold">
                                                    <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                </div>
                                                <p class="name">
                                                    MAHESH H<b>SW53848</b>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="hv-item-children">

                                            <div class="hv-item-child">
                                                <div class="person">
                                                    <div class="person_img_wrapper platinum">
                                                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                    </div>
                                                    <p class="name">
                                                        MAHESH H<b>SW53848</b>
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="hv-item-child">
                                                <div class="person">
                                                    <div class="person_img_wrapper">
                                                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                    </div>
                                                    <p class="name">
                                                        MAHESH H<b>SW53848</b>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="hv-item-child">
                                    <!-- Key component -->
                                    <div class="hv-item">

                                        <div class="hv-item-parent">
                                            <div class="person">
                                                <div class="person_img_wrapper">
                                                    <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                </div>
                                                <p class="name">
                                                    MAHESH H<b>SW53848</b>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="hv-item-children">

                                            <div class="hv-item-child">
                                                <div class="person">
                                                    <div class="person_img_wrapper">
                                                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                    </div>
                                                    <p class="name">
                                                        MAHESH H<b>SW53848</b>
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="hv-item-child">
                                                <div class="person">
                                                    <div class="person_img_wrapper">
                                                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/placeholder-img.png" alt="" class="img-responsive">
                                                    </div>
                                                    <p class="name">
                                                        MAHESH H<b>SW53848</b>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tree_labels">
                        <ul>
                            <li>
                                <div class="person_img_wrapper gold">
                                    <img src="images/placeholder-img.png" alt="" class="img-responsive">
                                </div>
                                <label>GOLD</label>
                            </li>
                            <li>
                                <div class="person_img_wrapper platinum">
                                    <img src="images/placeholder-img.png" alt="" class="img-responsive">
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