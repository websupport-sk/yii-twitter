<?php

$yii    = __DIR__ . '/../yii/yii.php';
$config = __DIR__ . '/../protected/config/local.php';

defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
