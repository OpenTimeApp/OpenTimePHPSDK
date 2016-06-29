<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:38 PM
 */

require_once dirname(__DIR__).'/autoload.php';
require_once __DIR__.'/OTSDKTestHelper.php';
require_once __DIR__.'/test_config.php';

class OTAPITestParent extends PHPUnit_Framework_TestCase {

	public function setUp() {
		parent::setUp();
		OpenTimeSDK::initService(OTSDKTestHelper::getAPIKey(), true);
		OpenTimeSDK::getService()->setServer(OTSDKTestHelper::getTestServer());
		OpenTimeSDK::getService()->setPlainTextCredentials(1, 'I love testing');
		OpenTimeSDK::getService()->disableMessaging();
	}

}