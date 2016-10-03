<?php
/**
 * Request communicates with other webserives through cURL for various TCP/IP requests.
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

require_once 'Response.php';
require_once 'InvalidMethodException.php';
require_once 'InvalidProxyProviderException.php';
require_once 'ProxyProvider' . DIRECTORY_SEPARATOR . 'I_ProxyProvider.php';


if(!defined('COOKIE_FOLDER')) {
	
	$lstrCookieFolder;

	if(DIRECTORY_SEPARATOR === '/')
	{
		$lstrCookieFolder = '/tmp/';
	}else{
		$lstrCookieFolder = 'C:\\tmp\\';
	}

	define('COOKIE_FOLDER', $lstrCookieFolder);
}

/**
 * Request.
 */
class OTRequest
{
	// Constants.
	const DEFAULT_TIMEOUT_SECONDS = 120;
	const TIMEOUT_MULIPLIER       = 10;
	const AGENT_NAME              = 'Mozilla/5.0 (Windows; U; MSIE 9.0; WIndows NT 9.0; en-US)';
	const COOKIE_FILE             = 'cookie.txt';
	const CURL_TIMEOUT            = 120;
	const MAX_PROXY_RESPONSE_TIME = 5;
	const MAX_SAFESEARCH_TIME     = 1;
	const MIN_SAFESEARCH_TIME     = 0.5;

	/*
	 * Public variables.
	 */

	/**
	 * The url of the resource we want to download/utilize.
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Http Referrer: Where we are going to tell the server we came from.
	 *
	 * @var string
	 */
	public $ref;

	/**
	 * The http method to use. 'GET' or 'POST'.
	 *
	 * @var string
	 */
	public $meth;

	/**
	 * An associative array containing the data we want to send to the resource in the url.
	 *
	 * @var array
	 */
	public $data;

	/**
	 * Whether or not to include the response header in the response text.
	 *
	 * @var boolean
	 */
	public $header;

	/**
	 * The IP address of a proxy to use for the request.
	 *
	 * @var string
	 */
	public $ip;

	/**
	 * The port of a proxy to use for the request.
	 *
	 * @var integer
	 */
	public $port;

	/**
	 * The type of browser we are saying we are using.
	 *
	 * @var string
	 */
	public $agent;
	
	private $mobjHeaders = array();

	/*
	 * Private variables
	 */

	/**
	 * The number of seconds to wait for a response before we give up.
	 *
	 * @var integer
	 */
	private $mintTimeOut;

	/**
	 * An array of cookie values to send to the resource in the specified URL.
	 *
	 * @var array
	 */
	private $mobjCookies = array();

	/**
	 * When the resource sends us cookies, the location of the file to save them in.
	 *
	 * @var string
	 */
	private $mstrCookieFile;

	/**
	 * The timestamp of the last request from this object.
	 *
	 * @var integer
	 */
	private $mintLastRequestTime = null;

	/**
	 * Whether or not we specified the data we are sending to the resource as a string instead of an array.
	 *
	 * @var boolean
	 */
	private $mboolUseStringData = false;

	/**
	 * Whether or not to close the connection after requesting a resource. Usually false for SSL connection environments.
	 *
	 * @var boolean
	 */
	private $mboolCloseCurlConnectionAfterRequest = true;

	/**
	 * Whether or not to use a proxy.
	 *
	 * @var boolean
	 */
	private $mboolHideIP = false;

	/**
	 * When using an external dynamic list of proxies, which country should we use proxies from.
	 *
	 * @var string
	 */
	private $mstrProxyCountry = 'us';

	/**
	 * Whether or not to use an SSL connnection layer when making requests.
	 *
	 * @var boolean
	 */
	private $mboolSSL = false;

	/**
	 * The cURL resource object.
	 *
	 * @var resource
	 */
	private $mobjCurlConnection = null;

	/**
	 * Whether or not to log when a proxy did not behave as expected.
	 *
	 * @var boolean
	 */
	private $mboolReportBadProxy = true;

	/**
	 * Whether or not to delete the cookie file after the request.
	 *
	 * @var boolean
	 */
	private $mboolDeleteCookie = true;

