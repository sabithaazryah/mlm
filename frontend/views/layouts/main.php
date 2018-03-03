<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
        <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <script type="text/javascript">
            var homeUrl = '<?= Yii::$app->homeUrl; ?>';
        </script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (isset(Yii::$app->user->id)) {
                $menuItems = [
                    [
                        'label' => 'Profile',
                        'items' => [
                            ['label' => 'Home', 'url' => ['/site/index']],
                            ['label' => 'Change Mobile No', 'url' => ['/employee/change-mobile-no']],
                            ['label' => 'Change Password', 'url' => ['/employee/change-password']],
                            ['label' => 'Upload KYC', 'url' => ['/employee/upload-kyc']],
                        ],
                    ],
                    [
                        'label' => 'E-PIN',
                        'items' => [
                            ['label' => 'E-Pin History', 'url' => ['/epin-request/index']],
                            ['label' => 'New E-Pin Request', 'url' => ['/epin-request/create']],
                            ['label' => 'E-Pin Transfer', 'url' => ['/epin-request/epin-transfer']],
                        ],
                    ],
//                    ['label' => 'Customer Register', 'url' => ['/employee/create']],
                    ['label' => 'Tree', 'url' => ['/employee/tree']],
                ];
            }

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->user_name . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <!--                <footer class="footer">
                                <div class="container">
                                        <p class="pull-left">&copy; <?php // Html::encode(Yii::$app->name)                                   ?> <?php // date('Y')                                   ?></p>

                                        <p class="pull-right"><?php // Yii::powered()                                   ?></p>
                                </div>
                        </footer>-->

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
