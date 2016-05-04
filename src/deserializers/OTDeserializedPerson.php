<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 5/4/16
 * Time: 2:14 PM
 */

require_once __DIR__ . '/UserStatus.php';

class OTDeserializedPerson {

	/**
	 * @var integer
	 */
	private $_userId;

	/**
	 * @var string
	 */
	private $_firstName;

	/**
	 * @var string
	 */
	private $_lastName;

	/**
	 * @var string
	 */
	private $_imageName;

	/**
	 * @var string
	 */
	private $_profileSummary;

	/**
	 * @var integer
	 */
	private $_status;

	private $_type;

	/**
	 * OTDeserializedPerson constructor.
	 *
	 * @param $data stdClass
	 */
	public function __construct($data) {

		// Required
		$this->_userId    = $data->user_id;
		$this->_firstName = $data->first_name;
		$this->_lastName  = $data->last_name;
		$this->_imageName = $data->profile_img;

		// Optional
		$this->_profileSummary = isset($data->profile_summary) ? $data->profile_summary : '';
		$this->_status         = isset($data->status) ? $data->status : UserStatus::ACTIVE;
	}

	/**
	 * @return integer
	 */
	public function getUserId() {
		return $this->_userId;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->_firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->_lastName;
	}

	/**
	 * @return string
	 */
	public function getImageName() {
		return $this->_imageName;
	}

	/**
	 * @return string
	 */
	public function getProfileSummary() {
		return $this->_profileSummary;
	}

	/**
	 * @return int
	 */
	public function getStatus() {
		return $this->_status;
	}

}