<?php
/**
 * Kết Nối CSDL
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/CallbackAuth.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/BankDepositService.php';

header('Content-Type: application/json');

CallbackAuth::validate();

$time = date('Y-m-d H:i:s');
$depositService = new BankDepositService($TD, $time);

$callback_api = $TD->Setting('api-bank');
if (empty($callback_api)) {
    exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Callback API not configured']));
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $callback_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    curl_close($ch);
    exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi kết nối api bank: ' . curl_error($ch)]));
}
curl_close($ch);

$data = json_decode($response, true);
if (!isset($data['status']) || $data['status'] !== 'success') {
    exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi kết nối api bank']));
}

$cuphap = strtolower($TD->Setting('cuphap-naptien'));
$results = [];

foreach ($data['transactions'] as $transaction) {
    if ($transaction['type'] !== 'IN') {
        continue;
    }

    $cleanedDescription = preg_replace('/\s+/', ' ', trim($transaction['description']));

    if (!preg_match('/' . preg_quote($cuphap, '/') . '(\d+)/i', $cleanedDescription, $matches)) {
        continue;
    }

    $userId = $matches[1];
    $username = getUsername($userId);

    if (!$username) {
        continue;
    }

    $timeDesc = GetTimeDescription($cleanedDescription);
    if (!$depositService->validateTimeWindow($timeDesc)) {
        $results[] = [
            'status' => -1,
            'msg' => 'Giao dịch quá 15 phút',
            'magiaodich' => $transaction['transactionID'] ?? ''
        ];
        continue;
    }

    $amount = (int)$transaction['amount'];
    $transactionID = $transaction['transactionID'];
    $bank = $transaction['bank'] ?? 'unknown';

    $results[] = $depositService->processDeposit($username, $amount, $transactionID, $bank);
}

echo JSON_FORMATTER([
    'status' => 200,
    'msg' => 'Xử lý giao dịch hoàn tất',
    'data' => $results
]);

function getUsername($userId) {
    $conn = DatabaseConnection::ThanhDieuDB();
    $stmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        return $row['username'];
    }
    return null;
}

function GetTimeDescription($description) {
    if (preg_match('/(\d{2}:\d{2}:\d{2})/', $description, $matches)) {
        return $matches[1];
    }
    return '00:00:00';
}
