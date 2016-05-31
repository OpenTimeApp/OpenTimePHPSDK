<?php

class OTDeserializedGroupInvite {

	private $_email;
	private $_lastInvitedAt;
	private $_respondedAt;
	private $_status;

	/**
	 * OTDeserializedGroupInvite constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {
		$this->_email         = strval($data->email);
		$this->_lastInvitedAt = intval($data->last_invited_at);
		$this->_respondedAt   = intval($data->responded_at);
		$this->_status        = intval($data->status);
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
	public function getRespondedAt() {
		return $this->_respondedAt;
	}

	public function getStatus(){
		return $this->_status;
	}

}