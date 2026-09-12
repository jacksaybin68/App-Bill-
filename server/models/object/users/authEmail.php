<?php
if (!class_exists('DatabaseConnection')) {
    header('Location: /');
    exit;
}
header('Content-Type: application/json');
ThanhDieuPOST(function ($payloads) {
    extract($GLOBALS);
    $token = bin2hex(random_bytes(32));
    $code = WsRandomString::Number(6);
// if (isset($payloads['action']) && $payloads['action'] === 'user-confirm-email')
// {
//     $email = trim($payloads['email']);
//     $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes 1 seconds'));
//     // $postCaptcha = json_decode($initCaptcha->verify($_POST['lot_number'], $_POST['captcha_output'], $_POST['pass_token'], $_POST['gen_time']), true);
//     // if (isset($postCaptcha) && $postCaptcha['status'] !== 'status') {
//     //     exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xác minh captcha không thành công!']));
//     // }
//     if (empty($email) || !valid_email($email))
//     {
//         exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập một địa chỉ email hợp lệ.']));
//     }
//    if (!TDSpamChecker::TD($taikhoan, $TD)) {
//         exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên, vui lòng thử lại sau!']));
//     } elseif (isset($user) && (valid_email($user['email'])))
//     {
//         exit(JSON_FORMATTER(['status' => 200, 'confirm_email' => 1]));
//     }
//     $vtd = $thanhdieudb->prepare("SELECT username FROM users WHERE email = ?");
//     $vtd->bind_param("s", $email);
//     $vtd->execute();
//     $vtd->store_result();

//     if ($vtd->num_rows > 0)
//     {
//         exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Địa chỉ email: ' . $email . ' đã tồn tại trên hệ thống, vui lòng sử dụng địa chỉ email khác!']));
//     }
//     $check_otp = $thanhdieudb->prepare("SELECT otp_code, expires_at FROM ws_otpmailler WHERE username = ? AND is_used = 0 ORDER BY expires_at DESC LIMIT 1");
//     $check_otp->bind_param("s", $taikhoan);
//     $check_otp->execute();
//     $check_otp->store_result();
//     $check_otp->bind_result($existing_otp_code, $existing_expires_at);
//     if ($check_otp->num_rows > 0)
//     {
//         $check_otp->fetch();
//         $remaining_time = strtotime($existing_expires_at) - time();
//         if ($remaining_time > 0) {
//             exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Liên kết xác minh đã được gửi trước đó, hãy thử kiểm tra tin nhắn trong thư rác!', 'expires_at' => $existing_expires_at, 'remaining_time' => $remaining_time]));
//         }
//     }
//     $insert = $thanhdieudb->prepare("INSERT INTO ws_otpmailler (username, otp_code, expires_at, is_used, token) VALUES (?, ?, ?, 0, ?)");
//     $insert->bind_param("ssss", $taikhoan, $code, $expires_at, $token);
//     $insert->execute();
//     if ($insert->affected_rows > 0)
//     {
//         $remaining_time = strtotime($expires_at) - time();
//         $WsMailler->ConfirmEmail($email, 'https://'.$domain.'/xac-minh-email?c='.urlencode($wtSecurity->encrypt($code)) . '&e=' . urlencode($wtSecurity->encrypt($email)) . '&t=' . urlencode($wtSecurity->encrypt($token)) . '&u=' . urlencode($wtSecurity->encrypt($taikhoan)));
//         exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chúng tôi đã gửi liên kết xác minh đến địa chỉ email của bạn, vui lòng kiểm tra hộp thư!', 'expires_at' => $expires_at, 'remaining_time' => $remaining_time]));
//     } else {
//         exit(JSON_FORMATTER(['status' => -1, 'error' => 'Có lỗi xảy ra khi gửi liên kết xác minh.']));
//     }
// }
    if (isset($payloads['action']) && $payloads['action'] === 'user-auth-forgotpw') {
        $email = trim($payloads['email']);
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 days'));
        if (empty($email) || !valid_email($email)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập một địa chỉ email hợp lệ.']));
        }
        if (!TDSpamChecker::TD($taikhoan, $TD)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên, vui lòng thử lại sau!']));
        }
        $check_email = $thanhdieudb->prepare("SELECT username FROM users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();
        if ($check_email->num_rows === 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Địa chỉ email không được liên kết với bất kỳ tài khoản nào, vui lòng kiểm tra lại!']));
        }
        $check_email->bind_result($taikhoan);
        $check_email->fetch();
        if (empty($taikhoan)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tài khoản không tồn tại.']));
        }
        $check_otp = $thanhdieudb->prepare("SELECT otp_code, expires_at FROM ws_otpmailler WHERE username = ? AND is_used = 0 ORDER BY expires_at DESC LIMIT 1");
        $check_otp->bind_param("s", $taikhoan);
        $check_otp->execute();
        $check_otp->store_result();
        $check_otp->bind_result($existing_otp_code, $existing_expires_at);
        if ($check_otp->num_rows > 0) {
            $check_otp->fetch();
            $remaining_time = strtotime($existing_expires_at) - time();
            if ($remaining_time > 0) {
                exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Liên kết khôi phục tài khoản đã được gửi trước đó, hãy thử kiểm tra tin nhắn trong thư rác!']));
            }
        }
        $isSend = $WsMailler->ForgotPassword($email, 'https://' . $domain . '/oauth/recover-password?identify=' . urlencode($wtSecurity->encrypt(implode('|', ['ResetPw', $code, $token, $taikhoan]))) . '&token=' . urlencode($wtSecurity->encrypt($token)));
        if ($isSend === false) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Yêu cầu thất bại, có thể là do quản trị viên chưa cấu hình SMTP Mailer hoặc đã đạt giới hạn số lần gửi trong ngày hôm nay.']));
        }
        $insert = $thanhdieudb->prepare("INSERT INTO ws_otpmailler (username, otp_code, expires_at, is_used, token) VALUES (?, ?, ?, 0, ?)");
        $insert->bind_param("ssss", $taikhoan, $code, $expires_at, $token);
        $insert->execute();
        if ($insert->affected_rows > 0) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chúng tôi đã gửi liên kết khôi phục tài khoản đến địa chỉ email của bạn, vui lòng kiểm tra hộp thư, liên kết sẽ hết hạn sau 1 ngày!']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Có lỗi xảy ra khi gửi liên kết khôi phục tài khoản.']));
        }
    }
    if (isset($payloads['action']) && $payloads['action'] === 'user-reset-pw') {
        $password_new = trim($payloads['password_new']);
        $password_confirm = trim($payloads['password_confirm']);
        $token = isset($_POST['token']) ? $wtSecurity->decrypt($_POST['token']) : null;
        if (empty($token) || $wtSecurity->decrypt($_POST['token']) === false) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Token là bắt buộc, vui lòng không xoá hoặc sửa đổi nó!']));
        } else if (empty($password_new) || empty($password_confirm)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập mật khẩu mới và xác nhận lại mật khẩu mới.']));
        } else if ($password_new !== $password_confirm) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Mật khẩu nhập lại không khớp!']));
        } else if (!CheckPassword($password_new)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Mật khẩu mới không đúng định dạng!']));
        } else if (!CheckStrongPassword($password_new)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Mật khẩu mới của bạn quá dễ đoán, hãy chọn mật khẩu khác!']));
        }
        $check_used = $thanhdieudb->prepare("SELECT is_used FROM ws_otpmailler WHERE token = ?");
        $check_used->bind_param("s", $token);
        $check_used->execute();
        $result_used = $check_used->get_result();
        if ($result_used->num_rows > 0) {
            $token_data = $result_used->fetch_assoc();
            if ($token_data['is_used'] == 1) {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Phiên xác minh đã hết hạn hoặc không hợp lệ, vui lòng thử lại.', 'reload' => true]));
            }
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Token không hợp lệ, vui lòng thử lại.', 'reload' => true]));
        }
        $vtd = $thanhdieudb->prepare("SELECT username FROM ws_otpmailler WHERE token = ? AND is_used = 0 AND expires_at > NOW()");
        $vtd->bind_param("s", $token);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO->num_rows <= 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Phiên xác minh đã hết hạn hoặc không hợp lệ, vui lòng thử lại.', 'reload' => true]));
        }
        $w = $OoO->fetch_assoc();
        $username = $w['username'];
        $gt_email = $thanhdieudb->prepare("SELECT email FROM users WHERE username = ?");
        $gt_email->bind_param("s", $username);
        $gt_email->execute();
        $vlxx = $gt_email->get_result();
        if ($vlxx->num_rows > 0) {
            $r = $vlxx->fetch_assoc();
            $hashed_pass = password_hash($password_new, PASSWORD_BCRYPT, ['cost' => 7]);
            $oOo = $thanhdieudb->prepare("UPDATE users SET password=? WHERE username=?");
            $oOo->bind_param("ss", $hashed_pass, $username);
            // $oOo2 = $thanhdieudb->prepare("DELETE FROM ws_otpmailler WHERE token = ? AND username = ?");
            $oOo2 = $thanhdieudb->prepare("UPDATE ws_otpmailler SET is_used = 1 WHERE token = ? AND username = ?");
            $oOo2->bind_param("ss", $token, $username);
            if ($oOo->execute() && $oOo2->execute()) {
                exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Bạn đã thay đổi mật khẩu mới thành công!']));
            } else {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Đã xảy ra lỗi khi thay đổi mật khẩu mới.']));
            }
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không tìm thấy email cho tài khoản này.']));
        }
    }
});
