<?php

require_once __DIR__.'/OTDeserializedUserOrgInvite.php';

class OTDeserializedUserOrgInviteEvaluation {

	private $_email;
	private $_status;
	private $_userName;
	private $_invite;

	/**
	 * OTDeserializedUserOrgInvite constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {

		$this->_email         = $data->email;
		$this->_userName      = $data->user_name;
		$this->_status        = $data->status;

		if($data->invite !== null){
			$this->_invite = new OTDeserializedUserOrgInvite($data->invite);
		}else{
			$this->_invite = null;
		}
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
	public function getStatus() {
		return $this->_status;
	}

	public function couldBeInvited() {
		return in_array(
			$this->getStatus(), array(
			OTUserOrgInviteEvaluationStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTUserOrgInviteEvaluationStatus::UNINVITED_BUT_OPENTIME_USER,
			OTUserOrgInviteEvaluationStatus::ALREADY_INVITED
		)
		);
	}

	public function willBeInvited() {
		return in_array(
			$this->getStatus(), array(
			OTUserOrgInviteEvaluationStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTUserOrgInviteEvaluationStatus::UNINVITED_BUT_OPENTIME_USER
		)
		);
	}
}