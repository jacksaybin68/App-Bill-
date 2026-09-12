<?php $options_header = ['title' => 'Đăng Nhập Hệ Thống','description' => 'Chào mừng bạn đến với trang đăng nhập, bắt đầu đăng nhập để sử dụng dịch vụ của chúng tôi!',];
require($_SERVER['DOCUMENT_ROOT'].'/include/head.php');
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/isLoginModel.php');
// require($_SERVER['DOCUMENT_ROOT'].'/function/insert/auth/header.php');
require($_SERVER['DOCUMENT_ROOT'].'/function/insert/auth/modern/login/v2.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>