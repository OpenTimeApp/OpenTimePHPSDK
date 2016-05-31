<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:14 PM
 */

require_once dirname(__DIR__) . '/OTAPITest.php';
require_once dirname(dirname(__DIR__)).'/src/apis/meeting/OTMeetingAPI.php';

class OTMeetingAPITest extends OTAPITest {

	public function testCreateMeeting() {

		$restore_data_response = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_meetings'], true);

		$this->assertTrue($restore_data_response->success, $restore_data_response->message);

		$start   = time() + 3600;
		$end     = $start + 3600;
		$created = time();

		$meeting_attendees = [
			['user_id' => 1, 'status' => 6, 'first_accepted' => 1458246858],
			['user_id' => 2, 'status' => 6, 'first_accepted' => 1458246858],
		];

		$request = new OTCreateMeetingRequest(
			1, 1, $start, $end, $created, $meeting_attendees
		);

		$response = OTMeetingAPI::create($request);

		$this->assertTrue($response->success, $response->message);
		$this->assertEquals(2, $response->getMeetingData()->getMeetingID());

		$request = new OTCreateMeetingRequest(
			1, 1, $start, $end, $created, [1,2]
		);

		$response = OTMeetingAPI::create($request);

		$this->assertFalse($response->success);

		$request = new OTCreateMeetingRequest(
			1, 1, $start + 3600, $end + 3600, $created, [1,2]
		);

		$response = OTMeetingAPI::create($request);

		$this->assertTrue($response->success, $response->message);
		$this->assertEquals(3, $response->getMeetingData()->getMeetingID());
	}

}