<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class Browser
 * 
 * @package Cielo\API30\Ecommerce
 */
class Browser implements \JsonSerializable {
	const CHROME 	= 'Google Chrome';
	
	const MOZILLA 	= 'Mozilla Firefox';

	const SAFARI 	= 'Safari';
	
	const EDGE 		= 'Microsoft Edge';

	private $browserFingerPrint;
	
	private $cookiesAccepted = false;
	
	private $email;
	
	private $hostName;
	
	private $ipAddress;

	private $type;

	public static function formJson($json)
	{
		$object = \json_decode($json);

		$browser = new Browser();
		$browser->populate($object);

		return $browser;
	}

	/**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
	{
		$this->browserFingerPrint 	= isset($data->BrowserFingerPrint) ? $data->BrowserFingerPrint : null;
		$this->cookiesAccepted 		= isset($data->CookiesAccepted) ? !!$data->CookiesAccepted : false;
		$this->email 				= isset($data->Email) ? $data->Email : null;
		$this->hostName 			= isset($data->HostName) ? $data->HostName : null;
		$this->ipAddress 			= isset($data->IpAddress) ? $data->IpAddress : null;
		$this->type 				= isset($data->Type) ? $data->Type : null;
	}

	/**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

	public function getBrowserFingerprint()
	{
		return $this->browserFingerPrint;
	}

	public function getCookiesAccepted()
	{
		return $this->cookiesAccepted;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getHostName()
	{
		return $this->hostName;
	}

	public function getIpAddress()
	{
		return $this->ipAddress;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setBrowserFingerprint( $browserFingerPrint )
	{
		$this->browserFingerPrint = $browserFingerPrint;

		return $this;
	}

	public function setCookiesAccepted( $cookiesAccepted )
	{
		$this->cookiesAccepted = $cookiesAccepted;

		return $this;
	}

	public function setEmail( $email )
	{
		$this->email = $email;

		return $this;
	}

	public function setHostName( $hostName )
	{
		$this->hostName = $hostName;

		return $this;
	}

	public function setIpAddress( $ipAddress )
	{
		$this->ipAddress = $ipAddress;

		return $this;
	}

	public function setType( $type )
	{
		$this->type = $type;

		return $this;
	}
}