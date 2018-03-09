<?php

namespace frontend\controllers;

class MailController extends \yii\web\Controller {

    public function actionIndex() {
        $to = "manuko27@gmail.com";
        $subject = "My subject";
        $txt = "Hello world!";
        $headers = "From: armnetlifestyle@server.armnetlifestyle.com" . "\r\n";
        if (mail($to, $subject, $txt, $headers))
            die('if');
        else
            die('else');
    }

}
