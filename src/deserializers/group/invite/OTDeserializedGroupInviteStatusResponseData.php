<?php

require_once __DIR__.'/OTDeserializedGroupInviteEvaluation.php';

class OTDeserializedGroupInviteStatusResponseData {

	/**
	 * @var array OTDeserializedUserOrgInvite
	 */
	private $_userInviteStatuses;

	public function __construct($data) {
		foreach($data as $item) {
			$this->_userInviteStatuses[] = new OTDeserializedGroupInviteEvaluation($item);
		}
	}

	/**
	 * @return array(OTDeserializedUserOrgInvite)
	 */
	public function getUserOrgInviteStatuses() {
		return $this->_userInviteStatuses;
	}

}