<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

header('Content-Type: application/json');
if ($isLogin->check() && $user['rank'] !== 'admin' && !$TD->Setting('is-log') || !$isLogin->check() && !$TD->Setting('is-log')) {
    die(JSON_FORMATTER([
        'status' => [
            'error' => 400,
            'msg' => 'Logging is disabled.',
        ]
    ]));
}
$vtd = $thanhdieudb->prepare("SELECT * FROM ws_logs WHERE DATE(`time`) = CURDATE() ORDER BY `time` DESC");
$vtd->execute();
$wt = $vtd->get_result();
$logs = [];
if ($wt->num_rows > 0) 
{
    while ($w = $wt->fetch_assoc()) 
    {
        $logs[] = [
            'log_id' => $w['log_id'],
            'author' => (isset($user) && $user['rank'] === 'admin' ? $w['username'] : anonymous($w['username'])),
            'avatar' => Base64_Enc('/'.__IMG__.'/user-avatar.jpg'),
            'content' => $w['content'],
            'timeout' => 3150,
            'loop' => 9999,
            'color' => "#fff",
            'bottom' => -100,
            'timestamp' => strtotime($w['time']),
            'timeago' => timeago(strtotime($w['time'])),
            'pause' => 'hover',
            'close' => false,
        ];
    }

    $data = [
        'status' => 200,
        'info' => $logs,
    ];
} else {
    $data = [
        'status' => 400,
        'msg' => 'No log records today.',
    ];
}
echo JSON_FORMATTER($data);