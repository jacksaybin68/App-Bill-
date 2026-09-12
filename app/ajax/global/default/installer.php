<?php
header('Content-Type: application/json');

class ThanhDieuInstaller
{
    private $dbServer;
    private $dbName;
    private $dbUser;
    private $dbPwd;
    private $access_key;
    private $username;
    private $password;
    private $rank;
    private $response;
    private $secret_key;
    private $ip;
    private $install_lock;


    public function __construct($data)
    {
        $this->dbServer = $data['__ThanhDieuDbServer'];
        $this->dbName = $data['__ThanhDieuDbName'];
        $this->dbUser = $data['__ThanhDieuDbUser'];
        $this->dbPwd = $data['__ThanhDieuDbPwd'];
        $this->access_key = $data['access_key'];
        $this->username = $data['username'];
        $this->password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 7]);
        $this->rank = $data['rank'];
        $this->response = ['error' => -1, 'msg' => null];
        $this->secret_key = md5(openssl_random_pseudo_bytes(12));
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->install_lock = $_SERVER['DOCUMENT_ROOT'].'/install.lock';
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    /**
     * Method install
     *
     * @return mixed
     */
    public function install()
    {
        try {
            $this->install_lock();

            $thanhdieudb = new mysqli($this->dbServer, $this->dbUser, $this->dbPwd);
            if ($thanhdieudb->connect_error) 
            {
                throw new Exception('Kết nối thất bại: '.$thanhdieudb->connect_error);
            }

            if ($thanhdieudb->select_db($this->dbName) === false) 
            {
                throw new Exception('Không thể chọn cơ sở dữ liệu: '.$thanhdieudb->error);
            }

            $sql_file = $_SERVER['DOCUMENT_ROOT'].'/layout/pages/install/fakebill.sql';
            if (!file_exists($sql_file)) {
                throw new Exception('Không tìm thấy file fakebill.sql ở mục /install/.');
            }

            $sql = file_get_contents($sql_file);
            if (!$thanhdieudb->multi_query($sql)) 
            {
                throw new Exception('Lỗi import sql: '.$thanhdieudb->error);
            }

            $this->kq($thanhdieudb);
            $this->create_config_file();
            $this->create_auth($thanhdieudb);
            $this->secret_key($thanhdieudb);

            if (file_put_contents($_SERVER['DOCUMENT_ROOT'].'/install.lock', $this->domain()) === false) 
            {
                throw new Exception('Không thể tạo file cấu hình install.lock.');
            }

            $this->response['error'] = 1;
            $this->response['msg'] = $this->msg();

        } catch (Exception $e) {
            $this->response['msg'] = $e->getMessage();
        }

        exit(json_encode($this->response));
    }

    /**
     * Check install.lock
     *
     * @throws Exception
     */
    private function install_lock()
    {
        if (file_exists($this->install_lock)) 
        {
            $content = file_get_contents($this->install_lock);
            if ($content === $this->domain()) 
            {
                throw new Exception('Tên miền này đã được cài đặt trước đó, để cài đặt lại bạn có thể xoá tệp install.lock & config.ini!');
            }
        }
    }

    /**
     * Method kq
     *
     * @param $thanhdieudb
     *
     * @return void
     */
    private function kq($thanhdieudb)
    {
        do {
            if ($wt = $thanhdieudb->store_result()) 
            {
                $wt->free();
            }
        } 
        while ($thanhdieudb->next_result());
    }

    /**
     * Get current domain (without protocol and path)
     *
     * @return string
     */
    private function domain()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * Method create_config_file
     *
     * @return mixed
     */
    private function create_config_file()
    {
        $db_config = '<?php'.PHP_EOL . 
        '$config = ['.PHP_EOL . 
        '    \'server\' => \''.$this->dbServer.'\','.PHP_EOL . 
        '    \'username\' => \''.$this->dbUser.'\','.PHP_EOL . 
        '    \'password\' => \''.$this->dbPwd.'\','.PHP_EOL . 
        '    \'database\' => \''.$this->dbName.'\','.PHP_EOL . 
        '];'.PHP_EOL;

        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/function/connect/config.ini.php', $db_config);
    }

    /**
     * Method create_auth
     *
     * @param $thanhdieudb
     *
     * @return mixed
     */
    private function create_auth($thanhdieudb)
    {
        $thanhdieudb->set_charset("utf8mb4");
        $wt = $thanhdieudb->prepare("INSERT INTO users (`username`, `password`, `rank`, `access_key`, `ip`) VALUES (?, ?, ?, ?, ?)");
        $wt->bind_param("sssss", $this->username, $this->password, $this->rank, $this->access_key, $this->ip);
        if (!$wt->execute()) {
            throw new Exception('Lỗi khi tạo tài khoản: '.$wt->error);
        }
        $wt->close();
    }

    /**
     * Method secret_key
     *
     * @param $thanhdieudb
     *
     * @return mixed
     */
    private function secret_key($thanhdieudb)
    {
        $aes = $thanhdieudb->prepare("UPDATE ws_settings SET `key-aes`=?");
        $aes->bind_param("s", $this->secret_key);
        if (!$aes->execute()) 
        {
            throw new Exception('Lỗi khi cập nhật: '.$aes->error);
        }
        $aes->close();
        setcookie('ssk', $this->encrypt($this->username, $this->secret_key), time() + (360 * 24 * 60 * 60), "/", "", true, true);
    }

    /**
     * Method encrypt
     *
     * @param $data
     * @param $key
     *
     * @return
     */
    public function encrypt($data, $key)
    {
        $method = 'aes-256-cbc';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
        $key = substr(hash('sha256', $key, true), 0, 32);
        $enc = openssl_encrypt($data, $method, $key, 0, $iv);
        $enc = bin2hex($iv.$enc);
        return $enc; // enc data
    }

    private function msg()
    {
        return '<b>Cài đặt CSDL Hoàn Tất!</b><br>Tài Khoản: '.$this->username.'<br>Mật Khẩu: '.$_POST['password'].'';
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'thanhdieu-installer-v2') 
{
    $fakebill = new ThanhDieuInstaller($_POST);
    $fakebill->install();
}
