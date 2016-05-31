<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 5/26/16
 * Time: 12:42 PM
 */

require_once dirname(dirname(__DIR__)) . '/api/OTAPIRequest.php';
require_once __DIR__ . '/invite/OTGroupInviteStatusRequest.php';
require_once __DIR__ . '/invite/OTGroupInviteStatusResponse.php';
require_once __DIR__ . '/invite/OTGroupInviteRequest.php';
require_once __DIR__ . '/invite/OTGroupInviteResponse.php';
require_once __DIR__ . '/invite/OTGroupInviteEvaluationStatus.php';
require_once __DIR__ . '/invite/OTGroupInviteStatus.php';
require_once __DIR__ . '/invite/OTGroupInviteRejectRequest.php';
require_once __DIR__ . '/invite/OTGroupInviteRejectResponse.php';
require_once __DIR__ . '/invite/OTGroupInviteAcceptRequest.php';
require_once __DIR__ . '/invite/OTGroupInviteAcceptResponse.php';

class OTGroupAPI {

	const API                                = 'group';
	const METHOD_GET_INVITE_STATUS_OF_EMAILS = 'getInviteStatusOfEmails';
	const METHOD_INVITE                      = 'invite';
	const METHOD_REJECT_INVITE               = 'rejectInvite';
	const METHOD_ACCEPT_INVITE               = 'acceptInvite';

	/**
	 * @param OTGroupInviteStatusRequest $request
	 *
	 * @return OTAPIResponse|OTGroupInviteStatusResponse
	 */
	public static function getInviteStatusOfEmails(OTGroupInviteStatusRequest $request) {

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_GET_INVITE_STATUS_OF_EMAILS),
			'POST',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTGroupInviteStatusResponse($request->getResponse());

		return $response;
	}

	public static function invite(OTGroupInviteRequest $request) {

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_INVITE),
			'POST',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTGroupInviteResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTGroupInviteRejectRequest $request
	 *
	 * @return OTAPIResponse|OTGroupInviteRejectResponse
	 */
	public static function rejectInvite(OTGroupInviteRejectRequest $request) {
		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_REJECT_INVITE),
			'POST',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTGroupInviteRejectResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTGroupInviteAcceptRequest $request
	 *
	 * @return OTAPIResponse|OTGroupInviteRejectResponse
	 */
	public static function acceptInvite(OTGroupInviteAcceptRequest $request) {

		$validInputs = $request->checkInputs();

		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_ACCEPT_INVITE),
			'POST',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTGroupInviteAcceptResponse($request->getResponse());

		return $response;
	}

}