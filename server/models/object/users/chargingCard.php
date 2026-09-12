<?php
if (!class_exists('DatabaseConnection')) {
    header('Location: /');
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'user-charging-card') 
{
    $telco = trim($_POST["loaithe"]);
    $amount = FormatNumber::PREG($_POST["menhgia"]);
    $code = FormatNumber::PREG($_POST["mathe"]);
    $serial = FormatNumber::PREG($_POST["serial"]);
    $request_id = rand(100000, 999999);
    $partner_id = $TD->Setting('partner-id');
    $partner_key = $TD->Setting('partner-key');
    $sign = md5($partner_key.$code.$serial);
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để có thể thanh toán gói này!']));
    }
    if (!TDSpamChecker::TD($taikhoan, $TD)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    $checks = [
        ['error' => empty($telco), 'msg' => 'Vui lòng chọn loại thẻ cần nạp.'],
        ['error' => empty($amount), 'msg' => 'Vui lòng chọn một mệnh giá.'],
        ['error' => empty($serial), 'msg' => 'Vui lòng không bỏ trống mục serial.'],
        ['error' => empty($code), 'msg' => 'Vui lòng không bỏ trống mục mã thẻ.'],
        ['error' => !array_key_exists($telco, $loaithe), 'msg' => 'Loại thẻ không hợp lệ.'],
        ['error' => !in_array($amount, $menhgia), 'msg' => 'Mệnh giá không hợp lệ.'],
        ['error' => !preg_match('/^\d{12,15}$/', $code), 'msg' => 'Mã thẻ không hợp lệ.'],
        ['error' => !preg_match('/^\d{11,14}$/', $serial), 'msg' => 'Mã serial không hợp lệ.'],
    ];
    foreach ($checks as $check) 
    {
        if ($check['error']) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => $check['message']]));
        }
    }

    $postCard5s = ChargingCard5s($telco, $code, $serial, $amount, $request_id, $partner_id, $sign, 'charging');
    if ($postCard5s== 99) {
        $into->wusteam('insert', 'ws_history_card', ['taikhoan' => $taikhoan, 'loaithe' => $telco, 'mathe' => $code, 'seriel' => $serial, 'menhgia' => $amount, 'trangthai' => 'choxuly']);
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Gửi thẻ thành công, vui lòng chờ hệ thống chúng tôi kiểm tra thẻ cào.']));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => $postCard5s]));
    }
}
