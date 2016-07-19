<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserOrgInviteValidationHelper.php';

class OTUserOrgInviteRequest {

	/**
	 * @var string
	 */
	private $_emails;

	/**
	 * @var integer
	 */
	private $_orgId;

	/**
	 * @var boolean
	 */
	private $_useDefaultMessage;

	/**
	 * @var string
	 */
	private $_subject;

	/**
	 * @var string
	 */
	private $_message;

	/**
	 * OTUserOrgInviteRequest constructor.
	 *
	 * @param string  $emails A string with emails in it. Emails will be parsed from this.
	 * @param integer $orgId
	 * @param boolean $use_default_message
	 */
	public function __construct($emails, $orgId, $use_default_message) {
		$this->_emails            = $emails;
		$this->_orgId             = $orgId;
		$this->_useDefaultMessage = $use_default_message;
		$this->_subject           = '';
		$this->_message           = '';
	}

	public function setMessage($message) {
		$this->_message = trim($message);
	}

	public function subject($subject) {
		$this->_subject = trim($subject);
	}

	public function checkInputs() {
		return OTUserOrgInviteValidationHelper::validateGetInviteStatusInputs($this->_emails, $this->_orgId);
	}

	public function getParameters() {

		$arr = array(
			'emails'              => $this->_emails,
			'org_id'              => $this->_orgId,
			'use_default_message' => $this->_useDefaultMessage,
			'subject'             => $this->_subject,
			'message'             => $this->_message
		);

		return $arr;
	}
}