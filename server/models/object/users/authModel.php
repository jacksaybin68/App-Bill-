<?php
require $_SERVER['DOCUMENT_ROOT'].'/server/captcha/geetest.php';

if (!class_exists('DatabaseConnection')) 
{
    header('location: /');
    exit;
}

header('Content-Type: application/json');

use CaptchaValidator\Geetest;

class UserAuth extends DatabaseConnection
{   
    private $TD;
    public function __construct($TD)
    {
        $this->TD = $TD;
    }    
    /**
     * Method execute
     *
     * @param $action $action
     * @param $data $data
     *
     */
    public function execute($action, $data)
    {    
        $oauth = json_decode($action['_auth'], true);
        switch ($oauth['auth']) {
            case 'user-auth-login':
                return JSON_FORMATTER($this->login(
                    strtolower($oauth['username']) ?? '',
                    $oauth['password'] ?? '',
                    $oauth['remember-me'] ?? false
                    )
                );
                case 'user-auth-register':
                    $initCaptcha = new Geetest(
                        $this->TD->Setting('id-geetest'), 
                        $this->TD->Setting('key-geetest'), 
                        'http://gcaptcha4.geetest.com'
                    );
                    $postCaptcha = json_decode($initCaptcha->verify(
                        $data['lot_number'] ?? '', 
                        $data['captcha_output'] ?? '', 
                        $data['pass_token'] ?? '', 
                        $data['gen_time'] ?? ''
                    ), true);
                    return JSON_FORMATTER($this->register(
                        strtolower($oauth['email']) ?? '',
                        strtolower($oauth['username']) ?? '',
                        $oauth['password'] ?? '',
                        $oauth['repeat-password'] ?? '',
                        $postCaptcha,
                        $oauth['terms'] ?? false
                    ));
            case 'user-change-password':
                return JSON_FORMATTER($this->changePw(
                    $oauth['password-old'] ?? '',
                    $oauth['password-new'] ?? '',
                    $oauth['password-new-again'] ?? ''
                ));
            case 'logout':
                return JSON_FORMATTER($this->logout());
            // default:
            //     return $this->Res(-1, 'Action is not authorized..');
        }
    }    
    /**
     * Method register
     *
     * @param $email $email
     * @param $username $username
     * @param $password $password
     * @param $repeat_password $repeat_password
     * @param $postCaptcha $postCaptcha
     * @param $terms $terms
     *
     * @return void
     */
    public function register($email, $username, $password, $repeat_password, $postCaptcha, $terms)
    {
        extract($GLOBALS);

        if (!$this->anti_spamer() && $TD->Setting('anti-spam'))
        {
            return $this->Res(-1, 'Bạn thao tác quá nhanh, vui lòng thử lại sau!');
        }
        if (!$terms) 
        {
            return $this->Res(-1, 'Bạn phải đồng ý với chính sách & điều khoản trước!');
        }
        if ($TD->Setting('is-captcha') && $postCaptcha['status'] !== 'success') {
            return $this->Res(-1, Geetest::Error($postCaptcha['reason'] ?? null) ?? 'Xác thực captcha không thành công, vui lòng xác minh lại!');
        }
        if (array_filter([$email, $username, $password, $repeat_password]) !== [$email, $username, $password, $repeat_password]) 
        {
            return $this->Res(-1, 'Vui lòng không bỏ trống mục nào!');
        }
        if (!valid_email($email)) 
        {
            return $this->Res(-1, 'Vui lòng nhập một địa chỉ email hợp lệ!');
        }
        if (!$this->valid_username($username)) 
        {
            return $this->Res(-1, 'Tên tài khoản không được chứa kí tự đặc biệt!');
        }
        if (!$this->valid_length($username, 6, 22) || !$this->valid_length($password, 6, 27)) 
        {
            return $this->Res(-1, 'Tên tài khoản hoặc mật khẩu quá ngắn, tối thiểu 6 ký tự!');
        }
        if ($this->white_list($username)) 
        {
            return $this->Res(-1, 'Tên tài khoản này không hợp lệ!');
        }
        if ($username === $password) 
        {
            return $this->Res(-1, 'Không được lấy tên tài khoản làm mật khẩu!');
        }
        if ($password !== $repeat_password) 
        {
            return $this->Res(-1, 'Mật khẩu mới nhập lại không khớp!');
        }
        if (!CheckPassword($password)) 
        {
            return $this->Res(-1, 'Mật khẩu không đúng định dạng!');
        }
        if (!CheckStrongPassword($password)) 
        {
            return $this->Res(-1, 'Mật khẩu của bạn quá dễ đoán, hãy chọn mật khẩu khác!');
        }
        if ($this->check_username($username)) 
        {
            return $this->Res(-1, 'Tên tài khoản đã tồn tại, hãy chọn tên tài khoản khác!');
        }
        if ($this->check_ip($ip,$TD)) 
        {
            return $this->Res(-1, 'Bạn đã đạt giới hạn tạo tài khoản mới, việc tạo nhiều tài khoản có thể bị cấm địa chỉ ip!');
        }
        if ($this->check_email($email)) 
        {
            return $this->Res(-1, 'Địa chỉ email đã tồn tại trên hệ thống!');
        }
        if ($this->CreateAccount($email, $username, $password, $ip, $wtSecurity))
        {
            return $this->Res(200, 'Tạo tài khoản mới thành công, tự động vào trang chủ sau 3s...');
        } else {
            return $this->Res(-1, 'Đã xảy ra lỗi khi tạo tài khoản mới!');
        }
    }    
    /**
     * Method login
     *
     * @param $username_or_email
     * @param $password 
     * @param $remember
     *
     */
    public function login($username_or_email, $password, $remember)
    {
        extract($GLOBALS);

        if (empty($username_or_email) || empty($password)) 
        {
            return ['status' => -1, 'msg' => 'Vui lòng không bỏ trống mục nào!'];
        }
        if (!TDSpamChecker::TD($ip, $TD)) {
            return ['status' => 400, 'msg' => 'Bạn thao tác quá nhanh, vui lòng thử lại sau!'];
        }
        $vtd = valid_email($username_or_email)
            ? self::ThanhDieuDB()->prepare("SELECT * FROM `users` WHERE `email`=?")
            : self::ThanhDieuDB()->prepare("SELECT * FROM `users` WHERE `username`=?");

        if (SecurityUtils::DetectSQLInjection($username_or_email) || SecurityUtils::DetectSQLInjection($password)) 
        {
            return ['status' => -1, 'msg' => 'Phát hiện tấn công SQL Injection!', 'xss' => true];
        }
        $vtd->bind_param("s", $username_or_email);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $OoO->num_rows > 0) 
        {
            $user = $OoO->fetch_assoc();
            if (password_verify($password, $user['password'])) 
            {
                if ($user['banned'] == 1) 
                {
                    return ['status' => -1, 'msg' => 'Tài khoản của bạn đã bị đình chỉ, do không tuân thủ điều khoản của nền tảng!'];
                } else {
                    self::ThanhDieuDB()->query("UPDATE users SET ip='$ip' WHERE username='{$user['username']}'");
                    setcookie(
                        'ssk', 
                        $wtSecurity->encrypt($user['username']), 
                        time() + ($remember==='on' ? 365 * 24 * 60 * 60 : 1 * 24 * 60 * 60),
                        "/", 
                        "", 
                        false, // secure = false for local HTTP dev
                        true
                    );
                    // self::ThanhDieuDB()->query("INSERT INTO ws_logs (username, content, action) VALUES ('{$user['username']}', 
                    // 'vừa thực hiện đăng nhập trên thiết bị: ".
                    // (isset($_COOKIE['_window']) && $_COOKIE['_window'] == 11 ? 'Window 11' : $device_info->name.' trên trình duyệt '.$browser_info->name)."', 'Đăng Nhập Hệ Thống')");
                  return ['status' => 200, 'msg' => 'Đăng nhập thành công, tự động vào trang chủ sau 3s...','timeout' => 2300];
                }
            } else {
                return ['status' => -1, 'msg' => 'Tài khoản hoặc mật khẩu không chính xác!']; 
            }
        } else {
            return ['status' => -1, 'msg' => 'Tài khoản hoặc mật khẩu không chính xác!'];
        }
    }    
    /**
     * Method changePw
     *
     * @param $password_old
     * @param $password_new
     * @param $password_new_again
     *
     */
    public function changePw($password_old, $password_new, $password_new_again)
    {
        extract($GLOBALS);

        if (empty($password_old) || empty($password_new) || empty($password_new_again)) 
        {
            return ['status' => -1, 'msg' => 'Vui lòng không bỏ trống mục nào.'];
        }
        if ($password_new !== $password_new_again) 
        {
            return ['status' => -1, 'msg' => 'Mật khẩu mới nhập lại không khớp.'];
        }
        if (!CheckPassword($password_new)) 
        {
            return ['status' => -1, 'msg' => 'Mật khẩu không đúng định dạng!'];
        }
        if (!CheckStrongPassword($password_new)) 
        {
            return ['status' => -1, 'msg' => 'Mật khẩu của bạn quá dễ đoán, hãy chọn mật khẩu khác!'];
        }
        $vtd = self::ThanhDieuDB()->prepare("SELECT password FROM users WHERE username = ?");
        $vtd->bind_param('s', $taikhoan);
        $vtd->execute();
        $vtd->bind_result($password2);
        $vtd->fetch();
        $vtd->close();
        if (!password_verify($password_old, $password2)) 
        {
            return ['status' => -1, 'msg' => 'Mật khẩu cũ không chính xác.'];
        }
        if (password_verify($password_new, $password2)) 
        {
            return ['status' => -1, 'msg' => 'Mật khẩu mới không được giống mật khẩu cũ.'];
        }
        $new_hashed_pw = password_hash($password_new, PASSWORD_BCRYPT, ['cost' => 7]);
        $WsMailler->NotifyChangePw(
            $user['email'],
            $formatter_time,
            $ip,
            isset($_COOKIE['_window']) && $_COOKIE['_window'] == 11
        ? 'Window 11' . ', ' . $browser_name
        : ($device_name . ', ' . $browser_name)
        );
        $vtd = self::ThanhDieuDB()->prepare("UPDATE users SET password = ? WHERE username = ?");
        $vtd->bind_param('ss', $new_hashed_pw, $taikhoan);
        if ($vtd->execute()) {
        $into->wusteam("insert", "ws_logs", ["username" => $taikhoan,"content" => 'đã thay đổi mật khẩu',"action" => 'Đổi Mật Khẩu',]);
            return ['status' => 200, 'msg' => 'Mật khẩu đã được thay đổi thành công.'];
        } else {
            return ['status' => -1, 'msg' => 'Lỗi khi thay đổi mật khẩu.'];
        }
    }    
    /**
     * Method logout
     */
    public function logout()
    {
        usleep(random_int(700000, 1000000));
        setcookie('ssk', '', time() - WsRandomString::Number(10), "/", "", true, true); // destroy ssk (session key)
        return ['status' => 200, 'msg' => 'Đăng xuất thành công!'];
    }    
    /**
     * Method anti_spamer
     *
     */
    private function anti_spamer()
    {
        global $TD, $ip;
        return TDSpamChecker::TD($ip, $TD);
    }
    
    /**
     * Method valid_username
     *
     * @param $username
     *
     */
    private function valid_username($username)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $username);
    }
    
    /**
     * Method valid_length
     *
     * @param $input
     * @param $min
     * @param $max
     *
     */
    private function valid_length($input, $min, $max)
    {
        $length = mb_strlen($input, 'UTF-8');
        return $length >= $min && $length <= $max;
    }    
    /**
     * Method white_list
     *
     * @param $username
     *
     */
    private function white_list($username)
    {
        return array_filter(['admin', 'dieu'], fn($keyword) => stripos($username, $keyword) !== false);
    }
    
    /**
     * Method check_username
     *
     * @param $username
     *
     */
    private function check_username($username)
    {
        $check_user = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE username=?");
        $check_user->bind_param("s", $username);
        $check_user->execute();
        return $check_user->get_result()->num_rows > 0;
    }    
    
    /**
     * Method check_ip
     *
     * @param $ip
     * @param $TD 
     *
     */
    private function check_ip($ip, $TD)
    {
        $check_ip = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE ip=?");
        $check_ip->bind_param("s", $ip);
        $check_ip->execute();
        $limit_account = $TD->Setting('limit-account') == 0 ? 999 : max(0, $TD->Setting('limit-account') - 1);
        return $check_ip->get_result()->num_rows > $limit_account;
    }
    
    /**
     * Method check_email
     *
     * @param $email
     *
     */
    private function check_email($email)
    {
        $check = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        return $check->get_result()->num_rows > 0;
    }
    
    /**
     * Method CreateUser
     *
     * @param $email
     * @param $username
     * @param $password 
     * @param $ip
     *
     * @return void
     */
    private function CreateAccount($email, $username, $password, $ip, $wtSecurity)
    {
        $access_key = WsRandomString::Key();
        $avatar = RandomHexColor();
        $hashed_pw = password_hash($password, PASSWORD_BCRYPT, ['cost' => 7]);
        $vtd = self::ThanhDieuDB()->prepare("INSERT INTO users (email, username, password, ip, access_key, avatar) VALUES (?, ?, ?, ?, ?, ?)");
        $vtd->bind_param('ssssss', $email, $username, $hashed_pw, $ip, $access_key, $avatar);
        $logs =  $vtd->execute();
        if ($logs) {
            setcookie('ssk', $wtSecurity->encrypt($username), time() + (360 * 24 * 60 * 60), "/", "", false, true); // secure=false for local HTTP dev
            $vtd_log = self::ThanhDieuDB()->prepare("INSERT INTO ws_logs (username, content, action) VALUES (?, ?, ?)");
            $content = "\xc4\x91\xc4\x83\x6e\x67\x20\x6b\xc3\xbd\x20\x74\xc3\xa0\x69\x20\x6b\x68\x6f\xe1\xba\xa3\x6e\x20\x6d\xe1\xbb\x9b\x69";
            $action = "\xc4\x90\xc4\x83\x6e\x67\x20\x4b\xc3\xbd\x20\x54\xc3\xa0\x69\x20\x4b\x68\x6f\xe1\xba\xa3\x6e";
            $vtd_log->bind_param("sss", $username, $content, $action);
            return $vtd_log->execute();
        }
    }
    
    /**
     * Method Res
     *
     * @param $http $http [http code]
     * @param $msg $msg [message]
     *
     * @return void
     */
    private function Res($http, $msg)
    {
        exit(JSON_FORMATTER(['status' => $http, 'msg' => $msg]));
    }
}

if (isset($_POST['_auth'])) 
{
    $action = new UserAuth($TD);
    $_post = decryptPostData($_POST, $wtSecurity, ['lot_number', 'captcha_output', 'pass_token', 'gen_time']);
    $data = array_diff_key($_POST, ['_auth' => '']);
    echo $action->execute($_post, $data);
}