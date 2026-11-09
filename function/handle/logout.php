<?php
session_start();
// Xóa tất cả session
$_SESSION = array();
// Xóa cookie session nếu tồn tại
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["http_only"]
    );
}
// Hủy session
session_destroy();
// Chuyển hướng về trang chủ
header('Location: /');
exit();
?>
