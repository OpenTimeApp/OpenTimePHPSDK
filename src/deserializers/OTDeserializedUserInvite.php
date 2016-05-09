<?php

class OTDeserializedUserInvite {

	private $_orgId;
	private $_email;
	private $_lastInvitedAt;
	private $_declinedAt;

	/**
	 * OTDeserializedUserInvite constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {
		$this->_orgId = $data->org_id;
		$this->_email = $data->email;
		$this->_lastInvitedAt = $data->last_invited_at;
		$this->_declinedAt = $data->declined_at;
	}

	/**
	 * @return int
	 */
	public function getOrgId()
	{
		return $this->_orgId;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->_email;
	}

	/**
	 * @return int
	 */
	public function getLastInvitedAt()
	{
		return $this->_lastInvitedAt;
	}

	/**
	 * @return int
	 */
	public function getDeclinedAt()
	{
		return $this->_declinedAt;
	}

}