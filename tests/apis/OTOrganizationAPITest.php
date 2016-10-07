<?php

require_once dirname(__DIR__) . '/OTAPITestParent.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/OTOrganizationAPI.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/invite/OTUserOrgInviteEvaluationStatus.php';

class OTOrganizationAPITest extends OTAPITestParent {

	public function setUp() {
		parent::setUp();
	}

	public function testGetInviteEvaluationStatus(){

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_org_invites']);

		$request = new OTUserOrgInviteStatusRequest('tester1@app.opentimeapp.com', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);

		$invite_items = $response->getUserOrgInviteData()->getUserOrgInviteStatuses();

		$this->assertCount(1, $invite_items);

		$invite_item = $invite_items[0];

		$this->assertEquals(OTUserOrgInviteEvaluationStatus::ALREADY_IN_ORG, $invite_item->getStatus());
	}

	public function testGetInviteStatusWithEmptyRequest(){
		$request = new OTUserOrgInviteStatusRequest(',', 1);
		$response = OTOrganizationAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
		$this->assertTrue(is_array($response->data));
	}

	public function testInvite() {
		$request = new OTUserOrgInviteRequest('tester1@app.opentime.com test2@gmail.com', 1, true);

		$request->setFromName('Jim');
		$request->setFromEmail('jim@bim.co');
		$request->setAcceptRedirect('http://accept.com');
		$request->setDeclineRedirect('http://decline.com');
		$request->setMakeManager(true);
		$request->setNotifyEmail('sara@fara.wara');
		$request->setMessageID(88);
		$request->setAcceptRedirect('http://google.com');
		$request->setDeclineRedirect('http://yahoo.com');
		$request->setNotifyEmail('abc@123.xyz');
		$request->setUseDefaultMessage(false);

		$response = OTOrganizationAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testRejectInvite() {

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_org_invites']);
		$this->assertTrue($result->success, $result->message);

		$request = new OTUserOrgInviteAcceptRequest(1, 'abc123');
		$response = OTOrganizationAPI::acceptInvite($request);
		$this->assertTrue($response->success, $response->message);

		$this->assertEquals(OTUserOrgInviteStatus::ACCEPTED, $response->getOrgInviteEvaluation()->getStatus());
	}

	public function testAcceptInvite() {

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_org_invites']);
		$this->assertTrue($result->success, $result->message);

		$request = new OTUserOrgInviteAcceptRequest(1, 'abc123');

		$response = OTOrganizationAPI::acceptInvite($request);
		$this->assertTrue($response->success, $response->message);

		$this->assertEquals(OTUserOrgInviteStatus::ACCEPTED, $response->getOrgInviteEvaluation()->getStatus());
	}

}