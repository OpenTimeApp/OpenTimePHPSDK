<?php

require_once dirname(__DIR__) . '/OTAPITest.php';
require_once dirname(dirname(__DIR__)).'/src/apis/organization/OTOrganizationAPI.php';

class OTOrganizationAPITest extends OTAPITest {

	public function testInvite() {

		$request = new OTUserInviteRequest('tester1@app.opentime.com test2@gmail.com', 1);
		$response = OTOrganizationAPI::invite($request);
		$this->assertTrue($response->success, $response->message);
	}

}