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
        //  Load jquery 2.2.4 in webpack compile file
        'clientScript' => [
            'scriptMap' => [
                'jquery.js' => false,
            ],
        ],
        'assetManager' => [
            'basePath' => HOST . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'assets',
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                'api/user-create' => 'api/CreateUser',
                'api/user-update' => 'api/UpdateUser',
                'api/company-create' => 'api/CreateCompany',
                'api/company-update' => 'api/UpdateCompany',
                'api/generate-transfer-log' => 'api/GenerateTransferLog',
                'api/get-report' => 'api/GetReport',
                'api/<action>' => 'api/<action>',
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
        /**
         * Types for transferred data bytes used in form create/update companies
         */
        'types' => [
            'KB' => 'KB',
            'MB' => 'MB',
            'GB' => 'GB',
            'TB' => 'TB',
        ],
        /**
         * Months name for Report transferred traffic
         */
        'months' => [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ],
        'adminEmail' => 'webmaster@example.com',
    ],
];