<?php
/**
 * Xuất CSV credit adjustments - Admin review giao dịch trùng lặp
 * Theo BASELINE-NOTES.md: xuất CSV credit-adjustments-YYYYMMDD-HHMMSS.csv
 * để admin tự xử lý các dòng trunglap đã được xử lý residual
 */

require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/CallbackAuth.php';

// Xác thực callback token
CallbackAuth::validate();

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="credit-adjustments-' . date('Ymd-His') . '.csv"');

$conn = DatabaseConnection::ThanhDieuDB();

$sql = "
    SELECT 
        hb.id,
        hb.username,
        hb.loai,
        hb.magiaodich,
        hb.sotien,
        hb.noidung,
        hb.thoigian,
        hb.trangthai,
        hb.bank_name,
        u.tongnap AS user_total_deposit,
        u.sodu AS user_balance
    FROM ws_history_bank hb
    LEFT JOIN users u ON hb.username = u.username
    WHERE hb.trangthai = 'trunglap'
    ORDER BY hb.thoigian DESC, hb.id DESC
";

$result = $conn->query($sql);

$output = fopen('php://output', 'w');
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

fputcsv($output, [
    'ID', 'Username', 'Loại', 'Mã Giao Dịch', 'Số Tiền (đ)',
    'Nội Dung', 'Thời Gian', 'Trạng Thái', 'Ngân Hàng',
    'Tổng Nạp Của User (đ)', 'Số Dư Hiện Tại (đ)', 'Ghi Chú'
]);

$totalAmount = 0;
$count = 0;

while ($row = $result->fetch_assoc()) {
    $totalAmount += (int)$row['sotien'];
    $count++;
    fputcsv($output, [
        $row['id'], $row['username'], $row['loai'], $row['magiaodich'],
        number_format((int)$row['sotien'], 0, ',', '.'),
        $row['noidung'], $row['thoigian'], $row['trangthai'], $row['bank_name'],
        number_format((int)$row['user_total_deposit'], 0, ',', '.'),
        number_format((int)$row['user_balance'], 0, ',', '.'),
        'Giao dịch trùng lặp - Đã xử lý residual, cần admin review'
    ]);
}

fputcsv($output, [
    'TỔNG CỘNG',
    $count . ' giao dịch',
    '', '', number_format($totalAmount, 0, ',', '.'),
    '', '', '', '', '', '',
    'Tổng số tiền cần điều chỉnh'
]);

fclose($output);
