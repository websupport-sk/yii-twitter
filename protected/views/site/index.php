<?php $webUser = Yii::app()->user ?>

<h2>Lorem ipsum</h2>
<p>dolor sit amet, consectetur adipiscing elit. Praesent convallis libero orci. Sed aliquam dui ut lectus facilisis rutrum. In metus diam, elementum eu facilisis eleifend, mollis in elit. Morbi interdum urna non nulla adipiscing aliquet dignissim urna placerat. Vestibulum in lorem ac tortor lobortis pulvinar. Vestibulum viverra feugiat turpis id dictum. Phasellus ultricies aliquam dui id condimentum. Vestibulum tristique, odio nec congue sollicitudin, magna eros tincidunt risus, id imperdiet nunc velit congue dui. Vestibulum fringilla lobortis porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer faucibus purus nec erat vestibulum dictum faucibus lectus volutpat. Nam sed libero leo, non dignissim tortor.</p>

<?php if ($webUser->isGuest) { ?>
	<p><a class="twitter-connect-button" href="<?= $this->createUrl('/oauth/twitter') ?>">connect with twitter</a></p>
<?php } else { ?>
	<?php CVarDumper::dump($webUser->getState('id'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('screenName'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('twitterId'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('name'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('bio'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('profileImageUrl'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('oauthProvider'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('oauthKey1'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('oauthKey2'), 2, TRUE) ?><br>
	<?php CVarDumper::dump($webUser->getState('identity'), 2, TRUE) ?><br>
<?php } ?>

<p>Pellentesque non enim vel sem convallis blandit. Nullam nunc neque, dapibus nec molestie vel, pretium et metus. Aliquam lacinia ante in mauris condimentum egestas eu ac erat. Aenean at quam et tortor consectetur sodales. Etiam non velit eu quam volutpat porttitor quis id nisi. Duis suscipit, felis eget faucibus blandit, libero enim commodo arcu, rutrum commodo sapien sapien eu ipsum. Ut et blandit metus. Etiam nec ullamcorper ligula. Quisque mi nulla, consectetur id molestie eget, laoreet vitae dui. Duis in nunc a libero sagittis venenatis vitae ac elit. Aenean et leo ut elit tristique rutrum. Maecenas dignissim lectus eget tortor malesuada fermentum. Integer et diam purus, et convallis neque. Cras euismod viverra nisl, ac blandit urna tempus sed. Fusce congue enim sed tortor vestibulum suscipit.</p>
