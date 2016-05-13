<?php

require_once dirname(__DIR__) . '/OTAPITest.php';
require_once dirname(dirname(__DIR__)).'/src/apis/user/OTUserAPI.php';

class OTUserAPITest extends OTAPITest {

	public function testLogin() {

		$restore_data_response = TestHelper::getDataResetResponse(['make_users', 'make_meetings'], true);

		$this->assertTrue($restore_data_response->success, $restore_data_response->message);

		$request = new OTLoginRequest('tester1@app.opentimeapp.com', 'I love testing');

		$response = OTUserAPI::login($request);

		$this->assertTrue($response->success, $response->message);
		$this->assertEquals(1, $response->getUserData()->getPerson()->getUserId());
	}

	public function testRejectInvite() {

		$request = new OTRejectUserInviteRequest('tester1.com', 1);
		$response = OTUserAPI::rejectInvite($request);
		$this->assertFalse($response->success);

		$request = new OTRejectUserInviteRequest('tester1@app.opentime.com', 1);
		$response = OTUserAPI::rejectInvite($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testAcceptInvite() {

		$request = new OTAcceptUserInviteRequest('tester1@app.opentime.com', 1, 'Tester', '4', '3139431791', 'I love testing', 'I love testing');
		$response = OTUserAPI::acceptInvite($request);
		$this->assertTrue($response->success);
	}

}