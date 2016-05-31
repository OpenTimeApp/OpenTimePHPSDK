<?php
require_once dirname(__DIR__) . '/api/OTAPIResponse.php';
require_once 'OTPersonValidationHelper.php';

class OTGroupInviteValidationHelper {

	public static function validateInviteInputs($emails, $group_id) {
		return self::validateGetInviteStatusInputs($emails, $group_id);
	}

	public static function validateGetInviteStatusInputs($emails, $group_id) {
		if(empty(trim($emails))) {
			return OTAPIResponse::create(false, "emails field is required.");
		}

		$validGroupId = self::_validGroupId($group_id);
		if($validGroupId->success == false) {
			return $validGroupId;
		}

		return OTAPIResponse::create(true, '');
	}

	/**
	 * @param $group_id
	 * @param $auth_key
	 *
	 * @return OTAPIResponse
	 */
	public static function validateRejectInviteInputs($group_id, $auth_key) {

		if(trim($auth_key) === ''){
			return OTAPIResponse::create(true, 'Auth key cannot be blank');
		}

		$validGroupId = self::_validGroupId($group_id);
		if($validGroupId->success == false) {
			return $validGroupId;
		}

		return OTAPIResponse::create(true, '');
	}

	public static function validateAcceptInviteInputs($group_id, $auth_key) {

		if(trim($auth_key) === ''){
			return OTAPIResponse::create(false, 'Auth key cannot be blank');
		}

		$validGroupId = self::_validGroupId($group_id);
		if($validGroupId->success == false) {
			return $validGroupId;
		}

		return OTAPIResponse::create(true, '');
	}

	/**
	 * @param $group_id
	 * @return OTAPIResponse
	 */
	private static function _validGroupId($group_id) {

		if(empty($group_id)) {
			return OTAPIResponse::create(false, "group_id is required.");
		}

		if(!is_numeric($group_id)) {
			return OTAPIResponse::create(false, "group_id should be numeric.");
		}

		return OTAPIResponse::create(true, '');

	}
}