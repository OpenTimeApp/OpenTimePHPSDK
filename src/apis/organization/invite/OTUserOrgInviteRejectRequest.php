<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteRejectRequest {

	private $_authKey;

	public function __construct($auth_key) {
		$this->_authKey = $auth_key;
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateRejectInviteInputs($this->_email, $this->_orgId);
	}

	public function getParameters() {

		$arr = array(
			'auth_key' => $this->_authKey,
		);

		return $arr;
	}
}