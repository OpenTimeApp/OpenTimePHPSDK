<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 8:54 PM
 */

class OTDeserializedCreateMeetingResponseData {

	private $_meetingID;

	public function __construct($data) {
		$this->_meetingID = $data->id;
	}

	public function getMeetingID(){
		return $this->_meetingID;
	}

}