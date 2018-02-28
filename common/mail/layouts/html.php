<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
                <title><?= Html::encode($this->title) ?></title>
                <?php $this->head() ?>
                <style>
                        .main-content p{
                                line-height: 1.8;
                        }
                </style>
        </head>
        <body style="font-family: sans-serif !important;">
                <?php $this->beginBody() ?>
                <div style="/* margin: 20px 200px 0px 300px; */border: 1px solid #9E9E9E;">
                        <table border ="0"  class="main-tabl" border="0" style="width:100%;">
                                <thead>
                                        <tr>
                                                <th style="width:100%">
                                                        <div class="header" style="padding-bottom: 0px;">
                                                                <div class="main-header">
                                                                        <div class="" style=";padding-left: 40px;text-align: center;">
                                                                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/images/logo.png', $options = ['width' => '']) ?>
                                                                        </div>
                                                                </div>
                                                                <br/>

                                                        </div>
                                                </th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                                <td style="width:100%">
                                                        <?= $content ?>
                                                        <hr style="    border: 1px solid #909488;">
                                                                <div class="main-content" style="text-align:center;">
                                                                        <p style="margin:0px;font-size: 13px;"><a href="mailto:info@smartway.in" style="color:#501a8f;text-decoration: none;"><span style="font-weight: 600;">Email : </span></i>info@smartway.in</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="#" style="color:#501a8f;text-decoration: none;"><span style="font-weight: 600;">Web : </span>smartway.in</a></p>
                                                                        <br/>
                                                                </div>
                                                </td>
                                        </tr>
                                </tbody>
                        </table>
                </div>
                <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
