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

            $this->assertTrue(isset($this->app));
        }

        /**
         * @depends testAppInit
         */
        public function testAppConnection() {
            $config = $this->app->config['db'];

            echo "\nDB settings:\n";
            print_r($this->app->config);
            echo "\nConnecting...";
            // Connect to database
            try {
                $dsn = "{$config['driver']}:host={$config['host']}";
                $dsn .= (!empty($config['port'])) ? ';port=' . $config['port'] : '';
                $dsn .= ";dbname={$config['database']}";
                $this->db = new PDO($dsn, $config['username']);
           //     $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->db->setAttribute(PDO::MYSQL_ATTR_FOUND_ROWS, true);
                echo "\nConnected";
            } catch(PDOException $e) {
                die($e->getMessage());
            }

            $this->assertTrue(isset($this->app->db));
        }
    }
?>