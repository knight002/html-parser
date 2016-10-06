<?php

/**
 * Represents product list page
 */
class Application_Model_Sainsburys_ProductList extends Application_Model_Sainsburys_Page
{
	/**
	 * Links for product details
	 * @var array Links
	 */
	private $links = array();

	/**
	 * Find product links within product listing html
	 * @return array 
	 * @throws Zend_Exception
	 */
	public function getProductLinks()
	{
		$this->request();
		$productLister = $this->domDocument->getElementById('productLister');
		$li = Application_Model_Dom_NodeList::getElementByTagNameClass($productLister, 'ul', 'productLister');
		$li2 = $li->getElementsByTagName('li');
		foreach($li2 as $item)
		{
			$href = $item->getElementsByTagName('h3')->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href');
			$this->links[] = $href;
		}
		return $this->links;
	}

	/**
	 * Get links from scanned page
	 * @return array An array of links
	 */
	public function getAllDetails()
	{
		return $this->getProductLinks();
	}
}
