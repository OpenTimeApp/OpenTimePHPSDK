<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:23 PM
 */

require_once dirname(__DIR__).'/OpenTimeSDK/api/OTAPIRequest.php';

class TestHelper {

	/**
	 * @param array   $script_names
	 * @param boolean $reset_cache
	 *
	 * @return OTAPIResponse
	 */
	public static function getDataResetResponse(array $script_names, $reset_cache) {

		$scripts             = implode(',', $script_names);
		$reset_cache_command = $reset_cache ? 'YES' : 'NO';

		$parameters = array(
			'clear_cache' => $reset_cache_command,
			'api_key'     => OpenTimeSDK::getKey(),
			'script'      => $scripts
		);

		$request = new OTAPIRequest(
			OpenTimeSDK::getServer() . '/tests/data_restore.php',
			'GET',
			$parameters
		);

		return new OTAPIResponse($request->getResponse());
	}

	public static function getAPIKey(){
		
		global $opentime_api_config;

		return $opentime_api_config['api_key'];
	}

}