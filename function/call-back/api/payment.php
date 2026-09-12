<?php
/**
 * Kết Nối CSDL
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
header('Content-Type: application/json');

$callback_api = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $callback_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
if (isset($data['status']) && $data['status'] === 'success') {
    foreach ($data['transactions'] as $transaction) {
        if ($transaction['type'] === 'IN') { 
            $cuphap = strtolower($TD->Setting('cuphap-naptien'));
            $cleanedDescription = preg_replace('/\s+/', ' ', trim($transaction['description']));
            if (preg_match('/' . preg_quote($cuphap, '/') . '(\d+)/i', $cleanedDescription, $matches)) {
                $userId = $matches[1];
                $username = Username($userId);
                if ($username) {
                        $descriptionTime = GetTimeDescription($cleanedDescription);
                        $transactionDateStr = date('Y-m-d') . ' ' . $descriptionTime;
                        $transactionTimestamp = strtotime($transactionDateStr);
                        $currentTimestamp = strtotime($time);
                        $interval = $currentTimestamp - $transactionTimestamp;
                        if ($interval <= 600) {
                            CongTien($username, $transaction['amount'], $transaction['transactionID'],$transaction['bank']);
                        } else {
                            exit(json_encode([
                                'status' => 'error',
                                'msg' => 'Giao dịch quá 10 phút'
                            ]));
                        }
                } 
            } else {
                exit(json_encode([
                    'status' => 'error',
                    'msg' => 'Không có giao dịch nào'
                ]));
            }
        }
    }
} else {
    exit(json_encode([
        'status' => 'error',
        'msg' => 'Lỗi kết nối api bank'
    ]));
}
function Username($userId) {
    global $thanhdieudb;
    $result = $thanhdieudb->query("SELECT username FROM users WHERE user_id = '{$userId}'");
    if ($result && $row = $result->fetch_assoc()) {
        return $row['username'];
    }
    return null;
}

function CongTien($username, $amount, $transactionID,$bank) {
    global $thanhdieudb, $TD, $time;

    if ($amount < $TD->Setting('min-nap')) {
        $thanhdieudb->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Số tiền nạp dưới mức nạp tối thiểu', '{$time}', 'thatbai')");
        return;
    }
    if ($thanhdieudb->query("SELECT * FROM ws_history_bank WHERE magiaodich = '{$transactionID}'")->num_rows > 0) {
        return; 
    }
    $thanhdieudb->query("UPDATE users SET sodu = sodu + {$amount}, tongnap = tongnap + {$amount} WHERE username = '{$username}'");
    $thanhdieudb->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Nạp tiền vào tài khoản', '{$time}', 'thanhcong')");
    $thanhdieudb->query("INSERT INTO ws_logs (username, content, time, action) VALUES ('{$username}', 'nạp tiền tự động $bank - Số tiền: " . FormatNumber::TD($amount, 2) . "đ', '{$time}', 'Nạp Tiền')");
}
function GetTimeDescription($description) {
    if (preg_match('/(\d{2}:\d{2}:\d{2})/', $description, $matches)) {
        return $matches[1];
    }
    return '00:00:00'; 
}
