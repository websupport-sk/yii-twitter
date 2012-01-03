<?php

abstract class BaseIdentity extends CComponent implements IUserIdentity
{

	const ERROR_NONE = 0;
	const ERROR_INVALID_IDENTITY = 100;


	/**
	 * @var integer Authentication error code. If there is an error, the error code will be non-zero.
	 * Calling {@link authenticate} will change this value.
	 */
	public $errorCode = self::ERROR_INVALID_IDENTITY;

	/** @var array Additional identity information that needs to be persistent during user session */
	protected $_state=array();


	/**
	 * Returns a value indicating whether the identity is authenticated.
	 * @return boolean whether the identity is valid.
	 */
	public function getIsAuthenticated()
	{
		return self::ERROR_NONE === $this->errorCode;
	}

	/**
	 * Returns a value that uniquely represents the identity.
	 * @return mixed a value that uniquely represents the identity (e.g. primary key value).
	 */
	public function getId()
	{
		return $this->getState('id');
	}

	/**
	 * Returns the display name for the identity (e.g. username).
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->getState('name');
	}

	/**
	 * Returns the additional identity information that needs to be persistent during the user session.
	 * @return array additional identity information that needs to be persistent during the user session (excluding {@link id}).
	 */
	public function getPersistentStates()
	{
		return $this->_state;
	}

	/**
	 * Gets the persisted state by the specified name
	 *
	 * @param string $name the name of the state
	 * @param mixed $defaultValue the default value to be returned if the named state does not exist
	 * @return mixed the value of the named state
	 */
	public function getState($name, $defaultValue = NULL)
	{
		return isset($this->_state[$name]) ? $this->_state[$name] : $defaultValue;
	}

	/**
	 * Sets the named state with a given value
	 *
	 * @param string $name the name of the state
	 * @param mixed $value the value of the named state
	 */
	public function setState($name, $value)
	{
		$this->_state[$name] = $value;
	}

	/**
	 * Removes the specified state
	 *
	 * @param string $name the name of the state
	 */
	public function clearState($name)
	{
		unset($this->_state[$name]);
	}

}
