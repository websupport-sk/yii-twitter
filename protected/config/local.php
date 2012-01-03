<?php

// Web application configuration
return array(
	'basePath'	=> dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'		=> 'YII twitter',

	// preload components
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.widgets.*',
	),

	// application components
	'components'=>array(

		'user'=>array(
			'allowAutoLogin' => TRUE,
		),

		'errorHandler'=>array(
			'errorAction' => 'site/error',
		),

		'cache'=>array(
			'class' => 'system.caching.CFileCache',
			'cachePath' => NULL, // null ==> protected/runtime/cache
		),

		'session'=>array(
			'autoStart' => TRUE,
		),

		'db'=>array(
			'connectionString'      => 'mysql:host=localhost;dbname=yii_twitter',
			'emulatePrepare'        => true,
			'username'              => 'php',
			'password'              => 'php',
			'charset'               => 'utf8',
			'enableProfiling'       => YII_DEBUG,
			'enableParamLogging'	=> YII_DEBUG,
			'schemaCachingDuration'	=> YII_DEBUG ? 0 : 3600,
		),

		'urlManager'=>array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules'=>array(

				'<lang:\w{2}>/<controller:(site|oauth)>/<action:\w+>/*'			=> '<controller>/<action>',
				'<lang:\w{2}>/<controller:(site|oauth)>/<action:\w+>/<id:\d+>'	=> '<controller>/<action>',
				'<lang:\w{2}>/<controller:(site|oauth)>'						=> '<controller>',
			),
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
//				array(
//					'class'=>'CWebLogRoute',
//					'categories'=>'system.db.CDbCommand',
//					//'showInFireBug'=>true,
//				),
//				array(
//					'class' => 'CProfileLogRoute',
//					'enabled' => YII_DEBUG,
//					'showInFireBug' => true,
//				),
			),
		),
	),

	// application parameters
	'params'=>array(

		'twitter'=>array(
			'consumerKey'		=> 'CONSUMER_KEY',
			'consumerSecret'	=> 'CONSUMER_SECET',
			'accessToken'		=> 'ACCESS_TOKEN',
			'accessTokenSecret'	=> 'ACCESS_TOKEN_SECRET',
			'requestTokenUrl'	=> 'https://api.twitter.com/oauth/request_token',
			'authorizeUrl'		=> 'https://api.twitter.com/oauth/authorize',
			'accessTokenUrl'	=> 'https://api.twitter.com/oauth/access_token',
			'callbackUrl'		=> 'http://yii-twitter.test/oauth/twitterCallback', // set by your devel env.
		),
	),
);
