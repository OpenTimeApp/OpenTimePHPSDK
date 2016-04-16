<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 10:25 PM
 */

require_once 'OTAPIRequest.php';

class OTAuthorizedAPIRequest extends OTAPIRequest {

	const PASSWORD = 'Password';
	const USER_ID  = 'User-Id';

	public function __construct($lstrURL, $lstrMethod, array $lobjData) {
		parent::__construct($lstrURL, $lstrMethod, $lobjData);

		$this->setHeaderOption(self::PASSWORD, OpenTimeSDK::getService()->getEncryptedPassword());
		$this->setHeaderOption(self::USER_ID, OpenTimeSDK::getService()->getUserID());
	}

}