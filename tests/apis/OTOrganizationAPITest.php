<?php

require_once dirname(__DIR__) . '/OTAPITest.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/OTOrganizationAPI.php';

class OTOrganizationAPITest extends OTAPITest {

	public function testGetInviteStatus(){
		$request = new OTUserInviteStatusRequest('tester1@app.opentime.com', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testGetInviteStatusWithEmptyRequest(){
		$request = new OTUserInviteStatusRequest(',', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
		$this->assertTrue(is_array($response->data));
	}

	public function testInvite() {

		$request = new OTUserInviteRequest('tester1@app.opentime.com test2@gmail.com', 1);
		$response = OTOrganizationAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}

}