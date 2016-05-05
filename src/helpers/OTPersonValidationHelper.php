<?php
require_once dirname(__DIR__) . '/api/OTAPIResponse.php';

class OTPersonValidationHelper {

	const PASSWORD_MIN_LEN = 8;

	/**
	 * @param $email
	 * @param $password
	 * @return OTAPIResponse
	 */
	public static function signInInputsValid($email, $password) {
		$validEmail = self::_validEmail($email);
		if($validEmail->success == false) {
			return $validEmail;
		}

		$validPassword = self::_validPassword($password);
		if($validPassword->success == false) {
			return $validPassword;
		}

		return OTAPIResponse::create(true, "");
	}

	/**
	 * @param $email
	 * @return OTAPIResponse
	 */
	private static function _validEmail($email) {
		if(empty(trim($email))) {
			return OTAPIResponse::create(false, "Email cannot be blank");
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			return OTAPIResponse::create(false, "Invalid email");
		}

		return OTAPIResponse::create(true, '');
	}

	/**
	 * @param $password
	 * @return OTAPIResponse
	 */
	private static function _validPassword($password) {

		if(strlen($password) < self::PASSWORD_MIN_LEN) {
			return OTAPIResponse::create(false, sprintf("Password must be atleast %d characters", self::PASSWORD_MIN_LEN));
		}

		return OTAPIResponse::create(true, '');

	}
}