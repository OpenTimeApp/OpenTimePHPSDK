<?php

require_once dirname(dirname(dirname(__DIR__))) . '/deserializers/organization/invite/OTDeserializedUserOrgInviteResponseData.php';

class OTUserOrgInviteResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedUserOrgInviteResponseData
	 */
	private $_deserializedData;

	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedUserOrgInviteResponseData($this->data);
		}
	}

	public function getUserOrgInviteData(){
		return $this->_deserializedData;
	}
}