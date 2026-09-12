<?php
/**
* Kết Nối CSDL
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
/**
* @author Vương Thanh Diệu
*/
if ($taikhoan !== null) {
    setcookie('ssk', '', time() - 3600, "/", "", true, true);
    header('location: /oauth/dang-nhap');
} else {
    header('location: /oauth/dang-nhap');
}