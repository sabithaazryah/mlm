<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAssetLogin;
use yii\helpers\Html;

AppAssetLogin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="login" lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>

        <?php $this->beginBody() ?>

        <?php echo $content; ?>

        <?php $this->endBody() ?>


    </body>

</html>
<?php $this->endPage() ?>