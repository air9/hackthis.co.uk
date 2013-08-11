<?php
    function autoload($class) {
        require_once 'class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        public function __construct() {
            //
            set_include_path(get_include_path() . PATH_SEPARATOR . '/home/ubuntu/hackthis.co.uk/files/');
            session_start();
        }

        public function testAppInit() {
            spl_autoload_register('autoload');

            // Setup app
            try {
                $this->app = new app();
            } catch (Exception $e) {
                die($e->getMessage());
            }

            print_r($this->app);
            $this->assertTrue($this->app);

            spl_autoload_unregister('autoload');
        }

        /**
         * @depends testAppInit
         */
        public function testAppConnection() {
            spl_autoload_register('autoload');

            $this->assertTrue($this->app->db);

            spl_autoload_unregister('autoload');
        }
    }
?>