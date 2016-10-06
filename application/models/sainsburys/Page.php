<?php

/**
 * Represents Sainsbury's page
 */
abstract class Application_Model_Sainsburys_Page
{
	/**
	 * Url for this page
	 * @var string Url
	 */
	protected $url = null;

	/**
	 * Processed html
	 * @var string Html to be parsed
	 */
	protected $html = null;
	
	/**
	 * Dom object of this page
	 * @var DOMDocument DOM document
	 */
	protected $domDocument = null;

	/**
	 * 
	 * @param string $url of the page
	 */
	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	 * Request the page
	 * @throws Zend_Exception
	 */
	public function request()
	{
		$html = Application_Model_Http_Client::httpRequest($this->url);
		$this->domDocument = new DOMDocument();
		$status = $this->domDocument->loadHTML($html);
		if($status)
		{
			$this->html = $html;
			return $html;
		}
		else
		{
			throw new Zend_Exception('failed to create dom');
		}
	}
	
	/**
	 * Get size of the page in bytes;
	 * @return int Size in bytes
	 */
	public function getSize()
	{
		return strlen($this->html);
	}

	/**
	 * Make sure inheriting classes implement this method
	 */
	abstract public function getAllDetails();
}
