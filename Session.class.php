<?php

/**
 * 2013.12.01 - Jesse L Quattlebaum (psyjoniz@gmail.com) (https://github.com/psyjoniz/code_sample__Session)
 * A class for handling Session related data.
 */

class Session {

	private $sNamespace = 'session_namespace';

	function __construct($sSessionId = null, $sNamespace = null)
	{
		if(null !== $sSessionId) {
			session_id($sSessionId);
		}
		if(!session_start()) {
			throw new Exception('Could not start session.');
		}
		if(null !== $sNamespace) {
			$this->sNamespace = $sNamespace;
		}
	}

	public function getSessionId()
	{
		return session_id();
	}

	public function set($sName = null, $mValue = null)
	{
		if(!isset($_SESSION[$this->sNamespace]) || !is_array($_SESSION[$this->sNamespace])) {
			$_SESSION[$this->sNamespace] = array();
		}
		if(null === $sName) {
			throw new Exception('Invalid name supplied to Session.');
		}
		if(null === $mValue) {
			throw new Exception('Value not supplied to Session.');
		}
		$_SESSION[$this->sNamespace][$sName] = $mValue;
		return true;
	}

	public function get($sName)
	{
		if(null === $sName) {
			throw new Exception('Invalid name supplied to Session.');
		}
		if(isset($_SESSION[$this->sNamespace][$sName])) {
			return $_SESSION[$this->sNamespace][$sName];
		}
		return false;
	}

	public function remove($sName = null)
	{
		if(null === $sName) {
			throw new Exception('Invalid name supplied to Session.');
		}
		if(isset($_SESSION[$this->sNamespace][$sName])) {
			unset($_SESSION[$this->sNamespace][$sName]);
		}
	}

	public function removeAll()
	{
		foreach($_SESSION[$this->sNamespace] as $sName => $mValue) {
			$this->remove($sName);
		}
		unset($_SESSION[$this->sNamespace]);
	}
}
