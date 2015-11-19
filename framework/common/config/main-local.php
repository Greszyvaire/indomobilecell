<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=localhost;dbname=landa2_cms',
            'dsn' => 'mysql:host=localhost;dbname=landa_indomobilecell',
            'username' => 'root',
            'password' => 'landak',
            'charset' => 'utf8',
            'tablePrefix'=>'',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '103.27.206.203',
                'username' => 'noreply@indomobilecell.com',
                'password' => 'landak',
                'port' => '587',
//                'encryption' => 'ssl',
            ],
        ],
    ],
];
