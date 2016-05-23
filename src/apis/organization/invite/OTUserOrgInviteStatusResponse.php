<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/OTDeserializedUserOrgInviteStatusResponseData.php';

class OTUserOrgInviteStatusResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedUserOrgInvite
	 */
	private $_deserializedData;

	/**
	 * OTUserOrgInviteStatusResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedUserOrgInviteStatusResponseData($this->data);
		}
	}

	public function getUserOrgInviteData(){
		return $this->_deserializedData;
	}
}