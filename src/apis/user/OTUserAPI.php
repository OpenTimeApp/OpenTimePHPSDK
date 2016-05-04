<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 7:16 PM
 */

require_once dirname(dirname(__DIR__)).'/api/OTAPIRequest.php';
require_once __DIR__ . '/login/OTLoginRequest.php';
require_once __DIR__ . '/login/OTLoginResponse.php';

class OTUserAPI {

	const API = 'person';
	const METHOD_SIGIN_WITH_EMAIL = 'signInWithEmail';

	/**
	 * @param OTLoginRequest $request
	 *
	 * @return OTLoginRespoonse
	 */
	public static function login(OTLoginRequest $request){

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_SIGIN_WITH_EMAIL),
			'GET',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTLoginRespoonse($request->getResponse());

		return $response;
	}

}