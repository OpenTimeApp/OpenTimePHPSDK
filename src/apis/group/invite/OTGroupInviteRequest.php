<?php
require_once dirname(dirname(dirname(__DIR__ ))). '/helpers/OTGroupInviteValidationHelper.php';

class OTGroupInviteRequest {

	private $_emails;
	private $_groupId;


	public function __construct($emails, $groupId) {
		$this->_emails = $emails;
		$this->_groupId = $groupId;
	}

	public function checkInputs() {
		return OTGroupInviteValidationHelper::validateInviteInputs($this->_emails, $this->_groupId);
	}

	public function getParameters() {

		$arr = array(
			'emails' => $this->_emails,
			'group_id' => $this->_groupId,
		);

		return $arr;
	}
}