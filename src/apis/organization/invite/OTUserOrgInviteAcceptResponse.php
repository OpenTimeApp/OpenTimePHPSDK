<?php

require_once dirname(dirname(dirname(__DIR__))) . '/deserializers/organization/invite/OTDeserializedUserOrgInvite.php';

class OTUserOrgInviteAcceptResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedUserOrgInvite
	 */
	private $_deserializedData;

	/**
	 * OTUserOrgInviteAcceptResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedUserOrgInvite($this->data);
		}
	}

	public function getOrgInviteEvaluation(){
		return $this->_deserializedData;
	}
}