<?php
require_once dirname(__DIR__) . '/api/OTAPIResponse.php';
require_once 'OTPersonValidationHelper.php';

class OTUserInviteValidationHelper {

	public static function validateGetInviteStatusInputs($emails, $org_id) {
		if(empty(trim($emails))) {
			return OTAPIResponse::create(false, "emails field is required.");
		}

		$validOrgId = self::_validOrgId($org_id);
		if($validOrgId->success == false) {
			return $validOrgId;
		}

		return OTAPIResponse::create(true, "");
	}

	/**
	 * @param $email
	 * @param $org_id
	 * @return OTAPIResponse
	 */
	public static function validateRejectInviteInputs($email, $org_id) {
		$validEmail = OTPersonValidationHelper::validEmail($email);
		if($validEmail->success == false) {
			return $validEmail;
		}

		$validOrgId = self::_validOrgId($org_id);
		if($validOrgId->success == false) {
			return $validOrgId;
		}

		return OTAPIResponse::create(true, "");
	}

	public static function validateAcceptInviteInputs($email, $org_id, $firstName=null, $lastName=null, $cellPhone=null, $password=null, $confirmPassword=null) {
		$validEmail = OTPersonValidationHelper::validEmail($email);
		if($validEmail->success == false) {
			return $validEmail;
		}

		$validOrgId = self::_validOrgId($org_id);
		if($validOrgId->success == false) {
			return $validOrgId;
		}

		if($firstName != null) {
			$validRegisterInputs = OTPersonValidationHelper::validateCreateInputs($email, $firstName, $lastName, $cellPhone, $password, $confirmPassword);
			if($validRegisterInputs->success == false) {
				return $validRegisterInputs;
			}
		}

		return OTAPIResponse::create(true, "");
	}

	/**
	 * @param $org_id
	 * @return OTAPIResponse
	 */
	private static function _validOrgId($org_id) {

		if(empty($org_id)) {
			return OTAPIResponse::create(false, "org_id is required.");
		}

		if(!is_numeric($org_id)) {
			return OTAPIResponse::create(false, "org_id should be numeric.");
		}

		return OTAPIResponse::create(true, '');

	}
}