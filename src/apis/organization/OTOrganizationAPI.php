<?php

require_once dirname(dirname(__DIR__)).'/api/OTAPIRequest.php';
require_once __DIR__ . '/invite/OTUserInviteStatusRequest.php';
require_once __DIR__ . '/invite/OTUserInviteStatusResponse.php';
require_once __DIR__ . '/invite/OTUserInviteRequest.php';
require_once __DIR__ . '/invite/OTUserInviteResponse.php';

class OTOrganizationAPI {

	const API = 'organization';
	const METHOD_GET_INVITE_STATUS_OF_EMAILS = 'getInviteStatusOfEmails';
	const METHOD_INVITE = 'invite';


	public static function getInviteStatusOfEmails(OTUserInviteStatusRequest $request){

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_GET_INVITE_STATUS_OF_EMAILS),
			'GET',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		$response = new OTUserInviteStatusResponse($request->getResponse());

		return $response;
	}

	public static function invite(OTUserInviteRequest $request){

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_INVITE),
			'POST',
			$request->getParameters()
		);

		$response = new OTUserInviteResponse($request->getResponse());

		return $response;
	}

}