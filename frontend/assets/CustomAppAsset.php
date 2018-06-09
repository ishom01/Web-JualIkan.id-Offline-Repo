<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CustomAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/linearicons.css',
        'css/font-awesome.min.css',
        'css/magnific-popup.css',
        'css/nice-select.css',
        'css/bootstrap.css',
        'css/main.css',
        // 'css/new-age.min.css',
        'css/site.css',
        // 'css/site.css',
        // 'css/site.css',
    ];
    public $js = [
        'js/vendor/jquery-2.2.4.min.js',
        'js/vendor/bootstrap.min.js',
        'js/vendor/bootstrap.min.js',
        'js/jquery.nice-select.min.js',
        'js/jquery.sticky.js',
        'js/parallax.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/waypoints.min.js',
        'js/jquery.counterup.min.js',
        'js/main.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
