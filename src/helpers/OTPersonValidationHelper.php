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
		$validEmail = self::validEmail($email);
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
	 * @param $firstName
	 * @param $lastName
	 * @param $phone
	 * @param $password
	 * @param $confirm_password
	 * @return OTAPIResponse
	 */
	public static function validateCreateInputs($email, $firstName, $lastName, $phone, $password, $confirm_password) {
		$validEmail = self::validEmail($email);
		if($validEmail->success == false) {
			return $validEmail;
		}

		$validName = self::_validName($firstName, $lastName);
		if($validName->success == false) {
			return $validName;
		}

		$validPhone = self::_validPhone($phone);
		if($validPhone->success == false) {
			return $validName;
		}

		$validPassword = self::_validPassword($password, $confirm_password);
		if($validPassword->success == false) {
			return $validPassword;
		}

		return OTAPIResponse::create(true, "");
	}

	/**
	 * @param $email
	 * @return OTAPIResponse
	 */
	public static function validEmail($email) {
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
	 * @param null $confirm_password
	 * @return OTAPIResponse
	 */
	private static function _validPassword($password, $confirm_password=null) {

		if(strlen($password) < self::PASSWORD_MIN_LEN) {
			return OTAPIResponse::create(false, sprintf("Password must be atleast %d characters", self::PASSWORD_MIN_LEN));
		}

		if($confirm_password!=null && $password != $confirm_password) {
			return OTAPIResponse::create(false, "Password and Confirm Password fields doesn't match.");
		}

		return OTAPIResponse::create(true, '');

	}

	/**
	 * @param $firstName
	 * @param $lastName
	 * @return OTAPIResponse
	 */
	private static function _validName($firstName, $lastName) {

		if(strlen(trim($firstName)) == 0) {
			return OTAPIResponse::create(false, "First Name cannot be blank.");
		}
		if(strlen(trim($lastName)) == 0) {
			return OTAPIResponse::create(false, "Last Name cannot be blank.");
		}

		return OTAPIResponse::create(true, '');

	}

	/**
	 * @param $phone
	 * @return OTAPIResponse
	 */
	private static function _validPhone($phone) {

		if(strlen(trim($phone)) == 0) {
			return OTAPIResponse::create(false, "Cell Phone cannot be blank.");
		}

		return OTAPIResponse::create(true, '');

	}
}