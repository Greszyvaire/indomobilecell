<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EclY9SNijghe30dGqQnJH8Pkg7epSNZk',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
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
    ],
    'params' => ['urlImg'=>'http://app.indomobilecell.com/images/'],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
