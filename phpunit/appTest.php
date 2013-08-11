<?php
    function autoload($class) {
        require_once 'class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        protected static $app;

        public static function setUpBeforeClass() {
            set_include_path(get_include_path() . PATH_SEPARATOR . '/home/ubuntu/hackthis.co.uk/files/');

            spl_autoload_register('autoload');

            // Setup app
            try {
                self::$app = new app();
            } catch (Exception $e) {
                die($e->getMessage());
            }

            spl_autoload_unregister('autoload');
        }

        public function testAppInit() {
            $this->assertTrue(isset(self::$app));
        }

        /**
         * @depends testAppInit
         */
        public function testAppConnection() {
            $this->assertTrue(isset(self::$app->db));
        }
    }
?>