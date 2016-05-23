<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteRejectRequest {

	private $_email;
	private $_orgId;


	public function __construct($email, $orgId) {
		$this->_email = $email;
		$this->_orgId = $orgId;
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateRejectInviteInputs($this->_email, $this->_orgId);
	}

	public function getParameters() {

		$arr = array(
			'email' => $this->_email,
			'org_id' => $this->_orgId,
		);

		return $arr;
	}
}