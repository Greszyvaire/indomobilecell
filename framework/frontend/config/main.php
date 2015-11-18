<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php')
//        , require(__DIR__ . '/../../common/config/params-local.php')
//        , require(__DIR__ . '/params.php')
//        , require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'landa' => ['class' => 'common\components\LandaCore'],
        'meta' => [
            'class' => 'ptheofan\meta\Meta',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'coba' => 'site/coba',
                'kontak-kami' => 'site/contact',
                'detail/<cat1>/<cat2>/<alias>' => 'product/view',
                'cat/<alias>' => 'product/category',
                'destination' => 'product/destination',
                'status-order' => 'product/listorder',
                'detail-pesanan/<id:\d+>' => 'product/invoice',
                'konfirmasi-pembayaran/<id:\d+>' => 'payment/create',
                'register' => 'user/create',
                'category/<id:\d+>/<cat1>/<cat2>' => 'product/list',
                'pencarian' => 'product/search',
                'edit-profile/<id:\d+>' => 'user/update',
                'lupa-password' => 'user/forgotpassword',
                'reset-password/<alias>' => 'user/resetpassword',
                'cart' => 'product/cart',
                '<alias>' => 'article/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
