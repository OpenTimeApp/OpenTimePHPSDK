<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 4/15/16
 * Time: 9:46 PM
 */

class OTPasswordHelper {

	public static function encryptPlainTextPassword($password){
		$hash1 = self::_encryptString($password);
		$hash2 = self::_encryptHashedPassword($hash1);

		return $hash2;
	}

	private static function _encryptString($string){
		$mash = OTConstant::SALT_1 . $string;
		$hash = md5($mash);

		return $hash;
	}

	private static function _encryptHashedPassword($string){
		$mash = OTConstant::SALT_2 . $string;
		$hash = md5($mash);

		return $hash;
	}
}