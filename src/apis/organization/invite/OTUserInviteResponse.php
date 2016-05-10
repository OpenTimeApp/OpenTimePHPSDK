<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/OTDeserializedUserInviteResponseData.php';

class OTUserInviteResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedUserInviteResponseData
	 */
	private $_deserializedData;

	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedUserInviteResponseData($this->data);
		}
	}

	public function getUserInviteData(){
		return $this->_deserializedData;
	}
}