	/**
	 * Whether or not to delay requests to appear more like a human.
	 *
	 * @var boolean
	 */
	private $mboolSafeSearch = false;

	/**
	 * An array of data from the last http request response.
	 *
	 * @var array
	 */
	private $mobjLastResponse = null;

	/**
	 * The microtime timestamp just before the request started execution.
	 *
	 * @var double
	 */
	private $mdblStartTime;

	/**
	 * The microtime timestamp just after the request completed execution.
	 *
	 * @var double
	 */
	private $mdblEndTime;

	/**
	 * The name of the proxy provider to use when requesting a proxy.
	 *
	 * @var I_ProxyProvider
	 */
	private $mobjProxyProvider;

	private $mobjIsJsonRequest = false;

	/**
	 * Constructor.
	 *
	 * @param string  $lstrURL     The url of the resource we want to download/utilize.
	 * @param string  $lstrReferer The page we are saying we are coming from as if we were navigating on a web browser.
	 * @param string  $lstrMethod  The method to use for the request. 'GET', 'POST', or 'HEAD'.
	 * @param array   $lobjData    The array of data to send to the resource in the url given.
	 * @param boolean $lboolHeader Whether or not to include the response header in the response text.
	 * @param string  $lstrIP      The IP of the proxy to be used in the request.
	 * @param integer $lintPort    The port of the proxy to be used in the request.
	 */
	public function __construct($lstrURL, $lstrReferer, $lstrMethod, array $lobjData, $lboolHeader = false, $lstrIP='', $lintPort='')
	{
		$this->url         = $lstrURL;
		$this->ref         = $lstrReferer;
		$this->meth        = $lstrMethod;
		$this->data        = $lobjData;
		$this->header      = $lboolHeader;
		$this->ip          = $lstrIP;
		$this->port        = $lintPort;
		$this->agent       = self::AGENT_NAME;
		$this->mintTimeOut = self::DEFAULT_TIMEOUT_SECONDS;

		// Validate arguments.
		$this->validateRequestMethod($lstrMethod);

		// Initialize object variables.
		$this->initializeConnectionObject();
		$this->initializeCookieLocation();
	}

	/**
	 * Closes the current CurlConnection.
	 *
	 * @return void
	 */
	public function closeCURLConnection()
	{
		if($this->mobjCurlConnection !== null)
		{
			curl_close($this->mobjCurlConnection);
			$this->mobjCurlConnection = null;
		}
	}

	/**
	 * Makes a cURL request based upon the settings set in the object.
	 *
	 * @return OTResponse
	 */
	public function getResponse()
	{
		$lobjResponse      = null;
		$lstrData          = '';
		$lstrProxyLocation = '';
		$lstrUrl           = '';
		$ldblStart         = 0;
		$ldblEnd           = 0;
		$ldblLength        = 0;

		$this->setUpRequest();

		if($this->url !== '')
		{
			$lstrData = $this->getDataString();
			$this->setUpConnectionOptions($lstrData);

			$lboolProxySuccess = $this->setUpProxy();

			if($lboolProxySuccess === false)
			{
				$lobjResponse = $this->getRequestResponse('', array(), 'Could not obtain Proxy', 0);

				return $lobjResponse;
			}

			$this->createRequest();

			$lobjResponse = $this->buildResponse();

			$this->tearDownResponse();

			return $lobjResponse;
		}else{
			$lobjResponse = $this->getRequestResponse('', array(), 'Url Not Set', 0);

			return $lobjResponse;
		}//end if
	}

	/**
	 * Sets the value that states whether or not the http_build_query function should be used to build request data string.
	 *
	 * @param boolean $lboolUseStringData Whether or not to use a string intead of an array as the post/get data sent with TCP/IP request.
	 *
	 * @return void
	 */
	public function setUseStringData($lboolUseStringData)
	{
		$this->mboolUseStringData = $lboolUseStringData;
	}

