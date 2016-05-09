<?php

require_once dirname(dirname(__DIR__)).'/api/OTAPIRequest.php';
require_once __DIR__ . '/invite/OTUserInviteStatusRequest.php';
require_once __DIR__ . '/invite/OTUserInviteStatusResponse.php';

class OTOrganizationAPI {

	const API = 'organization';
	const METHOD_GET_INVITE_STATUS_OF_EMAILS = 'getInviteStatusOfEmails';


	public static function getInviteStatusOfEmails(OTUserInviteStatusRequest $request){

		$validInputs = $request->checkInputs();
		if(!$validInputs->success) {
			return $validInputs;
		}

		$request = new OTAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, self::METHOD_GET_INVITE_STATUS_OF_EMAILS),
			'GET',
			$request->getParameters()
		);

		$response = new OTUserInviteStatusResponse($request->getResponse());

		return $response;
	}

}