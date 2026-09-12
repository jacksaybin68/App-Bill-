<?php 
/**
 * @author Vương Thanh Diệu
 * Xử Lý Phiên Đăng Nhập - Đăng Ký
 */
class UserAuth extends DatabaseConnection
{
    private $taikhoan;

    public function __construct($taikhoan) {
        $this->taikhoan = $taikhoan;
    }

    public function check() {
        if ($this->taikhoan !== null) {
            // header('Location: /');
            die('<meta http-equiv="refresh" content="0; url=/">');
        }
    }
}
(new UserAuth($taikhoan))->check();