<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTGroupInviteValidationHelper.php';

class OTGroupInviteRequest {

	/**
	 * @var array(string)
	 */
	private $_emails;

	/**
	 * @var integer
	 */
	private $_groupId;

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
	 * @var boolean
	 */
	private $_alsoInviteToOrg;

	public function __construct($emails, $groupId, $use_default_message) {
		$this->_emails            = $emails;
		$this->_groupId           = $groupId;
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
		$this->_alsoInviteToOrg   = false;
	}

	public function checkInputs() {
		return OTGroupInviteValidationHelper::validateInviteInputs($this->_emails, $this->_groupId);
	}

	/**
	 * @return array
	 */
	public function getEmails() {
		return $this->_emails;
	}

	/**
	 * @param array $emails
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setEmails($emails) {
		$this->_emails = $emails;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getGroupId() {
		return $this->_groupId;
	}

	/**
	 * @param int $groupId
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setGroupId($groupId) {
		$this->_groupId = $groupId;

		return $this;
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

	/**
	 * @return string
	 */
	public function getSubject() {
		return $this->_subject;
	}

	/**
	 * @param string $subject
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setSubject($subject) {
		$this->_subject = $subject;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->_message;
	}

	/**
	 * @param string $message
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setMessage($message) {
		$this->_message = $message;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isMakeManager() {
		return $this->_makeManager;
	}

	/**
	 * @param boolean $makeManager
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setMakeManager($makeManager) {
		$this->_makeManager = $makeManager;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFromName() {
		return $this->_fromName;
	}

	/**
	 * @param string $fromName
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setFromName($fromName) {
		$this->_fromName = $fromName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFromEmail() {
		return $this->_fromEmail;
	}

	/**
	 * @param string $fromEmail
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setFromEmail($fromEmail) {
		$this->_fromEmail = $fromEmail;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAcceptRedirect() {
		return $this->_acceptRedirect;
	}

	/**
	 * @param string $acceptRedirect
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setAcceptRedirect($acceptRedirect) {
		$this->_acceptRedirect = $acceptRedirect;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeclineRedirect() {
		return $this->_declineRedirect;
	}

	/**
	 * @param string $declineRedirect
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setDeclineRedirect($declineRedirect) {
		$this->_declineRedirect = $declineRedirect;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getNotifyEmail() {
		return $this->_notifyEmail;
	}

	/**
	 * @param string $notifyEmail
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setNotifyEmail($notifyEmail) {
		$this->_notifyEmail = $notifyEmail;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getMessageID() {
		return $this->_messageID;
	}

	/**
	 * @param int|null $messageID
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setMessageID($messageID) {
		$this->_messageID = $messageID;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isAlsoInviteToOrg() {
		return $this->_alsoInviteToOrg;
	}

	/**
	 * @param boolean $alsoInviteToOrg
	 *
	 * @return OTGroupInviteRequest
	 */
	public function setAlsoInviteToOrg($alsoInviteToOrg) {
		$this->_alsoInviteToOrg = $alsoInviteToOrg;

		return $this;
	}

	public function getParameters() {

		$arr = array(
			'emails'              => $this->_emails,
			'group_id'            => $this->_groupId,
			'use_default_message' => $this->_useDefaultMessage,
			'subject'             => $this->_subject,
			'message'             => $this->_message,
			'make_manager'        => $this->_makeManager,
			'from_name'           => $this->_fromName,
			'from_email'          => $this->_fromEmail,
			'accept_redirect'     => $this->_acceptRedirect,
			'decline_redirect'    => $this->_declineRedirect,
			'notify_email'        => $this->_notifyEmail,
			'message_id'          => $this->_messageID,
			'also_invite_to_org'  => $this->_alsoInviteToOrg
		);

		return $arr;
	}

}