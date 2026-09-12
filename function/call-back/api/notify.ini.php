<?php
/**
 * Kết Nối CSDL
 */
require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';
header('Content-Type: application/json');

if ($isLogin->check())
{
    $last_check = $_SESSION['autobank-'.$taikhoan] ?? '1970-01-01 00:00:00';
    $wt = $thanhdieudb->prepare("
        SELECT * FROM ws_history_bank 
        WHERE username = ? AND thoigian > ? 
        ORDER BY thoigian DESC LIMIT 1
    ");
    $wt->bind_param("ss", $taikhoan, $last_check);
    $wt->execute();
    $owo = $wt->get_result();
    if ($owo->num_rows > 0) 
    {
        $transaction = $owo->fetch_assoc();
        $current_time = new DateTime();
        $transaction_time = new DateTime($transaction['thoigian']);
        $time_check = $current_time->getTimestamp() - $transaction_time->getTimestamp();
        if (isset($transaction['trangthai'], $transaction['sotien'])) 
        {
            switch (true) 
            {
                case ($transaction['trangthai'] === 'thanhcong' && $time_check <= 120 && $transaction['sotien'] >= $TD->Setting('min-nap')):
                    $e = 
                    [
                        'status' => 200,
                        'msg' => 'Bạn đã nạp '.FormatNumber::TD($transaction['sotien'], 2).'đ vào tài khoản thành công!'
                    ];
                    break;

                case ($transaction['trangthai'] === 'thanhcong' && $time_check <= 120 && $transaction['sotien'] < $TD->Setting('min-nap')):
                    $e = 
                    [
                        'status' => -1,
                        'msg' => 'Số tiền bạn vừa nạp dưới mức nạp tối thiểu, vui lòng nạp trên '.FormatNumber::TD($TD->Setting('min-nap'), 2).'đ để được cộng tiền vào tài khoản!'
                    ];
                    break;
                default:
                    break;
            }
        }
        $_SESSION['autobank-'.$taikhoan] = $transaction['thoigian'];
        unset($_SESSION["token_deposit"]);
    } else {
        $_SESSION['autobank-'.$taikhoan] = date('Y-m-d H:i:s');
    }
}
if ($SSC->checkssk()) 
{
    exit(JSON_FORMATTER(["status" => -2, 'msg' => "Phiên đã hết hạn vui lòng đăng nhập lại"]));
}
if (!empty($e)) 
{
    exit(JSON_FORMATTER($e));
} else {
    exit(JSON_FORMATTER(['status'=> 403, 'msg' => 'You are not authorized']));
}
