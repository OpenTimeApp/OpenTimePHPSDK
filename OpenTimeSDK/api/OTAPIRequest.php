<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 8:02 PM
 */

require_once dirname(__DIR__).'/library/Request/Request.php';

class OTAPIRequest extends OTRequest {

	public function __construct($lstrURL, $lstrMethod, array $lobjData) {
		parent::__construct($lstrURL, OpenTimeSDK::getReferrer(), $lstrMethod, $lobjData);

		$this->setHeaderOption(OTConstant::API_KEY_NAME, OpenTimeSDK::getKey());
		$this->setHeaderOption('V', OTConstant::API_VERSION);
	}
}