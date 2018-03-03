<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DashboardAsset;
use common\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script type="text/javascript">
            var homeUrl = '<?= Yii::$app->homeUrl; ?>';
        </script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/logo.png" alt="" class="img-responsive"></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li><a href="#" class="callus"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-call.png" alt="" class="imgresponsive">+91 9944 000 000</a></li>
                    <li><a href="#" class="callus"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-mail.png" alt="" class="imgresponsive">info@armnetlifestyle.com</a></li>
                    <li>
                        <a href="#" class="notification active"><i><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-notification.png" alt="" class="img-responsive"></i></a>

                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user_dropdown" data-toggle="dropdown"><span class="img_wrapper"><img src="<?= Yii::$app->homeUrl; ?>dash/images/user-1.jpg" alt="" class="img-responsive"></span><span>Hello</span> John Smith <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">

                        <li>
                            <a href="charts.html"><i class=""><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-profile.png" alt="" class="img-responsive"></i> PROFILE</a>
                        </li>
                        <li>
                            <a href="tables.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-pin.png" alt="" class="img-responsive"></i>  E-pin</a>
                        </li>
                        <li>
                            <a href="forms.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-smart.png" alt="" class="img-responsive"></i>  smart club</a>
                        </li>
                        <li>
                            <a href="bootstrap-elements.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-profit.png" alt="" class="img-responsive"></i>  profit club</a>
                        </li>
                        <li>
                            <a href="bootstrap-grid.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-achievement.png" alt="" class="img-responsive"></i>  Achievement</a>
                        </li>

                        <li>
                            <a href="blank-page.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-payment.png" alt="" class="img-responsive"></i>payments</a>
                        </li>
                        <li>
                            <a href="index-rtl.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-tool.png" alt="" class="img-responsive"></i>tools</a>
                        </li>
                        <li>
                            <a href="index-rtl.html"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-repurchase.png" alt="" class="img-responsive"></i> Repurchase</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
                <?= $content ?>
            </div>

            <footer>
                <div class="container-fluid footer_wrapper">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <h3>Quick Links</h3>
                            <p><a href="#">Home</a></p>
                            <p><a href="#">About Us</a></p>
                            <p><a href="#">Our Business</a></p>
                            <p><a href="#">Product</a></p>
                            <p><a href="#">Gallery</a></p>
                            <p><a href="#">Contact</a></p>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <h3>Hello</h3>
                            <p>Door Number<br>X Building<br>99 Street/ Avenue<br>Thiruvananthapuram, Kerala</p>
                            <br>
                            <p>1800 2000 5000<br>Info@armnetlifestyle.com</p>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <h3>Social</h3>
                            <p>
                                <a href="#"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-t.png" alt="" class="img-responsive"></a>
                                <a href="#"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-f.png" alt="" class="img-responsive"></a>
                                <a href="#"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-i.png" alt="" class="img-responsive"></a>
                                <a href="#"><img src="<?= Yii::$app->homeUrl; ?>dash/images/icon-g.png" alt="" class="img-responsive"></a>
                            </p>
                        </div>

                    </div>

                    <div class="footer-info">
                        <img src="<?= Yii::$app->homeUrl; ?>dash/images/logo-footer.png" alt="" class="img-responsive">
                        <span class="info">©armnet lifestyle marketing private limited 2018</span>
                        <span class="info">All Rights reserved</span>
                    </div>
                </div>
            </footer>
            <!-- /#page-wrapper -->

        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
