<?php
require_once dirname(dirname(dirname(__DIR__ ))). '/helpers/OTUserInviteValidationHelper.php';

class OTRejectUserInviteRequest {

	private $_email;
	private $_orgId;


	public function __construct($email, $orgId) {
		$this->_email = $email;
		$this->_orgId = $orgId;
	}

	public function checkInputs() {
		return OTUserInviteValidationHelper::validateRejectInviteInputs($this->_email, $this->_orgId);
	}

	public function getParameters() {

		$arr = array(
			'email' => $this->_email,
			'org_id' => $this->_orgId,
		);

		return $arr;
	}
}