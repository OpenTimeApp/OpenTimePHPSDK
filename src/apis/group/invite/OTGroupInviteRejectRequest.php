<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTGroupInviteValidationHelper.php';

class OTGroupInviteRejectRequest {

	private $_authKey;
	private $_groupId;


	public function __construct($groupId, $auth_key) {
		$this->_groupId = $groupId;
		$this->_authKey = $auth_key;
	}

	public function checkInputs() {
		return OTGroupInviteValidationHelper::validateRejectInviteInputs($this->_groupId, $this->_authKey);
	}

	public function getParameters() {

		$arr = array(
			'email' => $this->_email,
			'group_id' => $this->_groupId,
		);

		return $arr;
	}
}