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
	 * @var boolean
	 */
	private $_makeManager;

	/**
	 * @var string
	 */
	private $_fromName;

	/**
	 * @var string
	 */
	private $_fromEmail;

	/**
	 * @var string
	 */
	private $_acceptRedirect;

	/**
	 * @var string
	 */
	private $_declineRedirect;

	/**
	 * @var string
	 */
	private $_notifyEmail;

	/**
	 * The saved invite message id used as a template for the invite
	 *
	 * @var integer|null
	 */
	private $_messageID;

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
		$this->_makeManager       = false;
		$this->_fromName          = null;
		$this->_fromEmail         = null;
		$this->_acceptRedirect    = null;
		$this->_declineRedirect   = null;
		$this->_notifyEmail       = null;
		$this->_messageID         = null;
	}

	public function setMessage($message) {
		$this->_message = trim($message);
	}

	public function setSubject($subject) {
		$this->_subject = trim($subject);
	}

	public function setMakeManager($make_manager) {
		$this->_makeManager = boolval($make_manager);
	}

	public function setFromName($from_name) {
		$this->_fromName = $from_name;
	}

	public function setFromEmail($from_email) {
		$this->_fromEmail = $from_email;
	}

	public function setAcceptRedirect($accept_redirect) {
		$this->_acceptRedirect = $accept_redirect;
	}

	public function setDeclineRedirect($decline_redirect) {
		$this->_declineRedirect = $decline_redirect;
	}

	public function setNotifyEmail($notify_email) {
		$this->_notifyEmail = $notify_email;
	}

	public function setMessageID($message_id){
		$this->_messageID = $message_id;
	}

	/**
	 * @return boolean
	 */
	public function isUseDefaultMessage() {
		return $this->_useDefaultMessage;
	}

	/**
	 * @param boolean $useDefaultMessage
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setUseDefaultMessage($useDefaultMessage) {
		$this->_useDefaultMessage = $useDefaultMessage;

		return $this;
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
			'message'             => $this->_message,
			'make_manager'        => $this->_makeManager,
			'from_name'           => $this->_fromName,
			'from_email'          => $this->_fromEmail,
			'accept_redirect'     => $this->_acceptRedirect,
			'decline_redirect'    => $this->_declineRedirect,
			'notify_email'        => $this->_notifyEmail,
			'message_id'          => $this->_messageID
		);

		return $arr;
	}
}