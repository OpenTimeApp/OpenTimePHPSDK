<?php
/**
 * Exception thrown when an invalid method is given to the Request object.
 *
 * PHP Version 5.4
 *
 * @category PHP
 * @package Request
 * @subpackage None
 * @author Josh Woodcock <joshwoodcock@beagile.biz>
 * @copyright 2012-2013 Be Agile, LLC
 * @license http://beagile.biz Contractual License Program
 * @link http://beagile.biz
 */

/**
 * InvalidMethodException.
 */
class OTInvalidMethodException extends Exception
{

	/**
	 * Constructor.
	 *
	 * @param string $lstrMethodName The name of the method that was given.
	 *
	 * @return void
	 */
	public function __construct($lstrMethodName)
	{
		parent::__construct("Invalid method given. Allowed: 'POST', 'GET', or 'HEAD'. Found: '{$lstrMethodName}'");
	}

}

?>