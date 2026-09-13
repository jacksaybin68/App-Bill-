<?php
/**
 * Router cho PHP built-in server (php -S ... router.php)
 * Mô phỏng toàn bộ rewrite rules của .htaccess để hỗ trợ đầy đủ các tính năng trong hệ thống.
 */
if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
}
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$p   = rtrim($uri, '/');
if ($p === '') { $p = '/'; }

// Nạp biến môi trường từ .env
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $envLines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Bảo vệ các file nhạy cảm
$blockedFiles = ['install.lock', 'fakebill.sql', 'billviet.sql', 'robots.txt'];
foreach ($blockedFiles as $blocked) {
    if (str_ends_with($p, $blocked)) {
        http_response_code(403);
        echo '403 Forbidden';
        return true;
    }
}

// Các callback route yêu cầu xác thực callback token
$callbackRoutes = [
    '/call-back/api/auto-bank',
    '/call-back/api/n',
    '/call-back/api/card5s',
    '/call-back/api/thesieure',
    '/call-back/api/spam-sms',
    '/call-back/api/spam-ngl',
    '/call-back/api/payment',
    '/cron-jobs/global',
];

if (in_array($p, $callbackRoutes)) {
    $token = $_SERVER['HTTP_X_CALLBACK_TOKEN'] ?? $_GET['callback_token'] ?? '';
    $expected = getenv('CALLBACK_TOKEN');
    if (empty($expected)) {
        $serverAddr = $_SERVER['SERVER_ADDR'] ?? '127.0.0.1';
        $salt = getenv('CALLBACK_TOKEN_SALT') ?: '';
        $expected = hash('sha256', $serverAddr . $salt);
    }
    if (empty($token) || !hash_equals($expected, $token)) {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['status' => -1, 'msg' => 'Forbidden: Invalid callback token']);
        return true;
    }
}

