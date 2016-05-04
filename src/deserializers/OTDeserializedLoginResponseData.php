<?php

class OTDeserializedLoginResponseData {

	private $_userId;
	private $_firstName = '';
	private $_lastName = '';
	private $_imageName = '';
	private $_profileSummary;
	private $_type = '';
	private $_status = null;

	public function __construct($data) {
		$this->_userId = $data->id;
		$this->_firstName = $data->firstName;
		$this->_lastName = $data->lastName;
		$this->_imageName = $data->imageName;
		$this->_profileSummary = $data->profileSummary;
		$this->_status = $data->status;
	}

	public function getUserId(){
		return $this->_userId;
	}

	public function getFirstName(){
		return $this->_firstName;
	}

	public function getLastName(){
		return $this->_lastName;
	}

	public function getImageName(){
		return $this->_imageName;
	}

	public function getProfileSummary(){
		return $this->_profileSummary;
	}

	public function getStatus() {
		return $this->_status;
	}

}