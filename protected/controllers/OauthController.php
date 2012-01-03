<?php

class OauthCOntroller extends Controller
{

	public function actionIndex()
	{
		$this->redirect(array('/site/login'));
	}


	public function actionTwitter()
	{
		$me = Yii::app()->user;
		$twitterConfig = Yii::app()->params['twitter'];

		if (!$me->isGuest) { // already connected?
			$userModel = User::model()->findByPk($me->id);
			$twitter = new Twitter($twitterConfig['consumerKey'], $twitterConfig['consumerSecret'], $userModel->oauthKey1, $userModel->oauthKey2);
			try {
				$twitter->request('account/verify_credentials', NULL, 'GET');
			} catch (TwitterException $e) {
				goto connect;
			}

			$this->redirect('/site/index');
		}

connect:
		$twitter = new Twitter($twitterConfig['consumerKey'], $twitterConfig['consumerSecret']);
		$requestTokens = $twitter->request($twitterConfig['requestTokenUrl'], array(
			'oauth_callback' => $twitterConfig['callbackUrl']
		));

		$me->setState('requestTokenKey', $requestTokens['oauth_token']);
		$me->setState('requestTokenSecret', $requestTokens['oauth_token_secret']);

		$this->redirect($twitterConfig['authorizeUrl'] . "?oauth_token=$requestTokens[oauth_token]");
	}

	public function actionTwitterCallback()
	{
		$me = Yii::app()->user;
		$request = Yii::app()->request;

		if ($request->getParam('denied') || !$request->getParam('oauth_token') || !$request->getParam('oauth_verifier')) {
			$this->redirect(array('/app/checking'));
		}

		$requestToken = $me->getState('requestTokenKey');
		$requestTokenSecret = $me->getState('requestTokenSecret');
		$me->setState('requestTokenKey', NULL);
		$me->setState('requestTokenSecret', NULL);

		$identity = new OAuthIdentity('twitter', $requestToken, $requestTokenSecret, $request->getParam('oauth_token'), $request->getParam('oauth_verifier'));
		if ($identity->authenticate()) {
			$me->login($identity, 3600*24*10);
		}

		$this->redirect('/site/index');
	}

}
