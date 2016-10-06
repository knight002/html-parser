<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initExceptionsHandling()
	{
		$plugin = new Zend_Controller_Plugin_ErrorHandler();
		$plugin->setErrorHandlerModule('default')
				->setErrorHandlerController('error')
				->setErrorHandlerAction('error');

		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin($plugin);
		$front->throwExceptions(false);
	}

	protected function _initAutoloader()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->setFallbackAutoloader(true);

		return $autoloader;
	}
	
	protected function _initConfig()
	{
		//$this->bootstrap('config');
		$appConfig = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $appConfig);
		return $appConfig;
	}

}
