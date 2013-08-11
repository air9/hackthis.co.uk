<?php
    function __autoload($class) {
        require_once realpath($_SERVER["DOCUMENT_ROOT"] . '/../') . '/class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        public function __construct() {
            session_start();
            spl_autoload_register('__autoload');
        }

        public function testAppInit() {
            // Setup app
            try {
                $app = new app();
            } catch (Exception $e) {
                die($e->getMessage());
            }

            print_r($app);
        }
    }
?>