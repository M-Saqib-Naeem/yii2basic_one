<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ccsTxVW-feK2zNxqj81qRr3GkSXunuYL',
        ],

        // changing the theme 
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/basic',
                'baseUrl' => '@web/themes/basic',
                'pathMap' => [
                    '@app/views' => '@app/themes/basic',
                ],
            ],
        ],

        // custom component
        'CalenderComponent' => [
            'class' => 'app\components\CalenderComponent'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'entry' => 'product/entry',
                'register' => 'users/register',
                'login' => 'users/login',
                'contact-us' => 'site/contact-us',
                'users/list' => 'users/user',
                
                'properties/list' => 'properties/default',
                'properties/create' => 'properties/default/create',
                'properties/edit' => 'properties/default/edit',
                
                // 'dashboard' => 'dashboard/default'
            ],
        ],
        
    ],
    'modules' => [
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\Module',
        ],
        'properties' => [
            'class' => 'app\modules\properties\Module',
        ],
    ],

    'params' => $params,

    // Application level Action
    // 'on beforeAction' => function() {
    //     echo "<p style='margin-top:100px;'>Application Action <br/></p>";
    // }

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
