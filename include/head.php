<?php 
function ExcludedDatabase() 
{
    extract($GLOBALS);
    $a = ['details/','view-code/'];
    foreach ($a as $b) {
        if (!preg_match("~^/{$b}(/|$)~", $_SERVER["REQUEST_URI"])) {
            return !0;
        }
    }
    return !1;
}
if (ExcludedDatabase())
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
}
?>
<!DOCTYPE html>
<html lang="vi-VN"<?=isset($user['is-cookie']) && $user['is-cookie']==1 ? ' data-cookie="true"' : null?> data-log="<?=($TD->Setting('is-log')?'on':'off')?>" class="<?=!isset($_COOKIE['theme'])||$_COOKIE['theme']==='dark'?'dark':'light'?>" data-type="<?=($TD->Setting('fuck-devtools')==1 ? 'cdp' : 'hk')?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?=$options_header['title'] ?? $TD->Setting('title')?> | <?=$TD->Setting('name-site')?></title>
    <meta property="og:description" content="<?=$options_header['description'] ?? $TD->Setting('description')?>" />
    <meta name="description" content="<?=$options_header['description'] ?? $TD->Setting('description')?>" />
    <meta property="og:title" content="<?=$options_header['title'] ?? $TD->Setting('title')?>" />
    <meta name="keywords" content="<?=$options_header['keywords'] ?? $TD->Setting('keywords')?>">
    <link rel="canonical" href="<?=$databaseWs->getFullURL()?>">
    <link rel='icon' type="image/x-icon" href='<?=$TD->Setting('favicon')?>?v=7'>
    <meta property="og:image" content="<?=$options_header['og:image'] ?? ($TD->Setting('og:image') === '' ? '/' . __IMG__ . '/banner.png' : $TD->Setting('og:image'))?>">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?=__CSS__?>/theme/tailwind.css" />
    <link rel="stylesheet" href="/<?=__CSS__?>/custom.css?v=<?=$TD->Setting('cache')?>.223" />
    <link rel="stylesheet" type="text/css" href="/<?=__LIBRARY__?>/toast@1.0.1/fuiToast.min.css?v=<?=$TD->Setting('cache')?>.22">
</head>
<body class="<?=$TD->Setting('name-site')?>">
<div class="lavender-loading-indicator"></div>
<div class="marquee">
  <span>
    <i>
    <?php if(!isMobile()):?>
  Quý khách vui lòng đăng ký kênh Telegram <a href="javascript:void(0)" class="cursor-pointer text-primary-500" data-target-href-open="https://t.me/billvietreal">@billvietreal</a> để nhận thông báo, tên miền mới khi bị chặn. Xin cảm ơn !
  <?php else:?>
    <!-- Hãy xác minh địa chỉ email thật để nhận <a href="javascript:void(0)" class="cursor-pointer text-warning-500">thông báo & bảo mật tài khoản</a> từ chúng tôi 🕵️ -->
     Quý khách vui lòng đăng ký kênh Telegram <a href="javascript:void(0)" class="cursor-pointer text-danger-500" data-target-href-open="https://t.me/billvietreal">@billvietreal</a> để nhận thông báo, tên miền mới khi bị chặn. Xin cảm ơn !
    <!-- Hòa cùng không khí hào hùng kỷ niệm 50 năm ngày Giải phóng miền Nam, thống nhất đất nước <a href="javascript:void(0)" class="cursor-pointer text-danger-500">(30/4/1975 – 30/4/2025)</a> - Khuyến mãi thêm <a class="text-warning-500">20%</a> khi <a class="text-primary-500">nạp tiền</a> tối thiểu <a class="text-success-500">50K</a> trở lên 🔥🔥🔥 -->
<?php endif?>
</i></span>
</div>
<?php require $_SERVER['DOCUMENT_ROOT'].'/function/handle/browser-check.php';?>
<?php if($TD->Setting('loader')):?>
<div class="lavender-preloader">
<div class="loading-container">
    <img src="<?=$TD->Setting('navbar-logo')?>" alt="<?=$TD->Setting('name-site')?>">
    <svg class="loader" viewBox="0 0 50 50" height="32" width="32"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="2"></circle></svg>
</div>
</div>
<?php endif?>
<?php if($TD->Setting('bao-tri')){?>
<?php die(require_once($_SERVER['DOCUMENT_ROOT'].'/client/layout/pages/global/error/maintenance.php'));?>
<?php }?>
