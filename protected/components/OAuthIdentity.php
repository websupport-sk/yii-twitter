<?php

class OAuthIdentity extends BaseIdentity
{

	const ERROR_VERIFY = 21;
	const ERROR_STORE = 22;


	/** @var array */
	public $config;

	/** @var string */
	public $oauthProvider;

	/** @var string */
	public $requestToken;

	/** @var string */
	public $requestTokenSecret;

	/** @var string */
	public $oauthToken;

	/** @var string */
	public $oauthVerifier;


	/**
	 * @param string $oauthProvider
	 * @param string $requestToken
	 * @param string $requestTokenSecret
	 * @param string $oauthToken
	 * @param string $oauthVerifier
	 */
	public function __construct($oauthProvider, $requestToken, $requestTokenSecret, $oauthToken, $oauthVerifier)
	{
		$this->config = Yii::app()->params[$oauthProvider];
		$this->oauthProvider = $oauthProvider;

		$this->requestToken = $requestToken;
		$this->requestTokenSecret = $requestTokenSecret;
		$this->oauthToken = $oauthToken;
		$this->oauthVerifier = $oauthVerifier;
	}

	/**
	 * @return boolean
	 */
	public function authenticate()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);

		if ('twitter' == $this->oauthProvider) {
			$twitter = new Twitter($this->config['consumerKey'], $this->config['consumerSecret'], $this->requestToken, $this->requestTokenSecret);
			$accessTokens = $twitter->request($this->config['accessTokenUrl'],  array(
				'oauth_token'    => $this->oauthToken,
				'oauth_verifier' => $this->oauthVerifier,
			));

			$twitter = new Twitter($this->config['consumerKey'], $this->config['consumerSecret'], $accessTokens['oauth_token'], $accessTokens['oauth_token_secret']);
			try {
				$verify = $twitter->request('account/verify_credentials', NULL, 'GET');
				if (!$verify) {
					throw new TwitterException(Yii::t('exceptions', 'Twitter authtentification failed'), self::ERROR_VERIFY);
				}
			} catch (TwitterException $e) {
				return !($this->errorCode = self::ERROR_VERIFY);
			}

			if ($this->storeAuth($this->oauthProvider, $verify, $accessTokens)) {
				$this->setState('id', (int) User::model()->findByAttributes(array('screenName'=>$verify->screen_name))->id);
				$this->setState('screenName', $verify->screen_name);
				$this->setState('twitterId', (int) $verify->id);
				$this->setState('name', $verify->name);
				$this->setState('bio', $verify->description);
				$this->setState('profileImageUrl', $verify->profile_image_url);
				$this->setState('oauthProvider', 'twitter');
				$this->setState('oauthKey1', $accessTokens['oauth_token']);
				$this->setState('oauthKey2', $accessTokens['oauth_token_secret']);
				$this->setState('identity', __CLASS__);
				return !($this->errorCode = self::ERROR_NONE);
			} else {
				return !($this->errorCode = self::ERROR_STORE);
			}
		}
	}

	private function storeAuth($oauthProvider, $verify, $accessTokens)
	{
		$user = User::model()->findByAttributes(array('screenName'=>$verify->screen_name));
		if (!$user) {
			$user = new User;
		}

		$user->screenName = $verify->screen_name;
		$user->oauthProvider = $oauthProvider;
		$user->oauthKey1 = $accessTokens['oauth_token'];
		$user->oauthKey2 = $accessTokens['oauth_token_secret'];

		return $user->save();
	}

}
