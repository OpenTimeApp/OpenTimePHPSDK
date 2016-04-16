<?php
/**
 * Interface for proxy providers.
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

interface OTI_ProxyProvider
{

	/**
	 * Gets the IP address of the proxy.
	 *
	 * @param string $lstrProxy The proxy to parse in format in format 'xx.xxx.xx.xx:xxxx'.
	 *
	 * @return string
	 */
	public function getProxyIP($lstrProxy);

	/**
	 * Gets the port of the proxy.
	 *
	 * @param string $lstrProxy The proxy to parse in format in format 'xx.xxx.xx.xx:xxxx'.
	 *
	 * @return string
	 */
	public function getProxyPort($lstrProxy);

	/**
	 * Gets the proxy IP and port in format {proxy}:{port}.
	 *
	 * @return string
	 */
	public function getProxy();

}

?>