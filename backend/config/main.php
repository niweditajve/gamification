<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'HughesNet Portal',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
// 'generatePasswords' => true,
// 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
            'administrators' => ['tfabbricante', 'todschenke','niweditajaysawal'],
            'enableRegistration' => FALSE,
            'enableEmailConfirmation' => FALSE,
            'allowAccountDelete' => FALSE,
            'mailParams' => [
                'fromEmail' => 'no-reply@appshughes.com',
            ]
        ],
        'gridview' => ['class' => 'kartik\grid\Module'],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
//        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['runreports'],
                    'logFile' => '@app/runtime/logs/runreports.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        // front-end
        'urlManagerF' => [
                'class' => 'yii\web\urlManager',
                'baseUrl'=>$params['frontendserver'],
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                ],

        ],
        ],
    'params' => $params,
];
