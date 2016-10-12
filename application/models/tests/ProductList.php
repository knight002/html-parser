<?php

use PHPUnit\Framework\TestCase;

include_once 'test.php';

class Application_Model_Tests_ProductList extends PHPUnit_Framework_TestCase
{

    public function testGetProductLinks()
    {
        $productList = new Application_Model_Sainsburys_ProductList(Zend_Registry::get('config')->sainsburys->entryurl);
        $this->assertInstanceOf('Application_Model_Sainsburys_ProductList', $productList);
        $this->assertInternalType('array', $productList->getProductLinks());
        $this->assertNotEmpty($productList->getProductLinks());

        $productList = new Application_Model_Sainsburys_ProductList('http://google.com');
        $this->expectException(Exception::class);
        $this->assertInstanceOf('Application_Model_Sainsburys_ProductList', $productList);
        $this->assertInternalType('array', $productList->getProductLinks());
        $this->assertNotEmpty($productList->getProductLinks());

        $productList = new Application_Model_Sainsburys_ProductList(null);
        $this->expectException(Zend_Http_Client_Exception::class);
        $this->assertInstanceOf('Application_Model_Sainsburys_ProductList', $productList);
        $this->assertInternalType('array', $productList->getProductLinks());
        $this->assertNotEmpty($productList->getProductLinks());

        $productList = new Application_Model_Sainsburys_ProductList('');
        $this->assertInstanceOf('Application_Model_Sainsburys_ProductList', $productList);
        $this->assertInternalType('array', $productList->getProductLinks());
        $this->assertNotEmpty($productList->getProductLinks());
    }
}
