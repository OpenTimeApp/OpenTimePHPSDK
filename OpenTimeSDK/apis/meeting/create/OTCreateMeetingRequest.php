<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 7:17 PM
 */
class OTCreateMeetingRequest {

	private $_attendees;
	private $_orgID;
	private $_creator;
	private $_start;
	private $_end;
	private $_created;

	/**
	 * OTCreateMeetingRequest constructor.
	 *
	 * @param integer        $org_id
	 * @param integer        $creator
	 * @param integer        $start
	 * @param integer        $end
	 * @param integer        $created
	 * @param array(integer) $attendees
	 */
	public function __construct($org_id, $creator, $start, $end, $created, $attendees) {
		$this->_orgID     = $org_id;
		$this->_creator   = $creator;
		$this->_start     = $start;
		$this->_end       = $end;
		$this->_created   = $created;
		$this->_attendees = $attendees;
	}

	public function getParameters() {
		return array(
			'org_id'        => $this->_orgID,
			'start'         => $this->_start,
			'end'           => $this->_end,
			'created'       => $this->_created,
			'attendee_list' => $this->_attendees
		);
	}
}