<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 8:45 PM
 */

require_once dirname(dirname(dirname(__DIR__))).'/deserializers/OTDeserializedCreateMeetingResponseData.php';

class OTCreateMeetingResponse extends OTAPIResponse {

	/**
	 * @var OTDeserializedCreateMeetingResponseData
	 */
	private $_deserializedData;

	/**
	 * OTCreateMeetingResponse constructor.
	 *
	 * @param OTResponse $response
	 */
	public function __construct(OTResponse $response) {
		parent::__construct($response);

		$this->_deserializedData = null;

		if($this->data !== null){
			$this->_deserializedData = new OTDeserializedCreateMeetingResponseData($this->data);
		}
	}

	public function getMeetingData(){
		return $this->_deserializedData;
	}
}