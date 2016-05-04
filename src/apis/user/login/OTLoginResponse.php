<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/OTDeserializedLoginResponseData.php';

class OTLoginResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedLoginResponseData
	 */
	private $_deserializedData;

	/**
	 * OTLoginResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedLoginResponseData($this->data);
		}
	}

	public function getUserData(){
		return $this->_deserializedData;
	}
}