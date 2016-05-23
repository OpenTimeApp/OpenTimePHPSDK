<?php

class OTDeserializedUserOrgInvite {

	private $_email;
	private $_lastInvitedAt;
	private $_declinedAt;
	private $_status;

	/**
	 * OTDeserializedUserOrgInvite constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {
		$this->_email         = isset($data->email) ? $data->email : null;
		$this->_lastInvitedAt = isset($data->last_invited_at) ? $data->last_invited_at : 0;
		$this->_declinedAt    = isset($data->declined_at) ? $data->declined_at : 0;
		$this->_status        = isset($data->status) ? $data->status : null;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * @return int
	 */
	public function getLastInvitedAt() {
		return $this->_lastInvitedAt;
	}

	/**
	 * @return int
	 */
	public function getDeclinedAt() {
		return $this->_declinedAt;
	}

	/**
	 * @return int
	 */
	public function getStatus() {
		return $this->_status;
	}
	
	public function couldBeInvited(){
		return in_array($this->getStatus(), array(
			OTUserOrgInviteStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTUserOrgInviteStatus::UNINVITED_BUT_OPENTIME_USER,
			OTUserOrgInviteStatus::ALREADY_INVITED
		));
	}

	public function willBeInvited(){
		return in_array($this->getStatus(), array(
			OTUserOrgInviteStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTUserOrgInviteStatus::UNINVITED_BUT_OPENTIME_USER
		));
	}

}