<?php
    function __autoload($class) {
        require_once '/class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        public function __construct() {
            //
            set_include_path('.:/home/ubuntu/hackthis.co.uk/files/');
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