<?php
/**
 * Handler đăng nhập (AJAX + form fallback)
 * URL gọi: POST tới /function/handle/login.php
 *
 * Dạng AJAX mới (JS thanh-dieu-auth-login.js):
 *   POST body: action=_auth&_auth={"auth":"user-auth-login","username":"...","password":"...","remember-me":"..."}
 *
 * Dạng form cũ (form thuần không qua JS):
 *   POST body: auth=user-auth-login&username=...&password=...&remember-me=...
 *
 * Luôn trả JSON.
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../server/models/object/users/authModel.php';

// Khởi tạo phụ thuộc cần thiết
$TD = new Settings();
if (!isset($TD) || !($TD instanceof Settings)) {
    echo json_encode(['status' => -1, 'msg' => 'Hệ thống đang bảo trì. Vui lòng thử lại sau!']);
    exit;
}

$auth = new UserAuth($TD);

// Chấp nhận cả POST thuần (không bắt buộc AJAX header)
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if ($data === null && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fallback: parse từ $_POST nếu gửi form thuần
    $data = $_POST;
}

// Nếu hoàn toàn không có data
if (empty($data)) {
    echo json_encode(['status' => -2, 'msg' => 'Thiếu dữ liệu.']);
    exit;
}

// Chuẩn hóa dữ liệu về dạng action=_auth&_auth=json để gọi authModel.execute
// Case 1: Dạng AJAX mới — có sẵn _auth key
// Case 2: Dạng form cũ — có auth direct, cần gói lại
if (isset($data['_auth']) && is_string($data['_auth'])) {
    // Dạng AJAX: action=_auth, _auth=JSON
    $action = $data; // truyền cả object, execute sẽ đọc $action['_auth']
    $payload = $data;
} elseif (isset($data['auth']) && is_string($data['auth'])) {
    // Dạng form cũ: auth=user-auth-login&username=...&password=...
    // Gói lại thành dạng AJAX để authModel.execute xử lý
    $oauth = [
        'auth' => $data['auth'],
        'username' => $data['username'] ?? '',
        'password' => $data['password'] ?? '',
        'remember-me' => $data['remember-me'] ?? 'off',
    ];
    $action = ['_auth' => json_encode($oauth)];
    $payload = $data;
} else {
    echo json_encode(['status' => -2, 'msg' => 'Thiếu action authenticate.']);
    exit;
}

$result = $auth->execute($action, $payload);

// execute() trả về JSON string (qua JSON_FORMATTER), không phải array
if (is_string($result) && is_array(json_decode($result, true))) {
    echo $result;
    exit;
}

if (!is_array($result)) {
    $result = ['status' => -1, 'msg' => 'Phản hồi không hợp lệ.'];
}

echo JSON_FORMATTER($result);
exit;
