<?php
/**
 * Callback API TheSiEuRe
 * Endpoint obsługujący zewnętrzne callback-i systemu TheSiEuRe.
 */
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/server/services/CallbackAuth.php';

header('Content-Type: application/json');

// Autoryzacja - wymaga poprawnego tokena callback
CallbackAuth::validate();

$action = $_GET['action'] ?? $_POST['action'] ?? 'status';

try {
    $conn = DatabaseConnection::ThanhDieuDB();
    switch ($action) {
        case 'status':
            echo json_encode([
                'status' => 200,
                'service' => 'thesieure',
                'msg' => 'service it worked.',
                'time' => date('Y-m-d H:i:s')
            ]);
            break;

        case 'nagroda':
            // Przykładowy handler wpisu nagrody / kredytu z platformy TheSiEuRe
            $username = $_POST['username'] ?? '';
            $amount = (int)($_POST['amount'] ?? 0);
            $magiaodich = $_POST['transactionID'] ?? '';
            if (empty($username) || $amount <= 0 || empty($magiaodich)) {
                http_response_code(400);
                echo json_encode(['status' => -1, 'msg' => 'Parametry nieprawidłowe']);
                break;
            }
            require_once $_SERVER['DOCUMENT_ROOT'] . '/server/services/BankDepositService.php';
            $deposit = new BankDepositService($TD, date('Y-m-d H:i:s'));
            $result = $deposit->processDeposit($username, $amount, $magiaodich, 'thesieure');
            echo json_encode($result);
            break;

        default:
            http_response_code(400);
            echo json_encode(['status' => -1, 'msg' => 'Action nieznany']);
            break;
    }
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => -1, 'msg' => 'Lỗi IHM: ' . $e->getMessage()]);
}