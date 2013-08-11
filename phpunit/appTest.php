<?php
    function autoload($class) {
        echo "Loading class: {$class}\n";
        require_once 'class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        public function __construct() {
            set_include_path(get_include_path() . PATH_SEPARATOR . '/home/ubuntu/hackthis.co.uk/files/');
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

            echo "DB settings:\n";
            print_r($this->app->config);

            if (!defined('PDO::ATTR_DRIVER_NAME')) {
            echo 'PDO unavailable';
            }
            elseif (defined('PDO::ATTR_DRIVER_NAME')) {
            echo 'PDO available';
            }
            
            $this->assertTrue(isset($this->app));
        }

        /**
         * @depends testAppInit
         */
        public function testAppConnection() {
            $this->assertTrue(isset($this->app->db));
        }
    }
?>