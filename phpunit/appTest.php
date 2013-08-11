<?php
    function __autoload($class) {
        require_once 'class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        public function __construct() {
            session_start();
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