<?php

class OTDeserializedUserInviteStatusResponseData {

	/**
	 * @var array OTDeserializedUserInvite
	 */
	private $_userInviteStatuses;

	public function __construct($data) {
		foreach($data as $status) {
			$this->_userInviteStatuses[] = new OTDeserializedUserInvite($status);
		}
	}

	public function getUserInviteStasuses() {
		return $this->_userInviteStatuses;
	}

}