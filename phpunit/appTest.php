<?php
    function autoload($class) {
        echo $class;
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

            spl_autoload_unregister('autoload');

            $this->assertTrue($this->app);
        }

        /**
         * @depends testAppInit
         */
        public function testAppConnection() {
            $this->assertTrue($this->app->db);
        }
    }
?>