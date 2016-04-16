<?php
/**
 * Object which contains the response from a TCP/IP request.
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
 * Response.
 */
class OTResponse
{

	/**
	 * TCP/IP response body.
	 *
	 * @var string
	 */
	public $file;

	/**
	 * Array of information about request result.
	 *
	 * @var array
	 */
	public $status;

	/**
	 * A message stating what went wrong.
	 *
	 * @var string
	 */
	public $error;

	/**
	 * Number of seconds we waited for a response.
	 *
	 * @var double
	 */
	public $time;

	/**
	 * Constructor.
	 *
	 * @param string $lstrFile   The http response text.
	 * @param array  $lobjStatus An array of information about the status of the response.
	 * @param string $lstrError  An error message if any.
	 * @param double $ldblTime   The amount of seconds the request took.
	 */
	public function __construct($lstrFile, array $lobjStatus, $lstrError, $ldblTime)
	{
		$this->file   = $lstrFile;
		$this->status = $lobjStatus;
		$this->error  = $lstrError;
		$this->time   = $ldblTime;
	}

}

?>