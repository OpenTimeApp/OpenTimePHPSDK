<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTGroupInviteValidationHelper.php';

class OTGroupInviteAcceptRequest {

	private $_groupId;
	private $_authKey;

	public function __construct($group_id, $auth_key) {
		$this->_groupId = $group_id;
		$this->_authKey = $auth_key;
	}

	public function checkInputs() {
		return OTGroupInviteValidationHelper::validateAcceptInviteInputs($this->_groupId, $this->_authKey);
	}

	public function getParameters() {

		$arr = array(
			'group_id' => $this->_groupId,
			'auth_key'    => $this->_authKey,
		);

		return $arr;
	}
}