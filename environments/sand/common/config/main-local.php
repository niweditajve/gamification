<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=crm',
            'username' => 'root',
            'password' => 'abcd1234',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
        'mailer' => ['class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'email-smtp.us-east-1.amazonaws.com',
                'username' => 'AKIAJRPUPIQ5GJMAO7NA',
                'password' => 'Aq0mu2BLEAjhFmtaA636AzsT3Uo8j/KM1auJE+BcpNXO',
                'port' => '587',
                'encryption' => 'tls',
            ]
        ],
        
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//        ],
    ],
];