// Bảng map route cố định
$map = [
    // Trang chủ & Cài đặt
    '/'                                        => '/dash.php',
    '/trang-chu'                               => '/dash.php',
    '/install'                                 => '/client/layout/pages/install/',

    // OAuth / Auth
    '/oauth/dang-nhap'                         => '/client/layout/pages/auth/dang-nhap.php',
    '/oauth/login'                             => '/client/layout/pages/auth/dang-nhap.php',
    '/oauth/signIn'                            => '/client/layout/pages/auth/dang-nhap.php',
    '/oauth/dang-ky'                           => '/client/layout/pages/auth/dang-ky.php',
    '/oauth/register'                          => '/client/layout/pages/auth/dang-ky.php',
    '/oauth/signUp'                            => '/client/layout/pages/auth/dang-ky.php',
    '/oauth/dang-xuat'                         => '/client/layout/pages/auth/dang-xuat.php',
    '/oauth/logout'                            => '/client/layout/pages/auth/dang-xuat.php',
    '/oauth/kill-log'                          => '/client/layout/pages/auth/dang-xuat.php',
    '/oauth/quen-mat-khau'                     => '/client/layout/pages/auth/quen-mat-khau.php',
    '/oauth/forgot-password'                   => '/client/layout/pages/auth/quen-mat-khau.php',
    '/oauth/recover-password'                  => '/client/layout/pages/auth/quen-mat-khau.php',

    // Menu chính
    '/thong-tin-thanh-toan'                    => '/client/layout/pages/global/menu/nap-tien.php',
    '/nap-tien/the-cao'                        => '/client/layout/pages/global/menu/the-cao.php',
    '/thong-tin-goi'                           => '/client/layout/pages/global/menu/info-vip.php',
    '/thue-goi'                                => '/client/layout/pages/global/menu/thue-goi.php',
    '/thue-app-bank-ao'                        => '/client/layout/pages/global/menu/thue-app-bank-ao.php',
    '/danh-muc/ma-nguon'                       => '/client/layout/pages/global/menu/ma-nguon.php',
    '/fake-bill/binance'                       => '/client/layout/pages/global/menu/fakebill-binance.php',
    '/fake-bill/man-hinh-khoa'                 => '/client/layout/pages/global/menu/fakebill-manhinhkhoa.php',
    '/fake-bill-chuyen-khoan'                  => '/client/layout/pages/global/menu/fakebill.php',
    '/fake-bill-priority'                      => '/client/layout/pages/global/menu/fake-bill-priority.php',
    '/fake-so-du'                              => '/client/layout/pages/global/menu/fakesodu.php',
    '/fake-bdsd'                               => '/client/layout/pages/global/menu/fakebiendong.php',

    // Lịch sử cá nhân
    '/lich-su/nap-tien'                        => '/client/layout/pages/global/menu/lich-su-nap-tien.php',
    '/lich-su/mua-goi'                         => '/client/layout/pages/global/menu/lich-su-mua-goi.php',
    '/lich-su/mua-hang'                        => '/client/layout/pages/global/menu/lich-su-mua-hang.php',
    '/lich-su/tao-bill'                        => '/client/layout/pages/global/menu/lich-su-tao-bill.php',
    '/lich-su/thue-bank'                       => '/client/layout/pages/global/menu/lich-su-thue-bank.php',

    // Fake Bill Chuyển Khoản Chi Tiết
    '/fake-bill/mb-bank'                       => '/client/layout/pages/global/sub-page/bill/mb-bank.php',
    '/fake-bill/mb-bank-don-luu'               => '/client/layout/pages/global/sub-page/bill/mb-bank-don-luu.php',
    '/fake-bill/mb-bank-tet'                   => '/client/layout/pages/global/sub-page/bill/mb-bank-tet.php',
    '/fake-bill/mb-bank-noel'                  => '/client/layout/pages/global/sub-page/bill/mb-bank-noel.php',
    '/fake-bill/mb-junior'                     => '/client/layout/pages/global/sub-page/bill/mb-junior.php',
    '/fake-bill/vietcombank'                   => '/client/layout/pages/global/sub-page/bill/vietcombank.php',
    '/fake-bill/techcombank'                   => '/client/layout/pages/global/sub-page/bill/techcombank.php',
    '/fake-bill/vietinbank'                    => '/client/layout/pages/global/sub-page/bill/vietinbank.php',
    '/fake-bill/acb'                           => '/client/layout/pages/global/sub-page/bill/acb.php',
    '/fake-bill/momo'                          => '/client/layout/pages/global/sub-page/bill/momo.php',
    '/fake-bill/zalopay'                       => '/client/layout/pages/global/sub-page/bill/zalopay.php',
    '/fake-bill/tp-bank'                       => '/client/layout/pages/global/sub-page/bill/tpbank.php',
    '/fake-bill/vp-bank'                       => '/client/layout/pages/global/sub-page/bill/vpbank.php',
    '/fake-bill/msb'                           => '/client/layout/pages/global/sub-page/bill/msb.php',
    '/fake-bill/agribank'                      => '/client/layout/pages/global/sub-page/bill/agribank.php',
    '/fake-bill/bacabank'                      => '/client/layout/pages/global/sub-page/bill/bacabank.php',
    '/fake-bill/viettel-money'                 => '/client/layout/pages/global/sub-page/bill/viettel-money.php',
    '/fake-bill/sell-binance'                  => '/client/layout/pages/global/sub-page/bill/sell-binance.php',
    '/fake-bill/buy-binance'                   => '/client/layout/pages/global/sub-page/bill/buy-binance.php',
    '/fake-bill/okx'                           => '/client/layout/pages/global/sub-page/bill/okx.php',
    '/fake-bill/hdbank'                        => '/client/layout/pages/global/sub-page/bill/hdbank.php',
    '/fake-bill/seabank'                       => '/client/layout/pages/global/sub-page/bill/seabank.php',
    '/fake-bill/vibbank'                       => '/client/layout/pages/global/sub-page/bill/vibbank.php',
    '/fake-bill/vietbank'                      => '/client/layout/pages/global/sub-page/bill/vietbank.php',
    '/fake-bill/bvbank'                        => '/client/layout/pages/global/sub-page/bill/bvbank.php',
    '/fake-bill/pgbank'                        => '/client/layout/pages/global/sub-page/bill/pgbank.php',
    '/fake-bill/bidv'                          => '/client/layout/pages/global/sub-page/bill/bidv.php',
    '/fake-bill/cake'                          => '/client/layout/pages/global/sub-page/bill/cake.php',
    '/fake-bill/liobank'                       => '/client/layout/pages/global/sub-page/bill/liobank.php',
    '/fake-bill/shinhanbank'                   => '/client/layout/pages/global/sub-page/bill/shinhanbank.php',
    '/fake-bill/sacombank'                     => '/client/layout/pages/global/sub-page/bill/sacombank.php',
    '/fake-bill/worri'                         => '/client/layout/pages/global/sub-page/bill/worribank.php',
    '/fake-bill/tp-bank-new'                   => '/client/layout/pages/global/sub-page/bill/tpbank-new.php',
    '/fake-bill/namabank'                      => '/client/layout/pages/global/sub-page/bill/namabank.php',
    '/fake-bill/vietinbank-1'                  => '/client/layout/pages/global/sub-page/bill/vietinbankred.php',
    '/fake-bill/pvbank'                        => '/client/layout/pages/global/sub-page/bill/pvbank.php',
    '/fake-bill/ocb'                           => '/client/layout/pages/global/sub-page/bill/ocb.php',
    '/fake-bill/chinhsachxahoi'                => '/client/layout/pages/global/sub-page/bill/chinhsachxahoi.php',
    '/fake-bill/eximbank'                      => '/client/layout/pages/global/sub-page/bill/eximbank.php',
    '/fake-bill/saigonbank'                    => '/client/layout/pages/global/sub-page/bill/saigonbank.php',
    '/fake-bill/abbank'                        => '/client/layout/pages/global/sub-page/bill/abbank.php',
    '/fake-bill/ncb'                           => '/client/layout/pages/global/sub-page/bill/ncb.php',
    '/fake-bill/lpbank'                        => '/client/layout/pages/global/sub-page/bill/lpbank.php',
    '/fake-bill/kienlongbank'                  => '/client/layout/pages/global/sub-page/bill/kienlongbank.php',
    '/fake-bill/shb'                           => '/client/layout/pages/global/sub-page/bill/shb.php',
    '/fake-bill/vietcombank-new'               => '/client/layout/pages/global/sub-page/bill/vietcombank-new.php',
    '/fake-bill/acb-new'                       => '/client/layout/pages/global/sub-page/bill/acb-new.php',

    // Fake Bill Priority
    '/fake-bill-chuyen-khoan/mb-bank-priority'     => '/client/layout/pages/global/sub-page/bill/mb-bank-priority.php',
    '/fake-bill/mb-bank-priority'                  => '/client/layout/pages/global/sub-page/bill/mb-bank-priority.php',
    '/fake-bill-chuyen-khoan/seabank-premium'      => '/client/layout/pages/global/sub-page/bill/seabank-premium.php',
    '/fake-bill-chuyen-khoan/acb-privilege'        => '/client/layout/pages/global/sub-page/bill/acb-privilege.php',
    '/fake-bill-chuyen-khoan/vietcombank-priority' => '/client/layout/pages/global/sub-page/bill/vietcombank-priority.php',
    '/fake-bill-chuyen-khoan/vietcombank-galaxy'   => '/client/layout/pages/global/sub-page/bill/vietcombank-galaxy.php',
    '/fake-bill-chuyen-khoan/bidv-premier'         => '/client/layout/pages/global/sub-page/bill/bidv-premier.php',

    // Fake Bill Màn Hình Khóa
    '/fake-bill/man-hinh-khoa/mb-bank'         => '/client/layout/pages/global/sub-page/man-hinh-khoa/mb-bank.php',
    '/fake-bill/man-hinh-khoa/acb'             => '/client/layout/pages/global/sub-page/man-hinh-khoa/acb.php',
    '/fake-bill/man-hinh-khoa/momo'            => '/client/layout/pages/global/sub-page/man-hinh-khoa/momo.php',
    '/fake-bill/man-hinh-khoa/vietcombank'     => '/client/layout/pages/global/sub-page/man-hinh-khoa/vietcombank.php',
    '/fake-bill/man-hinh-khoa/binance'         => '/client/layout/pages/global/sub-page/man-hinh-khoa/binance.php',
    '/fake-bill/man-hinh-khoa/zalopay'         => '/client/layout/pages/global/sub-page/man-hinh-khoa/zalopay.php',
    '/fake-bill/man-hinh-khoa/zlpay'           => '/client/layout/pages/global/sub-page/man-hinh-khoa/zlpay.php',
    '/fake-bill/man-hinh-khoa/bidv'            => '/client/layout/pages/global/sub-page/man-hinh-khoa/bidv.php',
    '/fake-bill/man-hinh-khoa/sacombankpay'    => '/client/layout/pages/global/sub-page/man-hinh-khoa/sacombankpay.php',
    '/fake-bill/man-hinh-khoa/vietinbank'      => '/client/layout/pages/global/sub-page/man-hinh-khoa/vietinbank.php',
    '/fake-bill/man-hinh-khoa/techcombank'     => '/client/layout/pages/global/sub-page/man-hinh-khoa/techcombank.php',
    '/fake-bill/man-hinh-khoa/vib'             => '/client/layout/pages/global/sub-page/man-hinh-khoa/vib.php',
    '/fake-bill/man-hinh-khoa/msb'             => '/client/layout/pages/global/sub-page/man-hinh-khoa/msb.php',
    '/fake-bill/man-hinh-khoa/tpbank'          => '/client/layout/pages/global/sub-page/man-hinh-khoa/tpbank.php',
    '/fake-bill/man-hinh-khoa/agribank'        => '/client/layout/pages/global/sub-page/man-hinh-khoa/agribank.php',

    // Fake Số Dư
    '/fake-so-du/vietinbank'                   => '/client/layout/pages/global/sub-page/so-du/vietinbank.php',
    '/fake-so-du/momo'                         => '/client/layout/pages/global/sub-page/so-du/momo.php',
    '/fake-so-du/mb-bank'                      => '/client/layout/pages/global/sub-page/so-du/mb-bank.php',
    '/fake-so-du/mbnoel'                       => '/client/layout/pages/global/sub-page/so-du/mbnoel.php',
    '/fake-so-du/zalopay'                      => '/client/layout/pages/global/sub-page/so-du/zalopay.php',
    '/fake-so-du/acb'                          => '/client/layout/pages/global/sub-page/so-du/acb.php',
    '/fake-so-du/techcombank'                  => '/client/layout/pages/global/sub-page/so-du/techcombank.php',
    '/fake-so-du/vietcombank'                  => '/client/layout/pages/global/sub-page/so-du/vietcombank.php',
    '/fake-so-du/cake'                         => '/client/layout/pages/global/sub-page/so-du/cake.php',
    '/fake-so-du/mb-bank-priority'             => '/client/layout/pages/global/sub-page/so-du/mb-priority.php',
    '/fake-so-du/agribank'                     => '/client/layout/pages/global/sub-page/so-du/agribank.php',
    '/fake-so-du/tpbank'                       => '/client/layout/pages/global/sub-page/so-du/tpbank.php',
    '/fake-so-du/vpbank'                       => '/client/layout/pages/global/sub-page/so-du/vpbank.php',

    // Fake Biến Động Số Dư
    '/fake-bdsd/mb-bank'                       => '/client/layout/pages/global/sub-page/bdsd/mb-bank.php',
    '/fake-bdsd/techcombank'                   => '/client/layout/pages/global/sub-page/bdsd/techcombank.php',

    // Giấy Tờ & Tools
    '/tao-qr/cccd'                             => '/client/layout/pages/global/sub-page/giay-to/qr-cccd.php',
    '/fake-cccd'                               => '/client/layout/pages/global/sub-page/giay-to/cccd.php',
    '/fake-velenmaybay'                        => '/client/layout/pages/global/sub-page/giay-to/velenmaybay.php',
    '/fake-velenmaybay2'                       => '/client/layout/pages/global/sub-page/giay-to/velenmaybay2.php',
    '/fake-velenmaybay3'                       => '/client/layout/pages/global/sub-page/giay-to/velenmaybay3.php',
    '/fake-vedientu'                           => '/client/layout/pages/global/sub-page/giay-to/vedientu.php',
    '/fake-giayphepkinhdoanh'                  => '/client/layout/pages/global/sub-page/giay-to/cccd.php',
    '/tools/spam-sms'                          => '/client/layout/pages/global/sub-page/tools/spam-sms.php',
    '/tools/spam-ngl-link'                     => '/client/layout/pages/global/sub-page/tools/spam-ngl.php',
    '/tools/encoder-php-online'                => '/client/layout/pages/global/sub-page/tools/encode-php.php',
    '/tools/obfuscate-javascript'              => '/client/layout/pages/global/sub-page/tools/obf-js.php',
    '/tools/tao-subdomain-mien-phi'            => '/client/layout/pages/global/sub-page/tools/generator-subdomain.php',
    '/tools/scan-info-facebook'                => '/client/layout/pages/global/sub-page/tools/scan-info-facebook.php',
    '/bad-error'                               => '/client/layout/pages/global/error/bad-error.php',

    // Quản trị Admin
    '/admin/dashboard'                         => '/admin/index.php',
    '/admin/users/list'                        => '/admin/user-list.php',
    '/admin/users/banned'                      => '/admin/user-banned.php',
    '/admin/create/product'                    => '/admin/add-product.php',
    '/admin/product/list'                      => '/admin/product-list.php',
    '/admin/create/newfeeds'                   => '/admin/add-newfeeds.php',
    '/admin/newfeeds/list'                     => '/admin/newfeeds-list.php',
    '/admin/history/bank'                      => '/admin/bank.php',
    '/admin/history/card'                      => '/admin/card.php',
    '/admin/history/bill'                      => '/admin/bill.php',
    '/admin/history/plan'                      => '/admin/history-plan.php',
    '/admin/manager/payment'                   => '/admin/payment.php',
    '/admin/manager/plan'                      => '/admin/plan.php',
    '/admin/activity/log'                      => '/admin/activity.php',
    '/admin/cron-jobs'                         => '/admin/cron-jobs.php',
    '/admin/settings'                          => '/admin/settings.php',
    '/admin/tutorial-of-admin'                 => '/admin/tutorial.php',
    '/admin/auth/logout'                       => '/admin/auth/logout.php',

    // Ajax Endpoints
    '/ajax/global/users'                       => '/app/ajax/global/users/ajax-user.php',
    '/ajax/global/admin'                       => '/app/ajax/global/admin/ajax-admin.php',
    '/ajax/global/default'                     => '/app/ajax/global/default/ws-demo.php',
    '/ajax/global/default/stats'               => '/app/ajax/global/default/stats.php',
    '/ajax/global/installer'                   => '/app/ajax/global/default/installer.php',
    '/ajax/global/download'                    => '/app/ajax/global/default/download.php',

    // Callbacks & Webhooks & API
    '/call-back/api/auto-bank'                 => '/function/call-back/api/auto-bank.php',
    '/call-back/api/n'                         => '/function/call-back/api/notify.ini.php',
    '/call-back/api/payment'                   => '/function/call-back/api/payment.php',
    '/call-back/api/card5s'                    => '/function/call-back/api/card5s.php',
    '/call-back/api/thesieure'                 => '/function/call-back/api/thesieure.php',
    '/call-back/api/spam-sms'                  => '/function/call-back/api/spam-sms.php',
    '/call-back/api/spam-ngl'                  => '/function/call-back/api/spam-ngl.php',
    '/call-back/api/delete-subdomain'          => '/function/call-back/api/delete-subdomain.php',
    '/call-back/api/export-credit-adjustments' => '/function/call-back/api/export-credit-adjustments.php',
    '/call-back/lavender'                      => '/function/insert/alert/vip.ini.php',
    '/log'                                     => '/function/call-back/controller/log.php',
    '/cron-jobs/global'                        => '/function/cron/global.php',
];

