<?php

/**
 * Handles http requests
 */
class Application_Model_Http_Client
{

    /**
     * Instance of this object - singleton
     */
    protected static $_instance = null;
    private $appConfig;

    /**
     * Creates a object as a singleton
     */
    public function __construct()
    {
        $this->appConfig = Zend_Registry::get('config');
    }

    /**
     * Forbidding cloning of this object
     */
    private function __clone()
    {
        
    }

    /**
     * Gets or creates singleton instance of this object
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        } else {
            
        }

        return self::$_instance;
    }

    /**
     * Creates new http client
     * @return Zend_Http_Client Http client
     */
    public static function getHttpClient()
    {
        $appConfig = Zend_Registry::get('config');
        $client = new Zend_Http_Client();
        $client->setConfig(array(
            'maxredirects' => 6,
            'timeout' => 60
        ));
        if ($appConfig->proxy) {
            $config = $appConfig->proxy->toArray();
            $config['adapter'] = 'Zend_Http_Client_Adapter_Proxy';
            $client->setConfig($config);
        }
        $client->setMethod(Zend_Http_Client::POST);
        $client->setAuth(false);
//        Zend_Debug::dump($client);
        return $client;
    }

    /**
     * General method for handling post requests
     * @param string $url Url to request
     * @param array $data Data as key/value pairs
     * @param string|resource $rawData Raw data
     * @param array $headers Headers
     * @param array $auth Auth data
     * @return boolean
     */
    public static function httpRequest($url, $data = array(), $rawData = null, $headers = array(), $auth = array())
    {
        $client = self::getHttpClient();
        $client->setUri($url);

        if ($data) {
            $client->setParameterPost($data);
        }

        if ($rawData) {
            $client->setRawData($rawData);
        }

        $client->setEncType(Zend_Http_Client::ENC_URLENCODED);

        foreach ($auth as $k => $v) {
            $client->setAuth($k, $v);
        }

        foreach ($headers as $k => $v) {
            $client->setHeaders($k, $v);
        }

        $encodedValue = null;
        $response = null;
        try {
            $response = $client->request(Zend_Http_Client::GET);
            $encodedValue = $response->getBody();
        } catch (Zend_Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response) {
            if ($response->getStatus() == 200 || $response->getStatus() == 201) {
                return $encodedValue;
            } else {
                throw new Exception('Response error. Not 200 nor 201. It\'s ' . $response->getStatus());
            }
        }

        return false;
    }
}
