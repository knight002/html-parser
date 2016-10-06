<?php

/**
 * Sainsbury's parser
 */
class Application_Model_Sainsburys_Parser
{
	/**
	 * Get results and total
	 * @return string Json object with products and total
	 */
	public static function parse()
	{
		//get the html of target url
		//parse the content of the website for details
		$url = Zend_Registry::get('config')->sainsburys->entryurl;
		$productList = new Application_Model_Sainsburys_ProductList($url);
		$links = $productList->getProductLinks();
		$products = array();
		$total = 0;
		foreach($links as $link)
		{
			$product = new Application_Model_Sainsburys_Product($link);
			$details = $product->getAllDetails();
			$total += $details['unit_price'];
			$products[] = (object)$details;
		}
		$ret = (object)array(
			'results'	=> $products,
			'total'		=> $total,
		);
		return Zend_Json::encode($ret);
	}
}
