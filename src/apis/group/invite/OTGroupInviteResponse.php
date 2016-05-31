<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/group/invite/OTDeserializedGroupInviteResponseData.php';

class OTGroupInviteResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedGroupInviteResponseData
	 */
	private $_deserializedData;

	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedGroupInviteResponseData($this->data);
		}
	}

	public function getGroupInviteData(){
		return $this->_deserializedData;
	}
}