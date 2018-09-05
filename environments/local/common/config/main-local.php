<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=sandbox_crm',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],      
        // 'mailer' => ['class' => 'yii\swiftmailer\Mailer',
            // 'viewPath' => '@app/mailer',
            // 'useFileTransport' => false,
            // 'transport' => [
                // 'class' => 'Swift_SmtpTransport',
                // 'host' => 'email-smtp.us-east-1.amazonaws.com',
                // 'username' => 'AKIAJRPUPIQ5GJMAO7NA',
                // 'password' => 'Aq0mu2BLEAjhFmtaA636AzsT3Uo8j/KM1auJE+BcpNXO',
                // 'port' => '587',
                // 'encryption' => 'tls',
            // ]
        // ],
        
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],
    ],
];
