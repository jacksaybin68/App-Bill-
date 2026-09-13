<?php
/**
 * Ajax Endpoint Download
 * Obsługuje żądania pobierania zasobów z walidacją dostępu.
 */
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if (empty($action)) {
    http_response_code(400);
    exit(json_encode(['status' => -1, 'msg' => 'Action nieprawidłowy']));
}

// Walidacja zalogowania
if (!isset($_SESSION) || empty($_SESSION['username'] ?? '')) {
    http_response_code(401);
    exit(json_encode(['status' => -1, 'msg' => 'Vui lòng zalogować się najpierw']));
}

$conn = DatabaseConnection::ThanhDieuDB();

switch ($action) {
    case 'bill-image':
        // Pobranie obrazu fakebila na podstawie id
        $bill_id = (int)($_POST['bill-id'] ?? $_GET['bill-id'] ?? 0);
        $stmt = $conn->prepare("SELECT * FROM ws_fakebill WHERE fakebill_id = ? AND taikhoan = ? LIMIT 1");
        $stmt->bind_param('is', $bill_id, $_SESSION['username']);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res || !$row = $res->fetch_assoc()) {
            http_response_code(404);
            exit(json_encode(['status' => -1, 'msg' => 'Không tìm thấy bill']));
        }
        $base64Data = $row['image'] ?? '';
        echo json_encode(['status' => 200, 'image' => $base64Data]);
        break;

    case 'package':
        // Pobranie pliku obfuskowanego
        $file = $_POST['file'] ?? '';
        if (empty($file) || strpos($file, '..') !== false || str_starts_with($file, '/')) {
            http_response_code(400);
            exit(json_encode(['status' => -1, 'msg' => 'Nazwa pliku nieprawidłowa']));
        }
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/function/obf-php/alom/download/';
        $fullPath = $dir . $file;
        if (!is_file($fullPath)) {
            http_response_code(404);
            exit(json_encode(['status' => -1, 'msg' => 'Plik nie istnieje']));
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
        header('Content-Length: ' . filesize($fullPath));
        readfile($fullPath);
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => -1, 'msg' => 'Action nieznany']);
        break;
}