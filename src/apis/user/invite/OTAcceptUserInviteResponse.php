<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/OTDeserializedUserInvite.php';

class OTAcceptUserInviteResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedUserInvite
	 */
	private $_deserializedData;

	/**
	 * OTUserInvite constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedUserInvite($this->data);
		}
	}

	public function getUserInviteData(){
		return $this->_deserializedData;
	}
}