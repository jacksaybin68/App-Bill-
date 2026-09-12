<?php

require_once __DIR__ . '/logs/rate-limiter.php';
require_once __DIR__ . '/logs/api-logger.php';

ApiLogger::setMaxSize(5 * 1024 * 1024);

define('SPAM_NGL_MAX_REQUESTS_PER_HOUR', 30);
define('SPAM_NGL_MAX_REQUESTS_PER_DAY', 100);header('Content-Type: application/json');

if (isset($_GET['target'])) {
    $parsed = parse_url($_GET['target']);
    $path = explode('/', trim($parsed['path'], '/'));
    $username = $path[0];
}

$target = isset($_GET['target']) ? strtolower($_GET['target']) : '';
$question = isset($_GET['question']) ? strtolower($_GET['question']) : '';
$server = isset($_GET['server']) ? strtolower($_GET['server']) : '';

// Rate limiting check
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitKey = "ngl_{$clientIp}_{$target}";

$hourlyLimit = RateLimiter::check($rateLimitKey, SPAM_NGL_MAX_REQUESTS_PER_HOUR, 3600);
if (!$hourlyLimit['allowed']) {
    ApiLogger::warning('spam-ngl', "Hourly rate limit exceeded: IP={$clientIp}, Target={$target}");
    die(JSON_FORMATTER(['status' => 'error', 'data' => "Vượt giới hạn request. Thử lại sau " . ($hourlyLimit['reset_at'] - time()) . " giây."]));
}

$dailyLimit = RateLimiter::check($rateLimitKey, SPAM_NGL_MAX_REQUESTS_PER_DAY, 86400);
if (!$dailyLimit['allowed']) {
    ApiLogger::warning('spam-ngl', "Daily rate limit exceeded: IP={$clientIp}");
    die(JSON_FORMATTER(['status' => 'error', 'data' => "Đã đạt giới hạn daily. Thử lại tomorrow."]));
}

ApiLogger::info('spam-ngl', "New request: IP={$clientIp}, Target={$target}, Server={$server}");

if (empty($target) || empty($server)) {
    die(JSON_FORMATTER([
        'status' => 'error',
        'data' => 'Please ensure all fields are completed.',
    ]));
}
function Callback($username, $target, $question, $server) {
    $body = http_build_query([
        'username' => $username,
        'question' => $question,
        'deviceId' => DeviceId(),
        'referrer' => $target
    ]);
    $headers = [
        "accept: */*",
        "accept-language: vi-VN,vi;q=0.9",
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "pragma: no-cache",
        "priority: u=1, i",
        "sec-fetch-dest: empty",
        "sec-fetch-mode: cors",
        "sec-fetch-site: same-origin",
        "x-requested-with: XMLHttpRequest",
        "User-Agent: ".UserAgent()
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://ngl.link/api/submit");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_REFERER, $target);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    if ($res === false) {
        ApiLogger::error('spam-ngl', "NGL callback failed: Server={$server}, Target={$target}, Error=" . curl_error($ch));
        return 'Thất Bại: '.$server.' ['.$target.'] @ '.date('H:i:s | d/m/y');
    } else {
        ApiLogger::info('spam-ngl', "NGL callback success: Server={$server}, Target={$target}");
        return 'Thành Công: '.$server.' ['.$target.'] @ '.date('H:i:s | d/m/y');
    }
}
$type = [
    'basic' => 1,
    'normal' => 79,
    'luxury' => 150,
    'premium' => random_int(222,444)
];
$res = [
    'status' => 'success',
    'data' => [],
    'question' => $question,
    'server' => $server
];
if ($username && isset($type[$server])) {
    for ($i = 0; $i < $type[$server]; $i++) {
        if (in_array($server, ['basic', 'normal']) && $i > 0) {
            usleep(random_int(1000000, 2000000));
            }
        $questions = empty($question) 
            ? 'Free Online Spam NGL By Telegram: @Wus_Team '.WsRandomString::TD(11) 
            : $question;
        $res['data'][] = Callback($username, $target, $questions, $server);
    }
    $res['data'][] = 'done';
} else {
    $res = [
        'status' => 'error',
        'data' => 'Invalid server type or target url',
    ];
}
die(JSON_FORMATTER($res));
