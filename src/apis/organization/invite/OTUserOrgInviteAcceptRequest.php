<?php
require_once dirname(dirname(dirname(__DIR__))) . '/helpers/OTUserInviteValidationHelper.php';

class OTUserOrgInviteAcceptRequest {

	private $_email;
	private $_orgId;
	private $_firstName;
	private $_lastName;
	private $_cellPhone;
	private $_password;

	public function __construct($email, $orgId, $firstName=null, $lastName=null, $cellPhone=null, $password=null, $confirmPassword=null) {
		$this->_email = $email;
		$this->_orgId = $orgId;
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_cellPhone = $cellPhone;
		$this->_password = $password;
		$this->_confirmPassword = $confirmPassword;
	}

	public function checkInputs() {
		return OTUserInviteValidationHelper::validateAcceptInviteInputs($this->_email, $this->_orgId, $this->_firstName, $this->_lastName, $this->_cellPhone, $this->_password, $this->_confirmPassword);
	}

	public function getParameters() {

		$arr = array(
			'email' => $this->_email,
			'org_id' => $this->_orgId,
			'first_name' => $this->_firstName,
			'last_name' => $this->_lastName,
			'cell_phone' => $this->_cellPhone,
			'password' => $this->_password,
			'confirm_password' => $this->_confirmPassword,
		);

		return $arr;
	}
}