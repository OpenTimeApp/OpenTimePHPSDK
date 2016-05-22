<?php

require_once dirname(__DIR__) . '/OTAPITest.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/OTOrganizationAPI.php';

class OTOrganizationAPITest extends OTAPITest {

	public function testGetInviteStatus(){
		$request = new OTUserOrgInviteStatusRequest('tester1@app.opentime.com', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testGetInviteStatusWithEmptyRequest(){
		$request = new OTUserOrgInviteStatusRequest(',', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
		$this->assertTrue(is_array($response->data));
	}

	public function testInvite() {
		$request = new OTUserOrgInviteRequest('tester1@app.opentime.com test2@gmail.com', 1);
		$response = OTOrganizationAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testRejectInvite() {

		$request = new OTUserOrgInviteRejectRequest('tester1.com', 1);
		$response = OTOrganizationAPI::rejectInvite($request);
		$this->assertFalse($response->success);

		$request = new OTUserOrgInviteRejectRequest('tester1@app.opentime.com', 1);
		$response = OTOrganizationAPI::rejectInvite($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testAcceptInvite() {

		$request = new OTUserOrgInviteAcceptRequest('tester1@app.opentime.com', 1, 'Tester', '4', '3139431791', 'I love testing', 'I love testing');
		$response = OTOrganizationAPI::acceptInvite($request);
		$this->assertTrue($response->success);
	}

}