	/**
	 * Sets the value that determines whether or not the curl connection should be closed after the request is made.
	 *
	 * @param boolean $lboolCloseConnection Whether or not to close the connection after the TCP/IP request.
	 *
	 * @return void
	 */
	public function setCloseConnection($lboolCloseConnection)
	{
		$this->mboolCloseCurlConnectionAfterRequest = $lboolCloseConnection;
	}

	/**
	 * Sets wether or not to use a proxy and if so at which location(s).
	 *
	 * @param boolean $lboolHide        Whether or not to use a proxy.
	 * @param boolean $lboolSSL         Whether or not to use secure socket layer transfer protocol.
	 * @param boolean $lboolReport      Whether or not to record a proxy that did not behave as expected.
	 * @param string  $lstrProxyCountry The country to include or disinclude.
	 * @param boolean $lboolInclude     Whether or not to include or disinclude the country.
	 *
	 * @return void
	 */
	public function setHideSettings($lboolHide, $lboolSSL=false, $lboolReport=true, $lstrProxyCountry='', $lboolInclude=false)
	{
		$this->mboolHideIP = $lboolHide;
		$this->mboolSSL = $lboolSSL;
		$this->mboolReportBadProxy = $lboolReport;
		if($lstrProxyCountry !== '')
		{
			$this->mstrProxyCountry = $lstrProxyCountry;
		}

		$this->mboolIncludeCountryProxies = $lboolInclude;
	}

	/**
	 * Adds a cookie that will be sent with the request.
	 *
	 * @param string $lstrCookie The value of the cookie to set.
	 *
	 * @return void
	 */
	public function setCookie($lstrCookie)
	{
		array_push($this->mobjCookies, $lstrCookie);
	}

	/**
	 * Sets teh Curl Connection resource link associated with the current Request object.
	 *
	 * @param resource $lobjCurlConnection The system resource that represents a cURL object.
	 *
	 * @return void
	 */
	public function setCURLConnection($lobjCurlConnection)
	{
		$this->mobjCurlConnection = $lobjCurlConnection;
	}

	/**
	 * Gets the CurlConnection resource associated with the current Request object.
	 *
	 * @return resource
	 */
	public function getCURLConnection()
	{
		return $this->mobjCurlConnection;
	}

	/**
	 * Sets the proxy ip and port for the current Request object.
	 *
	 * @param string $lstrIP   The IP address of the proxy.
	 * @param string $lstrPort The port of the proxy.
	 *
	 * @return void
	 */
	public function setProxy($lstrIP, $lstrPort)
	{
		$this->ip   = $lstrIP;
		$this->port = $lstrPort;
	}

	/**
	 * Gets the I_ProxyProvider to use for obtaining proxies.
	 *
	 * @return I_ProxyProvider
	 */
	private function getProxyProvider()
	{
		return $this->mobjProxyProvider;
	}

	/**
	 * Set the option of whether or not to delete cookies received with the response from the resource server.
	 *
	 * @param boolean $lboolDeleteCookie Wheter or not to delete cookies.
	 *
	 * @return void
	 */
	public function setDeleteCookie($lboolDeleteCookie)
	{
		$this->mboolDeleteCookie = $lboolDeleteCookie;
	}

	/**
	 * Set the option of whether or not to use a time gap between requests to appear more like a human.
	 *
	 * @param boolean $lboolSafeSearch Whether or not to use a time gap between requests.
	 *
	 * @return void
	 */
	public function setSafeSearch($lboolSafeSearch)
	{
		$this->mboolSafeSearch = $lboolSafeSearch;
	}

	/**
	 * Sets the maximum amount of time to wait for a response from a server.
	 *
	 * @param integer $lintTimeOut The maximum number of seconds to wait.
	 *
	 * @return void
	 */
	public function setTimeOut($lintTimeOut)
	{
		$this->mintTimeOut = $lintTimeOut;
	}

	public function setHeaderOption($name, $value){
		
		$this->mobjHeaders[$name] = $value;
		
		curl_setopt($this->getCURLConnection(), CURLOPT_HTTPHEADER, $this->getHeaders());
	}
	
	/*
	 * Private functions.
	 */

