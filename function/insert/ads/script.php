<?php
$a = [
    '/dang-ky', 
    '/dang-nhap', 
    '/user', 
    '/thue-goi', 
    '/nap-tien', 
    '/lich-su-nap-tien', 
    '/lich-su-mua-goi'
];

$n = false;
foreach ($a as $url) {
    if (strpos($current_url, $url) !== false) {
        $n = true;
        break;
    }
}
if (isset($user['rank']) && in_array($user['rank'], ['admin', 'leader', 'partner'])) {
    return;
}
if (!$n) {
    if (!$plans->TD('tengoi', $taikhoan)): ?>
    <?php if (isset($user) && $user['sodu'] < $TD->Setting('giataobill')) {?>
<!-- <script src="https://alwingulla.com/88/tag.min.js" data-zone="87398" async data-cfasync="false"></script>
<script src="//thanhdieu.com/files/ads-blocked.js?v=8.18.42" defer></script> -->
    <?php } endif; 
}
?>