// Định tuyến URL động (Regex Pattern Match)
$dynamic = [
    // Nạp tiền: /nap-tien/{username}/send hoặc /nap-tien/{username}/transfer
    '#^/nap-tien/([^/]+)/(?:send|transfer)$#' => [
        'file' => '/client/layout/pages/global/menu/nap-tien.php',
        'params' => ['username']
    ],
    // Phân trang danh mục mã nguồn: /danh-muc/ma-nguon/trang/{page}
    '#^/danh-muc/ma-nguon/trang/([0-9]+)/?$#' => [
        'file' => '/client/layout/pages/global/menu/ma-nguon.php',
        'params' => ['page']
    ],
    // Chi tiết mã nguồn: /view-code/{slug} hoặc /details/{slug}
    '#^/(?:view-code|details)/([^/]+)$#' => [
        'file' => '/client/layout/pages/global/menu/chi-tiet-ma-nguon.php',
        'params' => ['slug']
    ],
    // Chỉnh sửa thành viên trong Admin: /admin/users/edit/{id}
    '#^/admin/users/edit/([0-9a-zA-Z]+)$#' => [
        'file' => '/admin/edit-user.php',
        'params' => ['id']
    ],
    // Cài đặt trang cá nhân thành viên: /user/{username}/settings
    '#^/user/([^/]+)/settings/?$#' => [
        'file' => '/client/layout/pages/user/profile.php',
        'params' => ['username']
    ],
    // Tải tệp bảo vệ: /download/{code}
    '#^/download/([a-fA-F0-9]{32})/?$#' => [
        'file' => '/function/insert/protect/verify.php',
        'params' => ['code']
    ],
];

