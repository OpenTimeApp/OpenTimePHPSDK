<?php

require_once __DIR__.'/OTDeserializedGroupInvite.php';

class OTDeserializedGroupInviteEvaluation {

	private $_email;
	private $_status;
	private $_userName;
	private $_invite;

	/**
	 * OTDeserializedGroupInvite constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {

		$this->_email         = $data->email;
		$this->_userName      = $data->user_name;
		$this->_status        = $data->status;

		if($data->invite !== null){
			$this->_invite = new OTDeserializedGroupInvite($data->invite);
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
			OTGroupInviteEvaluationStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTGroupInviteEvaluationStatus::UNINVITED_BUT_OPENTIME_USER,
			OTGroupInviteEvaluationStatus::ALREADY_INVITED,
			OTGroupInviteEvaluationStatus::NOT_ORG_MEMBER_FOR_INTERNAL_GROUP
		)
		);
	}

	public function willBeInvited() {
		return in_array(
			$this->getStatus(), array(
			OTGroupInviteEvaluationStatus::UNINVITED_AND_NOT_OPENTIME_USER,
			OTGroupInviteEvaluationStatus::UNINVITED_BUT_OPENTIME_USER
		)
		);
	}
}