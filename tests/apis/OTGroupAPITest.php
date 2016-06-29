<?php

require_once dirname(__DIR__) . '/OTAPITestParent.php';
require_once dirname(dirname(__DIR__)).'/src/apis/group/OTGroupAPI.php';

class OTGroupAPITest extends OTAPITestParent {

	public function setUp() {
		parent::setUp();
	}

	public function testGetInviteEvaluationStatus(){

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_groups']);
		$this->assertTrue($result->success, $result->message);
		
		$request = new OTGroupInviteStatusRequest('tester1@app.opentimeapp.com', 1);
		$response = OTGroupAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
		
		$invite_items = $response->getGroupInviteData()->getUserOrgInviteStatuses();

		$this->assertCount(1, $invite_items);

		$invite_item = $invite_items[0];

		$this->assertEquals(OTGroupInviteEvaluationStatus::ALREADY_IN_GROUP, $invite_item->getStatus());
	}

	public function testGetInviteStatusWithEmptyRequest(){
		$request = new OTGroupInviteStatusRequest(',', 1);
		$response = OTGroupAPI::getInviteStatusOfEmails($request);
		$this->assertTrue($response->success, $response->message);
		$this->assertTrue(is_array($response->data));
	}

	public function testInvite() {
		$request = new OTGroupInviteRequest('tester1@app.opentime.com test2@gmail.com', 1);
		$response = OTGroupAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}

	public function testRejectInvite() {

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_groups', 'make_group_invites']);
		$this->assertTrue($result->success, $result->message);

		$request = new OTGroupInviteAcceptRequest(1, 'abc.123');
		$response = OTGroupAPI::acceptInvite($request);
		$this->assertTrue($response->success, $response->message);

		$this->assertEquals(OTGroupInviteStatus::ACCEPTED, $response->getGroupInviteEvaluation()->getStatus());
	}

	public function testAcceptInvite() {

		$result = OTSDKTestHelper::getDataResetResponse(['make_users', 'make_groups', 'make_group_invites']);
		$this->assertTrue($result->success, $result->message);

		$request = new OTGroupInviteAcceptRequest(1, 'abc.123');
		$response = OTGroupAPI::acceptInvite($request);
		$this->assertTrue($response->success, $response->message);

		$this->assertEquals(OTGroupInviteStatus::ACCEPTED, $response->getGroupInviteEvaluation()->getStatus());
	}

}