<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 8:39 PM
 */
class OTAPIResponse {

	public $success;
	public $message;
	public $data;

	public function __construct(OTResponse $response = null) {

		if($response != null) {

			if ($this->_isStatusSuccessful($response->status['http_code'])) {
				$this->_parseResponseFile($response->file);
			} else {
				$this->success = false;

				$response_data = json_decode($response->file);

				if (json_last_error() === JSON_ERROR_NONE) {
					$this->message = $response_data->message;
				} else {
					$this->message = $response->file;
				}
			}
		}
	}

	/**
	 * @param $success
	 * @param $message
	 * @param null $data
	 * @return OTAPIResponse
	 */
	public static function create($success, $message, $data=null) {
		$response = new OTAPIResponse();
		$response->success = $success;
		$response->message = $message;
		$response->data = $data;
		return $response;
	}

	private function _parseResponseFile($file) {
		$response_data = json_decode($file);

		if(json_last_error() === JSON_ERROR_NONE) {
			if(isset($response_data->data)) {
				$this->data = $response_data->data;
			}

			$this->success = $response_data->success;
			$this->message = $response_data->message;
		} else {
			$this->success = false;
			$this->message = 'Could not parse JSON response';
		}
	}

	private function _isStatusSuccessful($http_status_code) {

		$status_map = array(
			200 => true,
			201 => true,
			500 => false,
			400 => false,
			401 => false,
			403 => false,
			405 => false,
			404 => false,
			420 => false,
			422 => false
		);

		if(isset($status_map[$http_status_code])) {
			return $status_map[$http_status_code];
		} else {
			throw new Exception('Unresolved OpenTimeSDK http status code: ' . $http_status_code);
		}
	}

}