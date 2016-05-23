<?php
require_once dirname(dirname(dirname(__DIR__ ))). '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteStatusRequest {

	private $_emails;
	private $_orgId;


	public function __construct($emails, $orgId) {
		$this->_emails = $emails;
		$this->_orgId = $orgId;
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateGetInviteStatusInputs($this->_emails, $this->_orgId);
	}

	public function getParameters() {

		$arr = array(
			'emails' => $this->_emails,
			'org_id' => $this->_orgId,
		);

		return $arr;
	}
}