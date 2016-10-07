<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteAcceptRequest {

	private $_orgId;
	private $_authKey;

	public function __construct($org_id, $auth_key) {
		$this->_orgId   = $org_id;
		$this->_authKey = $auth_key;
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateAcceptInviteInputs($this->_orgId, $this->_authKey);
	}

	public function getParameters() {

		$arr = array(
			'org_id'   => $this->_orgId,
			'auth_key' => $this->_authKey,
		);

		return $arr;
	}
}