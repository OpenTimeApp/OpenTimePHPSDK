<?php

require_once dirname(dirname(__DIR__)) . '/api/OTAPIRequest.php';
require_once __DIR__ . '/invite/OTUserOrgInviteStatusRequest.php';
require_once __DIR__ . '/invite/OTUserOrgInviteStatusResponse.php';
require_once __DIR__ . '/invite/OTUserOrgInviteRequest.php';
require_once __DIR__ . '/invite/OTUserOrgInviteResponse.php';
require_once __DIR__ . '/invite/OTUserOrgInviteStatus.php';
require_once __DIR__ . '/invite/OTUserOrgInviteRejectRequest.php';
require_once __DIR__ . '/invite/OTUserOrgInviteRejectResponse.php';
require_once __DIR__ . '/invite/OTUserOrgInviteAcceptRequest.php';
require_once __DIR__ . '/invite/OTUserOrgInviteAcceptResponse.php';

class OTOrganizationAPI {

	const API                                = 'organization';
	const METHOD_GET_INVITE_STATUS_OF_EMAILS = 'getInviteStatusOfEmails';
	const METHOD_INVITE                      = 'invite';
	const METHOD_REJECT_INVITE               = 'rejectInvite';
	const METHOD_ACCEPT_INVITE               = 'acceptInvite';
	
	public static function getInviteStatusOfEmails(OTUserOrgInviteStatusRequest $request) {

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

		$response = new OTUserOrgInviteStatusResponse($request->getResponse());

		return $response;
	}

	public static function invite(OTUserOrgInviteRequest $request) {

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

		$response = new OTUserOrgInviteResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTUserOrgInviteRejectRequest $request
	 *
	 * @return OTAPIResponse|OTUserOrgInviteRejectResponse
	 */
	public static function rejectInvite(OTUserOrgInviteRejectRequest $request) {
		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_REJECT_INVITE),
			'POST',
			$request->getParameters()
		);

		$response = new OTUserOrgInviteRejectResponse($request->getResponse());

		return $response;
	}

	/**
	 * @param OTUserOrgInviteAcceptRequest $request
	 *
	 * @return OTAPIResponse|OTUserOrgInviteRejectResponse
	 */
	public static function acceptInvite(OTUserOrgInviteAcceptRequest $request) {
		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_ACCEPT_INVITE),
			'POST',
			$request->getParameters()
		);

		$response = new OTUserOrgInviteAcceptResponse($request->getResponse());

		return $response;
	}

}