<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 7:16 PM
 */

require_once dirname(dirname(__DIR__)).'/api/OTAPIRequest.php';
require_once __DIR__.'/create/OTCreateMeetingRequest.php';
require_once __DIR__.'/create/OTCreateMeetingResponse.php';

class OTMeetingAPI {

	const API = 'meeting';

	/**
	 * @param OTCreateMeetingRequest $request
	 *
	 * @return OTCreateMeetingResponse
	 */
	public static function create(OTCreateMeetingRequest $request){

		$request = new OTAuthorizedAPIRequest(
			OpenTimeSDK::getEndpoint(self::API, ''),
			'POST',
			$request->getParameters()
		);

		$request->makeJSONRequest();

		return new OTCreateMeetingResponse($request->getResponse());
	}

}