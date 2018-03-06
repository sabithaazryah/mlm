<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetLogin extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dash/css/bootstrap.min.css',
        'dash/css/sb-admin.css',
        'dash/css/admin.css',
        'dash/css/morris.css',
        'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,900',
        'dash/css/font-awesome.min.css',
        'dash/css/custom.css',
    ];
    public $js = [
        'dash/js/jquery.js',
        'dash/js/jquery.matchHeight-min.js',
        'dash/js/bootstrap.min.js',
        'dash/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
