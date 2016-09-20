<?php

require_once __DIR__.'/OTDeserializedGroupInviteEvaluation.php';

class OTDeserializedGroupInviteStatusResponseData {

	/**
	 * @var array(OTDeserializedGroupInvite)
	 */
	private $_userInviteStatuses;

	public function __construct($data) {
		foreach($data as $item) {
			$this->_userInviteStatuses[] = new OTDeserializedGroupInviteEvaluation($item);
		}
	}

	/**
	 * @return array(OTDeserializedGroupInvite)
	 */
	public function getGroupInviteStatuses() {
		return $this->_userInviteStatuses;
	}

}