	/**
	 * Checks if the request needs to sleep because safe search property is on.
	 *
	 * @return boolean
	 */
	private function sleepForSafeSearch()
	{
		if($this->mintLastRequestTime === null)
		{
			return false;
		}

		$lintCurrentTime = microtime(true);
		$lintCurrentTime = explode(' ', $lintCurrentTime);
		$lintCurrentTime = ($lintCurrentTime[1] + $lintCurrentTime[0]);
		$lintTimePassed  = ($lintCurrentTime - $this->mintLastRequestTime);

		if($lintTimePassed < self::MAX_SAFESEARCH_TIME)
		{
			return true;
		}

		return false;
	}

	/**
	 * Initializes cookie and cURL connection object.
	 *
	 * @return void
	 */
	private function setUpRequest()
	{
		if($this->mobjCurlConnection === null)
		{
			$this->setCURLConnection(curl_init());
		}

		if($this->mboolDeleteCookie === true && file_exists($this->mstrCookieFile) === true)
		{
			if(is_dir($this->mstrCookieFile) === false)
			{
				$lboolResult = unlink($this->mstrCookieFile);
			}else{
				$lboolResult = rrmdir($this->mstrCookieFile);
			}
		}
	}

	/**
	 * Gets a string of data to send the the server in url format.
	 *
	 * @return string
	 */
	private function getDataString()
	{

		if($this->mobjIsJsonRequest){
			return json_encode($this->data);
		}

		$lstrUrl = $this->url;
		$lstrData = '';

		if($this->data !== '' && $this->data !== null)
		{
			if($this->mboolUseStringData === true)
			{
				if(is_array($this->data) === true)
				{
					foreach($this->data as $key => $value)
					{
						$lstrData .= urlencode($key) . '=' . urlencode($value) . '&';
					}

					$lstrData = substr_replace($lstrData, '', -1);

					$this->data = $lstrData;
				}

				$lstrData = $this->data;
			}else{
				$lstrData = http_build_query($this->data);
			}
		}else{
			$lstrData = '';
		}//end if

		return $lstrData;
	}

	/**
	 * Gets the time that the request will wait.
	 *
	 * @return integer
	 */
	public function getTimeout()
	{
		return $this->mintTimeOut;
	}

	/**
	 * Sets the connection options based on the request method.
	 *
	 * @param string $lstrData A data string which may be used for GET or POST methods.
	 *
	 * @return void
	 */
	private function setUpConnectionOptions($lstrData)
	{
		switch($this->meth)
		{
			case 'HEAD':
				$this->setHeadOptions();
			case 'GET':
				$this->setGetOptions($lstrData);
				break;

			case 'POST':
				$this->setPostOptions($lstrData);
				break;

			default:
				// There is no other valid methods.
				break;
		}
	}

	/**
	 * Sets the cURL options if 'HEAD' is given as the request method.
	 *
	 * @return void
	 */
	private function setHeadOptions()
	{
		curl_setopt($this->mobjCurlConnection, CURLOPT_HEADER, TRUE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_NOBODY, TRUE);
	}

	/**
	 * Sets the get options on the cURL object.
	 *
	 * @param string $lstrData The data string to send to the server in url format.
	 *
	 * @return void
	 */
	private function setGetOptions($lstrData)
	{
		if($lstrData !== '')
		{
			$this->url .= '?' . $lstrData;
		}

		curl_setopt($this->mobjCurlConnection, CURLOPT_HTTPGET, TRUE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_POST, FALSE);

		curl_setopt($this->mobjCurlConnection, CURLOPT_HEADER, $this->header);
		curl_setopt($this->mobjCurlConnection, CURLOPT_NOBODY, FALSE);
	}

	/**
	 * Sets the post options on the cURL object.
	 *
	 * @param string $lstrData The data string to send to the server in url format.
	 *
	 * @return void
	 */
	private function setPostOptions($lstrData)
	{
		if($lstrData !== '')
		{
			curl_setopt($this->mobjCurlConnection, CURLOPT_POSTFIELDS, $lstrData);
		}

		curl_setopt($this->mobjCurlConnection, CURLOPT_POST, TRUE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_HTTPGET, FALSE);

		curl_setopt($this->mobjCurlConnection, CURLOPT_HEADER, $this->header);
		curl_setopt($this->mobjCurlConnection, CURLOPT_NOBODY, FALSE);
	}