// Xử lý static files cho Obfuscated PHP Downloads
if (preg_match('#^/obf-alom/download/(.*)$#', $p, $obfMatch)) {
    $targetFile = __DIR__ . '/function/obf-php/alom/download/' . $obfMatch[1];
    if (is_file($targetFile)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($targetFile) . '"');
        header('Content-Length: ' . filesize($targetFile));
        readfile($targetFile);
        return true;
    }
}

// 1. Kiểm tra Exact Route
if (isset($map[$p])) {
    $target = __DIR__ . $map[$p];
    if (is_dir($target)) {
        $target = rtrim($target, '/') . '/index.php';
    }
    if (is_file($target)) {
        require $target;
    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
    return true;
}

// 2. Kiểm tra Dynamic Route
foreach ($dynamic as $pattern => $config) {
    if (preg_match($pattern, $p, $matches)) {
        $target = __DIR__ . $config['file'];
        if (isset($config['params'])) {
            foreach ($config['params'] as $index => $paramName) {
                if (isset($matches[$index + 1])) {
                    $_GET[$paramName] = $matches[$index + 1];
                }
            }
        }
        if (is_file($target)) {
            require $target;
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
        return true;
    }
}

// 3. Fallback cho static files (CSS, JS, Images, Fonts, v.v.)
return false;
