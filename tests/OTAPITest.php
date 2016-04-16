<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:38 PM
 */

require_once dirname(__DIR__).'/autoload.php';
require_once __DIR__.'/TestHelper.php';
require_once __DIR__.'/test_config.php';

class OTAPITest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		parent::setUp();
		OpenTimeSDK::initService(TestHelper::getAPIKey(), true);
		OpenTimeSDK::getService()->setPlainTextCredentials(1, 'I love testing');
	}

}