<?php

require_once __DIR__.'/OTDeserializedPerson.php';

class OTDeserializedLoginResponseData {

	/**
	 * @var OTDeserializedPerson
	 */
	private $_person;

	public function __construct($data) {
		$this->_person = new OTDeserializedPerson($data->person);
	}

	/**
	 * @return OTDeserializedPerson
	 */
	public function getPerson(){
		return $this->_person;
	}

}