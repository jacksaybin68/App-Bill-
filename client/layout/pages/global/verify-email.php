<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');?>
<?php
class EmailVerify extends DatabaseConnection
{
    private $TD;

    public function __construct($TD) 
    {
        $this->TD = $TD;
    }    
    /**
     * Method execute
     *
     * @return void
     */
    public function execute() 
    {
        global $user;
        $c = isset($_GET['c']) ? $_GET['c'] : null;
        $e = isset($_GET['e']) ? $_GET['e'] : null;
        $t = isset($_GET['t']) ? $_GET['t'] : null;
        $u = isset($_GET['u']) ? $_GET['u'] : null;
        // if (isset($user) && (valid_email($user['email']))) {
        //     header('location: /');
        // }
        if ($c && $e && $t && $u) 
        {
            $otp_code = decrypt($c, $this->TD->Setting('key-aes'));
            $email = decrypt($e, $this->TD->Setting('key-aes'));
            $token = decrypt($t, $this->TD->Setting('key-aes'));
            $username = decrypt($u, $this->TD->Setting('key-aes'));
            if (!$this->checkUser($username)) {
                exit("<pre>400 / Access username invalid.</pre>");
            } elseif ($this->checkToken($token)) 
            {
                if ($this->checkOtp($otp_code)) 
                {
                    if ($this->updateEmail($email, $username, $otp_code)) 
                    {
                        $_SESSION['confirm-email-success'] = 'Xác thực địa chỉ email hoàn tất, bây giờ bạn có thể sử dụng dịch vụ, email này sẽ giúp khôi phục tài khoản khi bạn quên mất mật khẩu của mình.';
                        header('location: /user/');
                        exit("<pre>200 / Email added successfully.</pre>");
                    } else {
                        exit("<pre>400 / The system cannot process this data.</pre>");
                    }                    
                } else {
                    exit("<pre>400 / Verification link is invalid.</pre>");
                }
            } else {
                exit("<pre>400 / Access token invalid.</pre>");
            }
        } else {
            // exit("<pre>400 / Cannot request parameter.</pre>");
        }
    }
    private function checkUser($username) 
    {
        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE username = ?");
        $vtd->bind_param("s", $username);
        $vtd->execute();
        $OoO = $vtd->get_result();
        return $OoO->num_rows > 0;
    }
    private function checkToken($token) 
    {
        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM ws_otpmailler WHERE token = ? AND is_used = 0 AND expires_at > NOW()");
        $vtd->bind_param("s", $token);
        $vtd->execute();
        $OoO = $vtd->get_result();
        return $OoO->num_rows > 0;
    }
    private function checkOtp($otp_code) 
    {
        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM ws_otpmailler WHERE otp_code = ? AND is_used = 0");
        $vtd->bind_param("s", $otp_code);
        $vtd->execute();
        $OoO = $vtd->get_result();
        return $OoO->num_rows > 0;
    }
    private function updateEmail($email, $username, $otp_code) 
    {
        self::ThanhDieuDB()->begin_transaction();
        try {
            $vtd = self::ThanhDieuDB()->prepare("UPDATE users SET email = ? WHERE username = ?");
            $vtd->bind_param("ss", $email, $username);
            if (!$vtd->execute()) {
                throw new Exception("Failed to update email.");
            }
            // $vtd = self::ThanhDieuDB()->prepare("DELETE FROM ws_otpmailler WHERE otp_code = ? AND username = ? AND is_used = 0");
            // $vtd->bind_param("ss", $otp_code, $username);
            // if (!$vtd->execute()) {
            //     throw new Exception("Failed to delete OTP.");
            // }
            $vtd = self::ThanhDieuDB()->prepare("UPDATE ws_otpmailler SET is_used = 1 WHERE otp_code = ? AND username = ?");
            $vtd->bind_param("ss", $otp_code,$username);
            if (!$vtd->execute()) {
                throw new Exception("Failed to update OTP.");
            }
            self::ThanhDieuDB()->commit();
            return true;
        } catch (Exception $e) {
            self::ThanhDieuDB()->rollback();
            return false;
        }
    }
    
}
$EmailVerify = new EmailVerify($TD);
$EmailVerify->execute();
if ((isset($user) && valid_email($user['email'])) || $taikhoan == null) 
{
    header('location: /oauth/dang-nhap');
    exit;
}
?>
<?php $options_header=['title' =>'Xác minh địa chỉ email.','description'=>'Xác minh địa chỉ email của bạn để tiếp tục sử dụng dịch vụ.'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<style>.text-red-600{color:#eb2f2f}.text-blue-600 {color:#826bdb}</style>
    <div class="authentication-wrapper authentication-basic px-4">
        <div class="authentication-inner py-4">
            <!-- Verify Email -->
            <div class="card thanhdieu-card-bg thanhdieu-border-card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="/" class="app-brand-link gap-2">
                            <img class="d-flex mx-auto nav-logo-mod" src="/<?=__IMG__?>/logo-bar-red.png"
                                alt="Logo <?=$TD->Setting('name-site')?>">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <form class="user-confirm-email">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <i class="ri-spam-line me-2"></i>Kể từ ngày 15/10/2024 những tài khoản không xác minh email sẽ bị xoá vĩnh viễn khỏi nền tảng và không thể khôi phục.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="email" class="form-label text-red-800">Thêm Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Nhập địa chỉ email của bạn"
                            autofocus="" required>
                    </div>
                    <div id="captcha"></div>
                    <input type="hidden" name="action" value="user-confirm-email">
                    <button type="submit" class="btn btn-primary w-100 my-3"><i class="ri-check-line me-2"></i>Xác Nhận </button>
                </div>
                </form>
            </div>
            <!-- /Verify Email -->
        </div>
    </div>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>