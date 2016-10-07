<?php

class OTDeserializedUserOrgInvite {

	/**
	 * @var string
	 */
	private $_email;

	/**
	 * @var int
	 */
	private $_lastInvitedAt;

	/**
	 * @var int
	 */
	private $_respondedAt;

	/**
	 * @var int
	 */
	private $_status;

	/**
	 * OTDeserializedUserOrgInvite constructor.
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

	/**
	 * @return int
	 */
	public function getStatus(){
		return $this->_status;
	}

}