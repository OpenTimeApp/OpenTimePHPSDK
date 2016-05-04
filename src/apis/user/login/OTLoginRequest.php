<?php

class OTLoginRequest {

	private $_email;
	private $_password;


	public function __construct($email, $password) {
		$this->_email = $email;
		$this->_password = $password;
	}

	public function getParameters() {
		$arr = array(
			'email' => $this->_email,
			'password' => $this->_password,
		);

		return $arr;
	}
}