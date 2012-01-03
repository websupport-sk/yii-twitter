<?php

$yiit	= __DIR__ . '/../../yii/yiit.php';
$config	= __DIR__ . '/../config/test.php';

require_once($yiit);
require_once(__DIR__ . '/WebTestCase.php');

Yii::createWebApplication($config);
