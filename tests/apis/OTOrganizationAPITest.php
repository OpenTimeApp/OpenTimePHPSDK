<?php

require_once dirname(__DIR__) . '/OTAPITestParent.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/OTOrganizationAPI.php';

class OTOrganizationAPITest extends OTAPITestParent {

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

	public function testInviteWithUserAlreadyInOrg() {
		OTSDKTestHelper::getDataResetResponse(array('make_users'));
		$request = new OTUserOrgInviteRequest('tester1@app.opentimeapp.com test2@gmail.com', 1);
		$response = OTOrganizationAPI::invite($request);
		$this->assertFalse($response->success, $response->message);
	}

	public function testInviteWithoutAlreadyInvitedEmail() {
		OTSDKTestHelper::getDataResetResponse(array('clear_org_invites'));
		$request = new OTUserOrgInviteRequest('test2@gmail.com', 1);
		$response = OTOrganizationAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}
}