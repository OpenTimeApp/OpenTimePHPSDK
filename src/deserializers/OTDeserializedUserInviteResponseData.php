<?php

class OTDeserializedUserInviteResponseData {

	/**
	 * @var array
	 */
	private $_emails;

	public function __construct($data) {
		$this->_emails = $data;
	}

	public function getEmails() {
		return $this->_emails;
	}

}