<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:14 PM
 */

require_once __DIR__.'/OTAPITest.php';
require_once dirname(__DIR__).'/OpenTimeSDK/apis/meeting/OTMeetingAPI.php';

class OTMeetingAPITest extends OTAPITest {

	public function testThis() {

		$restore_data_response = TestHelper::getDataResetResponse(['make_users', 'make_meetings'], true);

		$this->assertTrue($restore_data_response->success, $restore_data_response->message);

		$start   = time() + 3600;
		$end     = $start + 3600;
		$created = time();

		$request = new OTCreateMeetingRequest(
			1, 1, $start, $end, $created, [1, 2]
		);

		$response = OTMeetingAPI::create($request);

		$this->assertTrue($response->success, $response->message);
		$this->assertEquals(2, $response->getMeetingData()->getMeetingID());
	}

}