<?php
/**
 * Kết Nối CSDL
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
header('Content-Type: application/json');

function CapNhatTheCao($card_id, $status, $amount, $username)
{
    global $thanhdieudb;
    if ($status === 'thanhcong') {
        $wt = $thanhdieudb->query("SELECT sodu FROM users WHERE username = '$username'");
        if ($wt && $wt->num_rows > 0) 
        {
            $userData = $wt->fetch_assoc();
            $sodu_moi = $userData['sodu'] + $amount - 0.10;
            $thanhdieudb->query("UPDATE users SET sodu = '$sodu_moi' WHERE username = '$username'");
        }
    }
    $thanhdieudb->query("UPDATE ws_history_card SET trangthai = '$status' WHERE card_id = '$card_id'");
}
function XuLyTheCao()
{
    global $TD, $thanhdieudb;
    $wt = mysqli_query($thanhdieudb, "SELECT * FROM ws_history_card WHERE trangthai = 'choxuly'");
    $responses = [];
    if ($wt && mysqli_num_rows($wt) > 0) 
    {
        while ($row = mysqli_fetch_assoc($wt)) 
        {
            $card_id = $row['card_id'];
            $username = $row['taikhoan'];
            $telco = strtoupper($row['loaithe']);
            $code = $row['mathe'];
            $serial = $row['seriel'];
            $amount = $row['menhgia'];
            $request_id = $row['request_id'];
            $partner_id = $TD->Setting('partner-id');
            $partner_key = $TD->Setting('partner-key');
            $sign = md5($partner_key . $code . $serial);
            $postCard5s = ChargingCard5s($telco, $code, $serial, $amount, $request_id, $partner_id, $sign, 'check');
            if (isset($postCard5s)) {
                if ($postCard5s == 1) {
                    CapNhatTheCao($card_id, 'thanhcong', $amount, $username);
                    $responses[] = ["card_id" => $card_id, "r" => "Thành công"];
                } elseif ($postCard5s == 2) {
                    $amount_new = $amount * 0.5; // Trừ 50% thẻ sai mệnh giá
                    CapNhatTheCao($card_id, 'thanhcong', $amount_new, $username);
                    $responses[] = ["card_id" => $card_id, "r" => "Thẻ cào đúng sai mệnh giá -50%"];
                } elseif ($postCard5s == 99) {
                    $responses[] = ["card_id" => $card_id, "r" => "Thẻ cào đang chờ xử lý"];
                } else {
                    CapNhatTheCao($card_id, 'thatbai', $amount, $username);
                    $responses[] = ["card_id" => $card_id, "r" => "Thất bại: $postCard5s"];
                }
            } else {
                $responses[] = ["card_id" => $card_id, "r" => "Lỗi Callback Card5s"];
            }
        }
    } else {
        $responses[] = ["r" => "Bad request"]; // chưa có thẻ chờ xử lý
    }
    echo json_encode($responses); 
}
XuLyTheCao();
