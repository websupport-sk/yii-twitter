<?php if (	Yii::app()->user->hasFlash('info') || 
			Yii::app()->user->hasFlash('error') || 
			Yii::app()->user->hasFlash('warning') || 
			Yii::app()->user->hasFlash('success') ) { ?>

		<?php if (Yii::app()->user->hasFlash('info')) { ?>
			<div class="alert-message info">
				<strong><?= Yii::t('yii', 'Info') ?></strong>: <?= Yii::app()->user->getFlash('info') ?>
			</div>
		<?php } ?>

		<?php if (Yii::app()->user->hasFlash('error')) { ?>
			<div class="alert-message error">
				<strong><?= Yii::t('yii', 'Error')?></strong>: <?= Yii::app()->user->getFlash('error') ?>
			</div>
		<?php } ?>

		<?php if (Yii::app()->user->hasFlash('warning')) { ?>
			<div class="alert-message warning">
				<strong><?= Yii::t('yii', 'Warning')?></strong>: <?= Yii::app()->user->getFlash('warning') ?>
			</div>
		<?php } ?>

		<?php if (Yii::app()->user->hasFlash('success')) { ?>
			<div class="alert-message success">
				<strong><?= Yii::t('yii', 'Success')?></strong>: <?= Yii::app()->user->getFlash('success') ?>
			</div>
		<?php } ?>

<?php } ?>
