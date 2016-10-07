<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteRejectRequest {

	private $_authKey;
	private $_orgId;


	public function __construct($orgId, $auth_key) {
		$this->_orgId = $orgId;
		$this->_authKey = $auth_key;
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateRejectInviteInputs($this->_orgId, $this->_authKey);
	}

	public function getParameters() {

		$arr = array(
			'email' => $this->_email,
			'org_id' => $this->_orgId,
		);

		return $arr;
	}
}