<?php
// namespace Database;
use Database\Installer;

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once $_SERVER['DOCUMENT_ROOT'].'/function/connect/error.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/function/connect/install.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/function/connect/config.ini.php';

if (!class_exists('Database')) {
    class Database
    {
        private $connection;
        private $config;
        private $lock_file = '/install.lock';
        private $config_ini = '/config.ini';
        private $db_config = '/function/connect/config.ini.php';

        public function __construct(array $config)
        {
            $this->config = $config;

            $params = array_filter(['server', 'username', 'database'], function ($key) {
                return empty($this->config[$key]);
            });

            if (!empty($params)) {
                global $x;
                $x_msg = $x[0x000000];
                require $_SERVER['DOCUMENT_ROOT'].'/function/insert/error/server.php';
                die;
            }

            $this->unstall();
            $this->connect();
        }

        private function connect()
        {
            $this->connection = @mysqli_connect(
                $this->config['server'],
                $this->config['username'],
                $this->config['password'],
                $this->config['database']
            );

            if (!$this->connection) {
                global $x;
                $x_msg = $x[0x000001];
                require $_SERVER['DOCUMENT_ROOT'].'/function/insert/error/server.php';
                die;
            }
        }

        public function main()
        {
            return $this->connection;
        }

        private function unstall()
        {
            $config_file = $_SERVER['DOCUMENT_ROOT'].$this->db_config;
            $lock_file = $_SERVER['DOCUMENT_ROOT'].$this->lock_file;
            $config_ini = $_SERVER['DOCUMENT_ROOT'].$this->config_ini;
            if (!file_exists($config_file)) 
            {
                if (file_exists($lock_file)) 
                {
                    unlink($lock_file);
                }

                if (file_exists($config_ini)) 
                {
                    unlink($config_ini);
                }

                header('Location: /install/');
                die;
            }
        }
    }
}
$connect = new Database($config);
$thanhdieudb = $connect->main();
require __DIR__.'/common.php';
