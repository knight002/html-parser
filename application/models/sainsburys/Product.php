<?php

/**
 * Represents product details page
 */
class Application_Model_Sainsburys_Product extends Application_Model_Sainsburys_Page
{
	/**
	 * @var array An array with product details
	 */
	private $details = null;

	private function requestAndParse()
	{
		$this->request();
		$content = $this->domDocument->getElementById('content');
		$productTitleDescriptionContainer = Application_Model_Dom_NodeList::getElementByTagNameClass($content, 'div', 'productTitleDescriptionContainer');

		//get the title
		$title = $productTitleDescriptionContainer->getElementsByTagName('h1')->item(0)->nodeValue;

		//get price
		$price = Application_Model_Dom_NodeList::getElementByTagNameClass($content, 'p', 'pricePerUnit')->nodeValue;
		$price = preg_replace("/[^0-9\.]*/", '', $price);
		
		//get description
		$description = $this->domDocument->getElementById('information')->getElementsByTagName('div')->item(0)->getElementsByTagName('p')->item(0)->nodeValue;
		
		//get page size as string
		$pageSize = round($this->getSize() / 1024, 0).'kb';
		
		$this->details = array(
			'title'			=> $title,
			'size'			=> $pageSize,
			'unit_price'	=> $price,
			'description'	=> $description,
		);

		return $this->details;
	}

	/**
	 * Returns all details
	 * @return array All details
	 */
	public function getAllDetails()
	{
		$this->requestAndParse();
		$this->details['url'] = $this->url;
		return $this->details;
	}
}
