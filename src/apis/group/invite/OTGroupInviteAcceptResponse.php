<?php

require_once dirname(dirname(dirname(__DIR__))) . '/deserializers/group/invite/OTDeserializedGroupInvite.php';

class OTGroupInviteAcceptResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedGroupInvite
	 */
	private $_deserializedData;

	/**
	 * OTGroupInviteAcceptResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null) {
			$this->_deserializedData = new OTDeserializedGroupInvite($this->data);
		}
	}

	public function getGroupInviteEvaluation(){
		return $this->_deserializedData;
	}
}