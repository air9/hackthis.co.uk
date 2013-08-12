<?php
    function autoload($class) {
        require_once 'class.'.$class.'.php';
    }

    class APPTest extends PHPUnit_Framework_TestCase {
        protected static $app;

        public static function setUpBeforeClass() {
            //Load data
            exec('mysql -u ubuntu < setup.sql');

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

            // Check connection
            $connected = false;
            try {
                self::$app->db->query('select 1;');
                $connected = true;
            } catch (PDOException $e) {
                $connected = false;
            }

            $this->assertTrue($connected);
        }

        /**
         * @depends testAppConnection
         */
        public function testAppLogin() {
            $user = 'flabbyrabbit';
            $pass = 'pass';
            $status = self::$app->user->login($user, $pass);
            $this->assertTrue($status);
        }
    }
?>