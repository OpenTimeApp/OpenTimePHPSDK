<?php

class OTLoginRequest {

	private $_email;
	private $_password;


	public function __construct($email, $password) {
		$this->_email = $email;
		$this->_password = $password;
	}

	public function getParameters() {

		$encrypted_password = OTPasswordHelper::encryptPlainTextPassword($this->_password);

		$arr = array(
			'email' => $this->_email,
			'password' => $encrypted_password,
		);

		return $arr;
	}
}