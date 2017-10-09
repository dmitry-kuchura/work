<?php

return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Yii 1.1 Application',
    'preload' => ['log'],
    'import' => [
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
    ],
    'modules' => [
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => 'Enter Your Password Here',
        ],
    ],
    'components' => [
        'user' => [
            'allowAutoLogin' => true,
        ],
        'clientScript' => [
            'scriptMap' => [
                'jquery.js' => false,
                'jquery.yiiactiveform.js' => false,
            ],
//            'packages' => [
//                'yiiactiveform' => [
//                    'js' => [YII_DEBUG ? 'jquery.yiiactiveform.js' : 'jquery.yiiactiveform.js'],
//                    'position' => CClientScript::POS_END,
//                ],
//            ],
        ],
        'assetManager' => [
            'basePath' => HOST . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'assets',
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => [
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
//                [
//                    'class' => 'CWebLogRoute',
//                ],
            ],
        ],
    ],
    'params' => [
        'adminEmail' => 'webmaster@example.com',
    ],
];
