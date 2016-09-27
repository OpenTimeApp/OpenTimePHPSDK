<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTGroupInviteValidationHelper.php';

class OTGroupInviteStatusRequest {

	private $_emails;
	private $_groupId;
	private $_alsoInviteToOrg;

	public function __construct($emails, $groupId) {
		$this->_emails          = $emails;
		$this->_groupId         = $groupId;
		$this->_alsoInviteToOrg = false;
	}

	public function checkInputs() {
		return OTGroupInviteValidationHelper::validateGetInviteStatusInputs($this->_emails, $this->_groupId);
	}

	public function getParameters() {

		$arr = array(
			'emails'             => $this->_emails,
			'group_id'           => $this->_groupId,
			'also_invite_to_org' => $this->_alsoInviteToOrg
		);

		return $arr;
	}

	/**
	 * @param boolean $also_invite
	 *
	 * @return OTGroupInviteStatusRequest
	 */
	public function setAlsoInviteToOrg($also_invite){
		$this->_alsoInviteToOrg = $also_invite;
		return $this;
	}
}