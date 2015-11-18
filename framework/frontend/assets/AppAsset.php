<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $js = [

        'js/main.js',
        'js/owl.carousel.min.js',
        'js/echo.min.js',
        'js/wow.min.js',
        'js/jquery.customSelect.min.js',
        'js/bootstrap-slider.min.js',
        'js/scripts.js',
    ];
    public $css = [
        'css/main.css',
//        'css/style.css',
        'css/color.css',
        'css/owl.carousel.css',
        'css/owl.transitions.css',
        'css/animate.min.css',
        'css/font-awesome.min.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
