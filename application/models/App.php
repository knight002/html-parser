<?php

/**
 * An application
 */
class Application_Model_App
{

    /**
     * Run the app
     */
    public static function run()
    {
        $json = Application_Model_Sainsburys_Parser::parse();
        print_r($json);
        Zend_Debug::dump('APP');
    }
}
