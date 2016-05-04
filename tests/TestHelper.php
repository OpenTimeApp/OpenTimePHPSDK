<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:23 PM
 */

require_once dirname(__DIR__).'/src/api/OTAPIRequest.php';

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

		$api_key = $opentime_api_config['api_key'];

		if(!in_array(trim($api_key), array('api key goes here', ''))){
			return $api_key;
		}else{
			throw new Exception('You must set your OpenTime api key in tests/test_config.php');
		}
	}

	public static function getTestServer(){

		global $opentime_api_config;

		$api_key = $opentime_api_config['server'];

		if(!in_array(trim($api_key), array('server goes here', ''))){
			return $api_key;
		}else{
			throw new Exception('You must set your OpenTime test server in tests/test_config.php');
		}
	}

}