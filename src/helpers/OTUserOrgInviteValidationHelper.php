<?php
require_once dirname(__DIR__) . '/api/OTAPIResponse.php';
require_once 'OTPersonValidationHelper.php';

class OTUserOrgInviteValidationHelper {

	public static function validateInviteInputs($emails, $org_id) {
		return self::validateGetInviteStatusInputs($emails, $org_id);
	}

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
	 * @param $org_id
	 * @param $auth_key
	 *
	 * @return OTAPIResponse
	 */
	public static function validateRejectInviteInputs($org_id, $auth_key) {

		if(trim($auth_key) === ''){
			return OTAPIResponse::create(true, 'Auth key cannot be blank');
		}

		$validOrgId = self::_validOrgId($org_id);
		if($validOrgId->success == false) {
			return $validOrgId;
		}

		return OTAPIResponse::create(true, '');
	}

	public static function validateAcceptInviteInputs($org_id, $auth_key) {

		if(trim($auth_key) === ''){
			return OTAPIResponse::create(false, 'Auth key cannot be blank');
		}

		$validOrgId = self::_validOrgId($org_id);
		if($validOrgId->success == false) {
			return $validOrgId;
		}

		return OTAPIResponse::create(true, '');
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