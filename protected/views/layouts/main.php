<?php

$app		= Yii::app();
$baseUrl	= $app->baseUrl;
$cs			= $app->clientScript;
$title		= (empty($this->pageTitle)) ? $app->name : "{$this->pageTitle} :: {$app->name}";

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="websupport.sk">
	<title><?= CHtml::encode($title) ?></title>
	<?php $cs->registerCssFile("$baseUrl/css/bootstrap.min.css") ?>
	<?php $cs->registerCssFile("$baseUrl/css/main.css") ?>
</head>
<body>
<div class="container">

	<header class="topbar">
		<div class="topbar-inner">
			<div class="container">
				<h3><a href="<?= $this->createUrl('/site/index') ?>"><?php echo CHtml::encode($app->name) ?></a></h3>

				<ul class="nav secondary-nav">
					<li class="avatar">
						<?php if (!$app->user->isGuest) { ?>
							<img src="<?= CHtml::encode($app->user->getState('profileImageUrl')) ?>">
							<span class="name"><?= CHtml::encode($app->user->getState('screenName')) ?></span>
						<?php } else { ?>
							<img src="<?= "$baseUrl/images/unknown.png" ?>">
							<span class="name">unknown</span>
						<?php } ?>
					</li>
				</ul>

			</div>
		</div>
	</header>



	<div class="row">
		<div id="content" class="span16">
			<?php $this->widget('FlashMessages') ?>
			<?= $content ?>
		</div><!-- #content -->
	</div>



	<footer>
		<small><a href="http://websupport.sk">Websupport.sk</a></small>
	</footer>


</div><!-- .container -->
</body>
</html>
