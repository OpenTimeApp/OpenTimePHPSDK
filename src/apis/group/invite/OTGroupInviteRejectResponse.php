<?php

require_once dirname(dirname(dirname(__DIR__))) . '/deserializers/group/invite/OTDeserializedGroupInvite.php';

class OTGroupInviteRejectResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedGroupInvite
	 */
	private $_deserializedData;

	/**
	 * OTGroupInviteRejectResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedGroupInvite($this->data);
		}
	}

	/**
	 * @return OTDeserializedGroupInvite
	 */
	public function getGroupInvite(){
		return $this->_deserializedData;
	}
}