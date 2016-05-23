<?php

class OTDeserializedUserOrgInviteStatusResponseData {

	/**
	 * @var array OTDeserializedUserOrgInvite
	 */
	private $_userInviteStatuses;

	public function __construct($data) {
		foreach($data as $status) {
			$this->_userInviteStatuses[] = new OTDeserializedUserOrgInvite($status);
		}
	}

	public function getUserOrgInviteStatuses() {
		return $this->_userInviteStatuses;
	}

}