<?php

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/group/invite/OTDeserializedGroupInviteStatusResponseData.php';

class OTGroupInviteStatusResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedGroupInviteStatusResponseData
	 */
	private $_deserializedData;

	/**
	 * OTGroupInviteStatusResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedGroupInviteStatusResponseData($this->data);
		}
	}

	/**
	 * @return OTDeserializedGroupInviteStatusResponseData|null
	 */
	public function getGroupInviteData(){
		return $this->_deserializedData;
	}
}