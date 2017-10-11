<?php
$faker = dirname(__FILE__) . '/vendor/fzaninotto/faker/src/autoload.php';
$yii = dirname(__FILE__) . '/vendor/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__) . '/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
define('HOST', dirname(__FILE__));

require_once($faker);
require_once($yii);
Yii::createWebApplication($config)->run();
