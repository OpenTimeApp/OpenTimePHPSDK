<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 6:49 PM
 */

require_once __DIR__ . '/OTConstant.php';
require_once __DIR__ . '/OTAPIResponse.php';
require_once __DIR__ . '/OTAuthorizedAPIRequest.php';
require_once dirname(__DIR__ ). '/helpers/OTPasswordHelper.php';

class OpenTimeSDK {

	//region: Singleton

	private static $_service = null;

	/**
	 * @param string  $api_key
	 * @param boolean $in_test_mode
	 */
	public static function initService($api_key, $in_test_mode = false) {
		self::$_service = new OpenTimeSDK($api_key, $in_test_mode);
	}

	/**
	 * @return OpenTimeSDK
	 *
	 * @throws Exception
	 */
	public static function getService() {
		if(self::$_service !== null) {
			return self::$_service;
		} else {
			throw new Exception('OpenTime service not initialized');
		}
	}

	//endregion

	//region: Properties

	/**
	 * @var string
	 */
	private $_apiKey;

	/**
	 * @var bool
	 */
	private $_inTestMode;

	/**
	 * @var string
	 */
	private $_server;

	/**
	 * @var integer
	 */
	private $_userID;

	/**
	 * @var string
	 */
	private $_encryptedPassword;

	//endregion

	//region: Constructor

	/**
	 * OpenTimeSDK constructor.
	 *
	 * @param string  $api_key
	 * @param boolean $in_test_mode
	 */
	public function __construct($api_key, $in_test_mode) {

		$this->_userID            = null;
		$this->_encryptedPassword = null;

		$this->_apiKey          = $api_key;
		$this->_inTestMode      = $in_test_mode;
		$this->_server          = $in_test_mode ? OTConstant::TEST_SERVER : OTConstant::LIVE_SERVER;
	}

	//endregion

	//region: Getters

	/**
	 * @return string
	 */
	public static function getServer() {
		return self::getService()->_server;
	}

	/**
	 * @param string $api
	 * @param string $method
	 *
	 * @return string
	 */
	public static function getEndpoint($api, $method) {
		$endpoint = self::getServer() . OTConstant::API_BASE_URL . '/' . $api;
		if($method !== '') {
			$endpoint .= '/' . $method;
		}

		return $endpoint;
	}

	/**
	 * @return string
	 *
	 * @throws Exception
	 */
	public static function getKey() {
		return self::getService()->_apiKey;
	}

	/**
	 * @return integer
	 * @throws Exception
	 */
	public function getUserID() {
		if($this->_userID !== null) {
			return $this->_userID;
		} else {
			throw new Exception('Error: You did not set the OpenTime user id');
		}
	}

	/**
	 * @return string
	 *
	 * @throws Exception
	 */
	public function getEncryptedPassword() {
		if($this->_encryptedPassword !== null) {
			return $this->_encryptedPassword;
		} else {
			throw new Exception('Error: You did not set the OpenTime user password');
		}
	}

	//endregion

	//region: Setters

	/**
	 * @param string $server
	 */
	public function setServer($server) {
		$this->_server = $server;
	}

	/**
	 * @param integer $user_id
	 * @param string  $hashed_password
	 */
	public function setHashedCredentials($user_id, $hashed_password) {
		$this->_userID            = $user_id;
		$this->_encryptedPassword = $hashed_password;
	}

	/**
	 * @param integer $user_id
	 * @param string  $plain_text_password
	 */
	public function setPlainTextCredentials($user_id, $plain_text_password) {
		$this->_userID = $user_id;
		$this->_encryptedPassword = OTPasswordHelper::encryptPlainTextPassword($plain_text_password);
	}

	//endregion

}