	/**
	 * Delays execution for a random period of time to simulate human usage.
	 *
	 * @return void
	 */
	private function initiateSafeSearch()
	{
		if($this->mboolSafeSearch === true)
		{
			if($this->sleepForSafeSearch() === true)
			{
				$lintRandomSleep = rand(self::MIN_SAFESEARCH_TIME, self::MAX_SAFESEARCH_TIME);

				sleep($lintRandomSleep);
			}
		}
	}

	public function makeJSONRequest(){

		$data_string = json_encode($this->data);

		$this->setHeaderOption('Content-Type', 'application/json');
		$this->setHeaderOption('Content-Length', strlen($data_string));

		$this->mobjIsJsonRequest = true;
	}

	/**
	 * Sets all the miscellaneous properties of the cURL object.
	 *
	 * @return void
	 */
	private function createRequest()
	{
		curl_setopt($this->mobjCurlConnection, CURLOPT_COOKIEJAR, $this->mstrCookieFile);
		curl_setopt($this->mobjCurlConnection, CURLOPT_COOKIEFILE, $this->mstrCookieFile);

		curl_setopt($this->mobjCurlConnection, CURLOPT_TIMEOUT, $this->mintTimeOut);
		curl_setopt($this->mobjCurlConnection, CURLOPT_USERAGENT, $this->agent);
		curl_setopt($this->mobjCurlConnection, CURLOPT_URL, $this->url);
		curl_setopt($this->mobjCurlConnection, CURLOPT_REFERER, $this->ref);
		curl_setopt($this->mobjCurlConnection, CURLOPT_VERBOSE, FALSE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($this->mobjCurlConnection, CURLOPT_MAXREDIRS, 8);
		curl_setopt($this->mobjCurlConnection, CURLOPT_RETURNTRANSFER, TRUE);
	}

	/**
	 * Sets the settings for a proxy if appropriate. Returns true if setting up the proxy was successful.
	 *
	 * @return boolean
	 */
	private function setUpProxy()
	{
		if($this->mboolHideIP === true)
		{
			$lobjProxyProvider = $this->getProxyProvider();

			$lstrProxyLocation = $lobjProxyProvider->getProxy();

			if($lstrProxyLocation !== '')
			{
				curl_setopt($this->mobjCurlConnection, CURLOPT_PROXY, $lstrProxyLocation);
				curl_setopt($this->mobjCurlConnection, CURLOPT_CONNECTTIMEOUT, $this->mintTimeOut);
			}else{
				return false;
			}
		}//end if

		if($this->mboolSSL === true)
		{
			curl_setopt($this->mobjCurlConnection, CURLOPT_COOKIESESSION, true);
			curl_setopt($this->mobjCurlConnection, CURLOPT_HTTPPROXYTUNNEL, true);
		}

		return true;
	}

	/**
	 * Executes the response and returns the results.
	 *
	 * @return Response
	 */
	private function buildResponse()
	{
		$ldblStart = microtime(true);

		$lstrFile   = curl_exec($this->mobjCurlConnection);
		$lobjStatus = curl_getinfo($this->mobjCurlConnection);
		$lstrError  = curl_error($this->mobjCurlConnection);

		$ldblEnd = microtime(true);

		$ldblLength = ($ldblEnd - $ldblStart);

		$lobjResponse = new OTResponse($lstrFile, $lobjStatus, $lstrError, $ldblLength);

		return $lobjResponse;
	}

	/**
	 * Closes the cURL connection object and deletes the cookie based on given settings.
	 *
	 * @return void
	 */
	private function tearDownResponse()
	{
		if($this->mboolDeleteCookie === true)
		{
			if(file_exists($this->mstrCookieFile) === true)
			{
				if(is_dir($this->mstrCookieFile) === false)
				{
					unlink($this->mstrCookieFile);
				}else{
					rrmdir($this->mstrCookieFile);
				}
			}
		}

		if($this->mboolCloseCurlConnectionAfterRequest === true)
		{
			$this->closeCURLConnection();
		}
	}

	/**
	 * Sets the location and name of the cookie file based on runtime environment.
	 *
	 * @return void
	 */
	private function initializeCookieLocation()
	{
		if($this->mstrCookieFile === null)
		{
			// When running localhost use 'C:\Windows\Temp' due to permission issues.
			$this->mstrCookieFile = tempnam(COOKIE_FOLDER, self::COOKIE_FILE);
		}
	}

	/**
	 * Set the file name for the cookie.
	 *
	 * @param string $lstrFileName The resource location of the file to be used for storing cookies.
	 *
	 * @return void
	 */
	public function setCookieLocation($lstrFileName)
	{
		if(file_exists($this->mstrCookieFile) === true)
		{
			if(is_dir($this->mstrCookieFile) === false)
			{
				unlink($this->mstrCookieFile);
			}
		}

		$this->mstrCookieFile = $lstrFileName;
	}

	/**
	 * Creates a new cURL connection object if it doesn't already exist.
	 *
	 * @return void
	 */
	private function initializeConnectionObject()
	{
		if($this->getCURLConnection() === null)
		{
			$this->setCURLConnection(curl_init());
		}
	}

	/**
	 * Creates and sets a proxy provider based on the given provider name.
	 *
	 * @param string $lstrProxyProviderName The name of the proxy provider.
	 *
	 * @throws InvalidProxyProviderException When an invalid proxy provider name is given.
	 *
	 * @return void
	 */
	private function initializeProxyProvider($lstrProxyProviderName)
	{
		$this->mobjProxyProvider = $this->getProxyProviderObject($lstrProxyProviderName);
	}

	/**
	 * Gets the proxy provider object given the proxy provider class name.
	 *
	 * @param string $lstrProxyProviderName The name of the proxy provider.
	 *
	 * @throws InvalidProxyProviderException When the name of a proxy provider class does not exist.
	 *
	 * @return I_ProxyProvider
	 */
	private function getProxyProviderObject($lstrProxyProviderName)
	{
		$lstrProxyClass = $lstrProxyProviderName . 'ProxyProvider';

		$lstrFileName = __DIR__ . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $lstrProxyClass . '.php';

		if(file_exists($lstrFileName) === true)
		{
			include_once $lstrFileName;
		}else{
			throw new OTInvalidProxyProviderException("No class file for proxy provider: '{$lstrProxyProviderName}'");
		}

		$lobjProxy = null;

		if(class_exists($lstrProxyClass) === true)
		{
			 $lobjProxy = new $lstrProxyClass();
		}else{
			throw new OTInvalidProxyProviderException("The file exists for '{$lstrProxyProviderName}' but the class has not been declared");
		}

		return $lobjProxy;
	}

	/**
	 * Validates the http request method given in the constructor.
	 *
	 * @param string $lstrMethod The method given in the constructor. 'GET', 'POST', or 'HEAD'.
	 *
	 * @throws InvalidMethodException When an invalid method is given.
	 * @return void
	 */
	private function validateRequestMethod($lstrMethod)
	{
		if(in_array($lstrMethod, array('GET', 'POST', 'HEAD')) === false)
		{
			throw new OTInvalidMethodException($lstrMethod);
		}
	}

	private function getHeaders(){
		$headers = array();
		
		foreach($this->mobjHeaders as $key => $value) {
			array_push($headers, $key . ': '.$value);
		}
		
		return $headers;
	}
	
	/**
	 * Sets an option on the curl connection object.
	 *
	 * @param integer $lintOption The option number.
	 * @param string  $lstrValue  The value of the option.
	 *
	 * @return void
	 */
	public function setOption($lintOption, $lstrValue)
	{
		$lobjCurl = $this->getCURLConnection();
		curl_setopt($lobjCurl, $lintOption, $lstrValue);
	}

}

?>