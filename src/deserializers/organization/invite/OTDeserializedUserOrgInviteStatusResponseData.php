<?php

require_once __DIR__.'/OTDeserializedUserOrgInviteEvaluation.php';

class OTDeserializedUserOrgInviteStatusResponseData {

	/**
	 * @var array OTDeserializedUserOrgInvite
	 */
	private $_userInviteStatuses;

	public function __construct($data) {
		foreach($data as $evaluation) {
			$this->_userInviteStatuses[] = new OTDeserializedUserOrgInviteEvaluation($evaluation);
		}
	}

	public function getUserOrgInviteStatuses() {
		return $this->_userInviteStatuses;
	}

}