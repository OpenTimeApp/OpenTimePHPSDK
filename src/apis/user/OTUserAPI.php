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
require_once __DIR__ . '/invite/OTRejectUserInviteRequest.php';
require_once __DIR__ . '/invite/OTRejectUserInviteResponse.php';
require_once __DIR__ . '/invite/OTAcceptUserInviteRequest.php';
require_once __DIR__ . '/invite/OTAcceptUserInviteResponse.php';

class OTUserAPI {

	const API = 'person';
	const METHOD_SIGN_IN_WITH_EMAIL = 'signInWithEmail';
	const METHOD_REJECT_INVITE = 'rejectInvite';
	const METHOD_ACCEPT_INVITE = 'acceptInvite';

	/**
	 * @param OTLoginRequest $request
	 *
	 * @return OTLoginResponse
	 */
	public static function login(OTLoginRequest $request){

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_SIGN_IN_WITH_EMAIL),
			'GET',
			$request->getParameters()
		);

		$response = new OTLoginResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTRejectUserInviteRequest $request
	 * @return OTAPIResponse|OTRejectUserInviteResponse
	 */
	public static function rejectInvite(OTRejectUserInviteRequest $request) {
		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_REJECT_INVITE),
			'POST',
			$request->getParameters()
		);

		$response = new OTRejectUserInviteResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTAcceptUserInviteRequest $request
	 * @return OTAPIResponse|OTRejectUserInviteResponse
	 */
	public static function acceptInvite(OTAcceptUserInviteRequest $request) {
		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_ACCEPT_INVITE),
			'POST',
			$request->getParameters()
		);

		$response = new OTAcceptUserInviteResponse($request->getResponse());

		return $response;
	}

}