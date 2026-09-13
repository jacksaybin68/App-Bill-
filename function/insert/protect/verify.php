<?php
/**
 * Weryfikacja i pobieranie chronionych plików (download/{code})
 * Obsługuje pobieranie obfuskowanych plików / zabezpieczonych zasobów.
 */
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

header('Content-Type: application/json');

$code = $_GET['code'] ?? '';

if (empty($code)) {
    http_response_code(400);
    exit(json_encode(['status' => -1, 'msg' => 'Kod nieprawidłowy']));
}

try {
    $conn = DatabaseConnection::ThanhDieuDB();

    // Wyszukaj zamówienie / plik po kodzie weryfikacyjnym
    $stmt = $conn->prepare(
        "SELECT h.*, p.noidung FROM ws_history_products h " .
        "LEFT JOIN ws_products p ON h.product_id = p.id " .
        "WHERE h.magiaodich = ? LIMIT 1"
    );
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $res = $stmt->get_result();

    if (!$res || !$row = $res->fetch_assoc()) {
        http_response_code(404);
        exit(json_encode(['status' => -1, 'msg' => 'Không tìm thấy plik / kod nieważny']));
    }

    // Pobierz ścieżkę pliku produktu
    $filePath = $row['noidung'] ?? '';
    if (empty($filePath)) {
        http_response_code(404);
        exit(json_encode(['status' => -1, 'msg' => 'Plik tego produktu nie jest dostępny']));
    }

    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $filePath;
    if (!is_file($fullPath)) {
        http_response_code(404);
        exit(json_encode(['status' => -1, 'msg' => 'Plik nie istnieje na сервере']));
    }

    // Wyślij plik jako pobieranie
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
    header('Content-Length: ' . filesize($fullPath));
    readfile($fullPath);
    exit;
} catch (\Exception $e) {
    http_response_code(500);
    exit(json_encode(['status' => -1, 'msg' => 'Lỗi 서버: ' . $e->getMessage()]));
}