<?php
/**
 * Router cho PHP built-in server (php -S ... router.php)
 * Mô phỏng các rewrite cơ bản của .htaccess vì php -S không đọc .htaccess.
 */
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$p   = rtrim($uri, '/');
if ($p === '') { $p = '/'; }

$map = [
    '/trang-chu'               => '/dash.php',
    '/oauth/dang-nhap'         => '/client/layout/pages/auth/dang-nhap.php',
    '/oauth/dang-ky'           => '/client/layout/pages/auth/dang-ky.php',
    '/oauth/dang-xuat'         => '/client/layout/pages/auth/dang-xuat.php',
    '/oauth/quen-mat-khau'     => '/client/layout/pages/auth/quen-mat-khau.php',
    '/ajax/global/users'       => '/app/ajax/global/users/ajax-user.php',
    '/ajax/global/admin'       => '/app/ajax/global/admin/ajax-admin.php',
    '/ajax/global/default'     => '/app/ajax/global/default/ws-demo.php',
    '/ajax/global/default/stats' => '/app/ajax/global/default/stats.php',
    '/ajax/global/installer'   => '/app/ajax/global/default/installer.php',
    '/ajax/global/download'    => '/app/ajax/global/default/download.php',
    '/admin/dashboard'         => '/admin/index.php',
    '/admin/users/list'        => '/admin/user-list.php',
    '/admin/users/banned'      => '/admin/user-banned.php',
    '/admin/product/list'      => '/admin/product-list.php',
    '/admin/newfeeds/list'     => '/admin/newfeeds-list.php',
    '/admin/history/bank'      => '/admin/bank.php',
    '/admin/history/card'      => '/admin/card.php',
    '/admin/history/bill'      => '/admin/bill.php',
    '/admin/history/plan'      => '/admin/history-plan.php',
    '/admin/manager/payment'   => '/admin/payment.php',
    '/admin/manager/plan'      => '/admin/plan.php',
    '/admin/activity/log'      => '/admin/activity.php',
    '/admin/cron-jobs'         => '/admin/cron-jobs.php',
    '/admin/settings'          => '/admin/settings.php',
    '/call-back/api/auto-bank' => '/function/call-back/api/auto-bank.php',
    '/call-back/api/n'         => '/function/call-back/api/notify.ini.php',
    '/call-back/api/card5s'    => '/function/call-back/api/card5s.php',
    '/call-back/api/thesieure' => '/function/call-back/api/thesieure.php',
    '/call-back/api/spam-sms'  => '/function/call-back/api/spam-sms.php',
    '/call-back/api/spam-ngl'  => '/function/call-back/api/spam-ngl.php',
    '/log'                     => '/function/call-back/controller/log.php',
    '/cron-jobs/global'        => '/function/cron/global.php',
    '/thong-tin-thanh-toan'    => '/client/layout/pages/global/menu/tttt.php',
    '/thong-tin-goi'           => '/client/layout/pages/global/menu/info-vip.php',
    '/thue-goi'                => '/client/layout/pages/global/menu/thue-goi.php',
    '/thue-app-bank-ao'        => '/client/layout/pages/global/menu/thue-app-bank-ao.php',
    '/fake-bill-chuyen-khoan'  => '/client/layout/pages/global/menu/fakebill.php',
    '/fake-bill-priority'      => '/client/layout/pages/global/menu/fake-bill-priority.php',
    '/fake-so-du'              => '/client/layout/pages/global/menu/fakesodu.php',
    '/fake-bdsd'               => '/client/layout/pages/global/menu/fakebiendong.php',
    '/lich-su/nap-tien'        => '/client/layout/pages/global/menu/lich-su-nap-tien.php',
    '/lich-su/mua-goi'         => '/client/layout/pages/global/menu/lich-su-mua-goi.php',
    '/lich-su/mua-hang'        => '/client/layout/pages/global/menu/lich-su-mua-hang.php',
    '/lich-su/tao-bill'        => '/client/layout/pages/global/menu/lich-su-tao-bill.php',
    '/danh-muc/ma-nguon'       => '/client/layout/pages/global/menu/ma-nguon.php',
    '/install'                 => '/client/layout/pages/install/',
];

$dynamic = [
    '#^/admin/users/edit/[0-9a-zA-Z]+$#'       => '/admin/edit-user.php',
    '#^/view-code/[^/]+$#'                     => '/client/layout/pages/global/menu/chi-tiet-ma-nguon.php',
    '#^/user/[^/]+/settings/?$#'               => '/client/layout/pages/user/profile.php',
    '#^/danh-muc/ma-nguon/trang/[0-9]+/?$#'    => '/client/layout/pages/global/menu/ma-nguon.php',
];

if (isset($map[$p])) {
    $target = __DIR__ . $map[$p];
    if (is_dir($target)) { $target = rtrim($target, '/') . '/index.php'; }
    if (is_file($target)) { require $target; }
    else { http_response_code(404); echo '404 Not Found'; }
    return true;
}

foreach ($dynamic as $pattern => $base) {
    if (preg_match($pattern, $p)) {
        $target = __DIR__ . $base;
        if (is_file($target)) { require $target; }
        else { http_response_code(404); echo '404 Not Found'; }
        return true;
    }
}

return false;
