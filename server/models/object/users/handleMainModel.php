<?php
use Google\Service\PolyService\Format;
require_once $_SERVER['DOCUMENT_ROOT'].'/tele.config.php';
header('Content-Type: application/json');
// require($_SERVER['DOCUMENT_ROOT'].'/models/object/users/generatorSubdomain.php');
ThanhDieuPOST(function($payload) 
{
    extract($GLOBALS);
    if (isset($payload['action']) && $payload['action'] === 'thue-goi-vip') {
    $planId = $payload['plan'] ?? null;
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để có thể thanh toán gói này!']));
    }
    $vtd = $thanhdieudb->prepare("SELECT * FROM ws_dsgoi WHERE dsgoi_id = ?");
    $vtd->bind_param('i', $planId);
    $vtd->execute();
    $OoO = $vtd->get_result();
    if ($OoO->num_rows === 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Gói bạn chọn không tồn tại, hoặc đã bị xoá.']));
    }
    $tengoivip = 'vip'.$planId;
    $goi = $OoO->fetch_assoc();
    $tengoi = $goi['tengoi'];
    $giagoi = $goi['giagoi'];
    $hansudung = $goi['hansudung'];
    $gioihanbill = $goi['gioihanbill'];
    $trangthai = $goi['trangthai'];
    $tengoihientai = $plans->TD('tengoi', $taikhoan);
    if ($trangthai == 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Gói này hiện đang tạm khoá, vui lòng chọn gói khác hoặc liên hệ admin để biết thêm thông tin.']));
    }
    if ($user['sodu'] < $giagoi) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số dư trong tài khoản không đủ để thanh toán gói '.$tengoi.' (VIP'.$planId.'), vui lòng nạp thêm '.FormatNumber::TD($giagoi - $user['sodu'], 2).'đ và thử lại!']));
    }
    $vtd = $thanhdieudb->prepare("SELECT tengoi, ngayhethan FROM ws_plans WHERE taikhoan = ? AND trangthai = '1'");
    $vtd->bind_param('s', $taikhoan);
    $vtd->execute();
    $OoO = $vtd->get_result();
    if ($OoO->num_rows > 0) {
        $row = $OoO->fetch_assoc();
        if (strtolower($tengoihientai) === strtolower($tengoivip)) {
            $vtd = $thanhdieudb->prepare("UPDATE ws_plans SET giatien = ?, ngayhethan = DATE_ADD(ngayhethan, INTERVAL $hansudung DAY) WHERE taikhoan = ? AND tengoi = ? AND trangthai = 1");
            $vtd->bind_param('iss', $giagoi, $taikhoan, $tengoivip);
            $action = 'gia hạn gói';
            $tengoimoi = $tengoi;
        } else {
            $thanhdieudb->begin_transaction();
            try {
                $vtd = $thanhdieudb->prepare("UPDATE ws_plans SET tengoi = ?, giatien = ?, gioihanbill = ?, ngayhethan = DATE_ADD(NOW(), INTERVAL $hansudung DAY) WHERE taikhoan = ? AND tengoi = ? AND trangthai = 1");
                $vtd->bind_param('siisi', $tengoivip, $giagoi, $gioihanbill, $taikhoan, $tengoihientai);
                $vtd->execute();
                $today = date('Y-m-d');
                $del = $thanhdieudb->prepare("DELETE FROM ws_limitbill WHERE taikhoan = ? AND DATE(ngaytao) = ?");
                $del->bind_param("ss", $taikhoan, $today);
                $del->execute();
                $thanhdieudb->commit();
                $action = 'nâng cấp gói';
                $tengoimoi = $tengoi;
            } catch (Exception $e) {
                $thanhdieudb->rollback();
                exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi: ".$e->getMessage()]));
            }
        }
    } else {
        $vtd = $thanhdieudb->prepare("INSERT INTO ws_plans (taikhoan, tengoi, giatien, ngaymua, ngayhethan, trangthai, gioihanbill) VALUES (?, ?, ?, NOW(), DATE_ADD(NOW(), INTERVAL $hansudung DAY), '1', ?)");
        $vtd->bind_param('ssii', $taikhoan, $tengoivip, $giagoi, $gioihanbill);
        $action = 'mua gói';
        $tengoimoi = $tengoi;
        $tengoihientai = 'không có gói';
    }
    if ($vtd->execute()) {
        $sodu_moi = $user['sodu'] - $giagoi;
        $vtd = $thanhdieudb->prepare("UPDATE users SET sodu = ?, tongtieu = tongtieu + ? WHERE username = ?");
        $vtd->bind_param('iis', $sodu_moi, $giagoi, $taikhoan);
        $vtd->execute();

        $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='".$action." VIP".$planId." với giá ".FormatNumber::TD($giagoi, 2)."đ', `action`='".ucwords($action)."'");
        $msg = $action === 'mua gói'
        ? 'Bạn đã mua thành công gói '.strtoupper($tengoivip).'. Gói sẽ hết hạn vào: '.FormatTime::TD($plans->TD('ngayhethan', $taikhoan), 1)
        : ($action === 'gia hạn gói'
            ? 'Bạn đã gia hạn gói '.strtoupper($tengoivip).' thành công. Gói sẽ hết hạn vào: '.FormatTime::TD($plans->TD('ngayhethan', $taikhoan), 1)
            : 'Bạn đã nâng cấp từ gói '.strtoupper($tengoihientai).' sang gói '.strtoupper($tengoivip).'. Gói sẽ hết hạn vào: '.FormatTime::TD($plans->TD('ngayhethan', $taikhoan), 1));

        exit(JSON_FORMATTER(['status' => 200, 'msg' => $msg, 'vip' => $tengoi, 'hsd' => $plans->TD('ngayhethan', $taikhoan)]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi khi '.$action.' gói '.$tengoi.'.']));
    }
}
if (isset($payload['action']) && $payload['action'] === 'change-apikey') {
    $vtd = $thanhdieudb->prepare("UPDATE users SET access_key = ? WHERE username = ?");
    if ($vtd) {
        $access_key = WsRandomString::Key();
        $vtd->bind_param('ss', $access_key, $taikhoan);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Access Key: '.$access_key, 'key' => $access_key]));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Thay đổi khoá api key thất bại!']));
        }
    }
}
if (isset($payload['action']) && $payload['action'] === 'history-deposit') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để có thể xem lịch sử nạp tiền!']));
    }
    $OoO = $thanhdieudb->query("SELECT * FROM ws_history_bank WHERE username = '{$user['username']}' ORDER BY thoigian DESC");
    $data = [];
    if ($OoO && $OoO->num_rows > 0) {
        while ($thanhdieu = $OoO->fetch_assoc()) {
            $data[] = [$thanhdieu['magiaodich'], FormatNumber::TD($thanhdieu['sotien']).'đ', $thanhdieu['noidung'], FormatTime::TD($thanhdieu['thoigian'], 1), $thanhdieu['trangthai']];
        }
    } else {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chưa có lịch sử nạp tiền']));
    }
    $res = ['recordsTotal' => count($data), 'data' => $data];
    exit(JSON_FORMATTER(['status' => 200, 'msg' => $res]));
}
if (isset($payload['action']) && $payload['action'] === 'history-buyplan') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Vui lòng đăng nhập để có thể xem lịch sử mua gói!']));
    }
    $OoO = $thanhdieudb->query("SELECT * FROM ws_plans WHERE taikhoan = '{$user['username']}'");
    $data = [];
    if ($OoO && $OoO->num_rows > 0) {
        while ($thanhdieu = $OoO->fetch_assoc()) {
            $expiration = $thanhdieu['ngayhethan'];
            if ($expiration) {
                if ((date("Y", strtotime($expiration)) - date("Y")) > 10) {
                    $ngayhethan = '∞/Vĩnh viễn';
                } else {
                    $ngayhethan = FormatTime::TD($thanhdieu['ngayhethan'], 1);
                }
            } else {
                $ngayhethan = $thanhdieu['ngayhethan'];
            }

            $data[] = [strtoupper($thanhdieu['tengoi']), FormatNumber::TD($thanhdieu['giatien']).'đ', ($thanhdieu['gioihanbill'] > 1999) ? '∞/Vô hạn' : $thanhdieu['gioihanbill'].'/ngày', FormatTime::TD($thanhdieu['ngaymua'], 1), $ngayhethan, $thanhdieu['trangthai']];
        }
    } else {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chưa có lịch sử mua gói']));
    }
    $res = ['recordsTotal' => count($data), 'data' => $data];
    exit(JSON_FORMATTER(['status' => 200, 'msg' => $res]));
}
if (isset($payload['action']) && $payload['action'] === 'history-fakebill') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Vui lòng đăng nhập để có thể xem lịch sử tạo bill!']));
    }
    $OoO = $thanhdieudb->query("SELECT * FROM ws_history_fakebill WHERE username = '{$user['username']}' ORDER BY time DESC");
    $data = [];
    if ($OoO && $OoO->num_rows > 0) {
        while ($thanhdieu = $OoO->fetch_assoc()) {
            $data[] = [$thanhdieu['fakebill_id'], $thanhdieu['namebill'], $domain.'/public/cache/bill/'.$thanhdieu['image'], FormatTime::TD($thanhdieu['time'], 1), $thanhdieu['type']];
        }
    } else {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chưa có lịch sử tạo bill']));
    }
    $res = ['recordsTotal' => count($data), 'data' => $data];
    exit(JSON_FORMATTER(['status' => 200, 'msg' => $res]));
}
if (isset($payload['action']) && $payload['action'] === 'user-attack-sms') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($ip, $TD)) {
        exit(JSON_FORMATTER(['status' => false, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    $sdt = FormatNumber::PREG($payload['sdt']);
    $server = THANHDIEU($payload['server']);
    $blacklist = ['0968091844', ''];
    if ($server !== 'basic') {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Server not found 0x00002']));
    } elseif (CheckSdt($sdt)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập đúng số điện thoại hợp lệ!']));
    } elseif (in_array($sdt, $blacklist)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số điện thoại '.$sdt.' đang nằm trong danh sách đen, không thể gửi yêu cầu spam sms vào số này.']));
    }
    $attack_limit = $thanhdieudb->query("SELECT COUNT(*) FROM ws_spamsms WHERE taikhoan = '$taikhoan' AND trangthai = 'pending'")->fetch_row()[0];
    if ($attack_limit >= 3) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Server miễn phí chỉ có thể chạy tối đa 3 spam sms đồng thời cùng 1 lúc.']));
    }
    $vtd = $thanhdieudb->prepare("SELECT trangthai, spamsms_id FROM ws_spamsms WHERE taikhoan = ? AND sodienthoai = ?");
    $vtd->bind_param("ss", $taikhoan, $sdt);
    $vtd->execute();
    $vtd->store_result();
    $vtd->bind_result($trangthai, $spamsms_id);
    $limit_sms = false;
    while ($vtd->fetch()) {
        if ($trangthai === 'pending') {
            $limit_sms = true;
            break;
        }
    }
    if ($limit_sms) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số điện thoại này hiện đang trong trạng thái đang xử lý, hãy chờ hết thời gian chờ và gửi yêu cầu lại!']));
    }
    $vtd->close();
    $timer = date("Y-m-d H:i:s", strtotime("+120 seconds"));
    $vtd = $thanhdieudb->prepare("INSERT INTO ws_spamsms (taikhoan, sodienthoai, thoigiancho, maychu) VALUES (?, ?, ?, ?)");
    $vtd->bind_param("ssss", $taikhoan, $sdt, $timer, $server);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã gửi yêu cầu attack sms!', 'sdt' => $sdt, 'spamsms_id' => $spamsms_id]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Có lỗi xảy ra khi thêm yêu cầu attack sms!']));
    }
} elseif (isset($payload['action']) && $payload['action'] === 'history-spamsms') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => '<b class="text-red-800">Vui lòng đăng nhập để có thể xem lịch sử!</b>']));
    }
    $vtd = $thanhdieudb->prepare("UPDATE ws_spamsms SET trangthai = 'success' WHERE thoigiancho <= ? AND trangthai = 'pending'");
    $vtd->bind_param("s", $time);
    $vtd->execute();
    $vtd->close();
    $OoO = $thanhdieudb->query("SELECT * FROM ws_spamsms WHERE taikhoan = '{$user['username']}' ORDER BY thoigian DESC");
    $data = [];
    if ($OoO && $OoO->num_rows > 0) {
        while ($thanhdieu = $OoO->fetch_assoc()) {
            $data[] = [substr(FormatNumber::PREG($thanhdieu["sodienthoai"]), 0, 7).'***', THANHDIEU($thanhdieu['maychu']), $thanhdieu['thoigiancho'], $thanhdieu['trangthai']];
        }
    } else {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chưa có lịch sử tấn công']));
    }
    $res = ['recordsTotal' => count($data), 'data' => $data];
    exit(JSON_FORMATTER(['status' => 200, 'msg' => $res]));
}
if (isset($payload['action']) && $payload['action'] === 'user-attack-ngl-link') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($taikhoan, $TD, 2)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    $target = THANHDIEU(RemoveParams($payload['target']));
    $server = THANHDIEU($payload['server']);
    $question = THANHDIEU($payload['question']);
    $blacklist = ['https://ngl.link/thanhdieutv'];
    $type = ['basic' => 100, 'normal' => 450, 'luxury' => 700, 'premium' => random_int(1000, 1500)];
    if (empty($target)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Không được bỏ trống link mục tiêu!']));
    } elseif (!in_array($server, ['basic', 'normal', 'luxury', 'premium'])) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Server not found 0x00002']));
    } elseif (!valid_url($target) || strpos($target, 'https://ngl.link/') !== 0 || substr_count($target, 'https://ngl.link/') > 1) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Liên kết Ngl.Link sai định dạng, ví dụ: https://ngl.link/username']));
    } elseif (in_array($target, $blacklist)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: '.$target.' đang nằm trong danh sách đen, không thể gửi yêu cầu spam vào link này.']));
    } elseif (in_array($server, ['luxury', 'premium'])) {
        if (!$plans->TD('tengoi', $taikhoan)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Server này chỉ dành cho các gói thành viên VIP!']));
        }
    }
    exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã gửi yêu cầu attack Ngl.Link!', 'target' => $target, 'server' => $server, 'question' => $question, 'count' => $type[$server]]));
}
if (isset($payload['action']) && $payload['action'] === 'user-generator-subdomain') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } else {
        $subdomain = THANHDIEU(strtolower($payload['subdomain']));
        $suffix = THANHDIEU($payload['suffix']);
        $record_type = 'A';
        $servers_ip = '123.45.67.89';
        $goat_domain = $subdomain.'.'.$suffix;
        foreach (['scam', 'fake', 'bill', 'fakebill', 'luadao', 'cac', 'lon', 'sex'] as $keyword) {
            similar_text($subdomain, $keyword, $percent);
            if ($percent > 70) {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể tạo vì tên miền '.$subdomain.' có dấu hiệu vi phạm pháp luật, hoặc không tuân thủ tiêu chuẩn cộng đồng.']));
            }
        }
        if (has_repeated_patterns($subdomain)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể tạo vì tên miền '.$subdomain.' không đủ tuân thủ các tiêu chí tên miền hợp lệ.']));
        }
        if (preg_match('/\s/', $subdomain) || !preg_match('/^[a-zA-Z-]+$/', $subdomain)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập tên miền hợp lệ!']));
        } elseif (!in_array($suffix, ['cloudruler.site', 'wusteam.xyz', 'spinextra.online'])) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Hậu tố không hợp lệ!']));
        }
        if (strlen($subdomain) >= 16) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tên miền không được quá dài!']));
        }
        // $set_zone_id = $list_zone_ids[$subdomain] ?? null;
        $set_zone_id = ZoneId($goat_domain);
        if (!$set_zone_id) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi tên miền phụ này không hợp lệ.']));
        }
        $vtd = $thanhdieudb->prepare("SELECT COUNT(*) FROM ws_subdomain WHERE ten_mien = ? AND hauto = ?");
        $vtd->bind_param("ss", $subdomain, $suffix);
        $vtd->execute();
        $vtd->bind_result($count);
        $vtd->fetch();
        $vtd->close();
        if ($count > 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tên miền đã tồn tại trên hệ thống, vui lòng sử dụng tên miền khác!']));
        }
        $WT = $thanhdieudb->query("SELECT COUNT(*) FROM ws_subdomain WHERE username = '$taikhoan' AND trangthai = 'active'");
        $limit_domain = $WT->fetch_row()[0];
        $WT->free();
        if ($limit_domain >= ($plans->TD('tengoi', $taikhoan) ? 5 : 2)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tài khoản của bạn chỉ có thể tạo tối đa 2 tên miền phụ, bạn có thể tạo đến 5 tên miền phụ nếu bạn đã có gói thành viên VIP!']));
        }
        $create_domain = create($goat_domain, $record_type, $servers_ip);
        $vtd = $thanhdieudb->prepare("INSERT INTO ws_subdomain (username, ten_mien, hauto, loai, gia_tri, trangthai) VALUES (?, ?, ?, ?, ?,'active')");
        $vtd->bind_param("sssss", $taikhoan, $subdomain, $suffix, $record_type, $servers_ip);
        if ($create_domain['success'] && $vtd->execute()) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Tạo tên miền phụ '.$goat_domain.' thành công!']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => $create_domain['errors'][0]['message'] ?? 'Tạo tên miền phụ thất bại!']));
        }
    }
} elseif (isset($payload['action']) && $payload['action'] === 'user-edit-subdomain') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($ip, $TD)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    } else {
        $subdomain = THANHDIEU($payload['subdomain']);
        $domain_id = THANHDIEU($payload['domain_id']);
        $new_ip = THANHDIEU(trim($payload['ip']));
        $suffix = THANHDIEU($payload['suffix']);
        $record_type = THANHDIEU($payload['type']);
        if (!filter_var($new_ip, FILTER_VALIDATE_IP)) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập địa chỉ bản ghi dns hợp lệ!']));
        } elseif ($record_type !== 'A') {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Kiểu bản ghi không hợp lệ!']));
        }
        $set_zone_id = ZoneId($subdomain);
        if (!$set_zone_id) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi tên miền phụ này không hợp lệ.']));
        }
        $check1 = $thanhdieudb->prepare("SELECT * FROM ws_subdomain WHERE hauto = ? AND username = ?");
        $check1->bind_param("ss", $suffix, $taikhoan);
        $check1->execute();
        $wt = $check1->get_result();
        if ($wt->num_rows === 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Unauthorized operation (Subdomain)']));
        }
        $check2 = $thanhdieudb->prepare("SELECT domain_id FROM ws_subdomain WHERE domain_id = ? AND username = ?");
        $check2->bind_param("ss", $domain_id, $taikhoan);
        $check2->execute();
        $wt = $check2->get_result();
        if ($wt->num_rows === 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Unauthorized operation (Domain ID)']));
        }
        $edit_domain = edit($subdomain, $new_ip, $record_type);
        $vtd = $thanhdieudb->prepare("UPDATE ws_subdomain SET gia_tri = ?, ngaycapnhat = ? WHERE domain_id = ?");
        $vtd->bind_param("sss", $new_ip, $time, $domain_id);
        if ($edit_domain['success'] && $vtd->execute()) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã cập nhật thành công!']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => $edit_domain['errors'][0]['message'] ?? 'Cập nhật tên miền thất bại!']));
        }
    }
} elseif (isset($payload['action']) && $payload['action'] === 'user-delete-subdomain') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } else {
        $subdomain = THANHDIEU($payload['subdomain']);
        $domain_id = THANHDIEU($payload['domain_id']);
        $suffix = THANHDIEU($payload['suffix']);
        $set_zone_id = ZoneId($subdomain);
        if (!$set_zone_id) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi tên miền phụ này không hợp lệ.']));
        }
        $check1 = $thanhdieudb->prepare("SELECT * FROM ws_subdomain WHERE hauto = ? AND username = ?");
        $check1->bind_param("ss", $suffix, $taikhoan);
        $check1->execute();
        $wt = $check1->get_result();
        if ($wt->num_rows === 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Unauthorized operation (Subdomain)']));
        }
        $check2 = $thanhdieudb->prepare("SELECT domain_id FROM ws_subdomain WHERE domain_id = ? AND username = ?");
        $check2->bind_param("ss", $domain_id, $taikhoan);
        $check2->execute();
        $wt = $check2->get_result();
        if ($wt->num_rows === 0) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'ERROR: Unauthorized operation (Domain ID)']));
        }
        $delete_domain = deleter($subdomain);
        $vtd = $thanhdieudb->prepare("DELETE FROM ws_subdomain WHERE domain_id = ?");
        $vtd->bind_param("i", $domain_id);
        if ($delete_domain['success'] && $vtd->execute()) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Xoá tên miền thành công!']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => $delete_domain['errors'][0]['message'] ?? 'Xoá tên miền thất bại!']));
        }
    }
}
if (isset($payload['action']) && $payload['action'] === 'thue-app-bank-ao') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($taikhoan, $TD, 2)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    if ($payload['gia'] == 1) {
        $giatien = 1400000;
        $tg = '1 Tuần';
    } elseif ($payload['gia'] == 2) {
        $giatien = 2200000;
        $tg = '1 Tháng';
    } else {
        $giatien = 2200000;
        $tg = '1 Tháng';
    }
    if ($payload['nh'] === 'MB Bank Priority') {
        $giatien = 3000000;
    }
    $sdt = $payload['sdt'];
    $mk = $payload['mk'];
    $stk = $payload['stk'];
    $nh = $payload['nh'];
    $tb = $payload['tb'];
    $sotien = FormatNumber::PREG($payload['sotien']);
    $otp = $payload['otp'];
    $lh = preg_replace('/https:\/\/t\.me\/|t\.me\/|@/', '', $payload['lh']);
    if ($user['sodu'] < $giatien) {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => 'Số dư trong tài khoản của bạn không đủ '.FormatNumber::TD($giatien).'đ để thuê app '.$nh.', vui lòng nạp thêm tiền vào tài khoản.'
        ]));
    }
    $sodu_moi = $user['sodu'] - $giatien;
    $vtd = $thanhdieudb->prepare("UPDATE users SET sodu = ?, tongtieu = tongtieu + ? WHERE username = ?");
    $vtd->bind_param('iis', $sodu_moi, $giatien, $taikhoan);
    $content = "====[NEW ORDER BANK ẢO]====\n";
    $content .= "[+] Số Điện Thoại: $sdt\n";
    $content .= "[+] Mật Khẩu: ".$mk."\n";
    $content .= "[+] Số Tài Khoản: $stk\n";
    $content .= "[+] Ngân Hàng: $nh\n";
    $content .= "[+] Số Tiền Trong APP: ".FormatNumber::TD($sotien)."đ\n";
    $content .= "[+] Mã OTP: $otp\n";
    $content .= "[+] Thời Gian Thuê: $tg\n";
    $content .= "[+] Thiết Bị: $tb\n";
    $content .= "========[INFO USER]========\n";
    $content .= "[👦] User ID: ".$user['user_id']."\n";
    $content .= "[💲] Giá Thuê: ".FormatNumber::TD($giatien)."đ\n";
    $content .= "[👉] Telegram: @$lh\n";
    $content .= "[🔴] Trạng Thái: Chờ Xử Lý\n";
    $content .= "[⏰] Thời Gian: ".FormatTime::TD($time,1)."\n";
    $content .= "=========================\n";
    $msg = urlencode($content);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, BOT_API."/bot".BOT_TOKEN."/sendMessage?chat_id=".CHAT_ID."&text=".urlencode($msg));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã thanh toán thành công APP '.$nh.' ảo, thông tin của bạn sẽ được chúng tôi kích hoạt không quá 2-10 giờ.']));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Đã xảy ra lỗi khi cố gắng khi thực hiện thao tác này, vui lòng kiểm tra lại!']));
    }
}

if (isset($payload['action']) && $payload['action'] === 'user-deposit-step-send') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    }

    $stk = $payload['stk'] ?? null;
    $method = $payload['method'] ?? null;
    $holder = $payload['holder'] ?? null;
    $amount = FormatNumber::PREG($payload['amount']);

    if ($amount < $TD->Setting('min-nap')) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nạp tối thiểu ' . FormatNumber::TD($TD->Setting('min-nap')) . 'đ']));
    }
    if (empty($method) || empty($holder) || empty($stk)) {
        $check = $thanhdieudb->prepare("SELECT stk, nganhang, chutaikhoan FROM ws_transfer WHERE kieubank = 'tudong' LIMIT 1");
        $check->execute();
        $ooo = $check->get_result();
        if ($ooo->num_rows > 0) {
            $row = $ooo->fetch_assoc();
            $stk = $stk ?: $row['stk'];
            $method = $method ?: $row['nganhang'];
            $holder = $holder ?: $row['chutaikhoan'];
        } else {
            $check = $thanhdieudb->prepare("SELECT stk, nganhang, chutaikhoan FROM ws_transfer WHERE kieubank = 'thucong' LIMIT 1");
            $check->execute();
            $ooo = $check->get_result();
            if ($ooo->num_rows > 0) {
                $row = $ooo->fetch_assoc();
                $stk = $stk ?: $row['stk'];
                $method = $method ?: $row['nganhang'];
                $holder = $holder ?: $row['chutaikhoan'];
            } else {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Có vẻ quản trị viên chưa cấu hình nạp tiền ngân hàng, vui lòng liên hệ đến quản trị viện.']));
            }
        }
    }
    $vtd = $thanhdieudb->prepare("SELECT * FROM ws_transfer WHERE stk = ? AND nganhang = ? AND chutaikhoan = ?");
    $vtd->bind_param("sss", $stk, $method, $holder);
    $vtd->execute();
    $w = $vtd->get_result();
    if ($w->num_rows > 0) {
        $transfer = $w->fetch_assoc();
        $session_deposit = $_SESSION["session_deposit"] = true;
        $redirect = '/nap-tien/' . $taikhoan . '/transfer?token=' . $wtSecurity->encrypt($session_deposit . '|' . $stk . '|' . $method . '|' . $holder . '|' . $amount . '|' . WsRandomString::TD2(12, 3) . '|' . $taikhoan);
        exit(JSON_FORMATTER([
            'status' => 200,
            'msg' => 'Đang tạo hoá đơn vui lòng đợi...',
            'redirect' => $redirect,
            'timeout' => rand(500,1200),
        ]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Phát hiện admin chưa cấu hình nạp tiền.']));
    }
}
if (isset($payload['action']) && $payload['action'] === 'delete-history-fakebill') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    }
    $fakebill_id = intval($payload['fakebill_id']);
    $result = $thanhdieudb->query("SELECT COUNT(*) AS count FROM ws_history_fakebill WHERE fakebill_id = $fakebill_id");
    $check_bill = $result->fetch_assoc();
    if ($check_bill['count'] == 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Không tìm thấy bill để xoá."]));
    }
    $check_user = $thanhdieudb->query("SELECT COUNT(*) AS count FROM ws_history_fakebill WHERE fakebill_id = $fakebill_id AND username = '".$thanhdieudb->real_escape_string($taikhoan)."'")->fetch_assoc();

    if ($check_user['count'] == 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Bạn không có quyền xóa bill này."]));
    }
    $remove = $thanhdieudb->query("DELETE FROM ws_history_fakebill WHERE fakebill_id = $fakebill_id");
    if ($remove) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá lịch sử bill này thành công."]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi xoá lịch sử bill này."]));
    }
}
if (isset($payload['action']) && $payload['action'] == 'order-product') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($taikhoan, $TD, 2)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    $product_id = $payload['product-id'];
    $vtd = $thanhdieudb->query("SELECT giatien, download_url, trangthai FROM ws_products WHERE id = '$product_id'");
    if ($vtd->num_rows == 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Ôi là trời!!! Đơn hàng này hiện đã biến mất tiêu rồi hihi.']));
     }
    $w = $vtd->fetch_assoc();
    $gia_ban = $w['giatien'] ?? null;
    // $download_url = $w['download_url'] ?? null;
    if ($w['trangthai'] == 0) { 
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể thanh toán vì đơn hàng này không còn khả dụng.']));
    }
    if ($user['sodu'] < $gia_ban) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số dư không đủ '.FormatNumber::TD($gia_ban).'đ'.' để thanh toán đơn hàng này!']));
    }
    if ($thanhdieudb->query("SELECT * FROM ws_history_products WHERE product_id = '$product_id' AND taikhoan = '$taikhoan'")->num_rows > 0) {
    exit(JSON_FORMATTER(['status' => -1, 'msg' => ucwords($user['username']).' ơi!, bạn đã mua đơn hàng này rồi mà, không cần phải mua lại nữa đâu bạn nhé!']));
    }
    $sodu_moi = $user['sodu'] - $gia_ban;
    $tongtieu = $user['tongtieu'] + $gia_ban;
    $update->update("UPDATE users SET sodu = '$sodu_moi', tongtieu = '$tongtieu' WHERE username = '$taikhoan'");
    $into->wusteam('insert', 'ws_history_products', ['product_id' => $product_id, 'taikhoan' => $taikhoan, 'giamua' => $gia_ban, 'magiaodich' => bin2hex(random_bytes(5))]);
    $into->wusteam('insert', 'ws_logs', ['username' => $user['username'], 'content' => 'thanh toán đơn hàng #'.$product_id.' với giá '.FormatNumber::TD($gia_ban).'đ', 'action' => 'Thanh Toán Đơn Hàng']);
    exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Thanh toán thành công đơn hàng: #'.$product_id.' để tải về hãy vào mục Lịch Sử Của Tôi -> Lịch Sử Mua Hàng']));  
    }
    if (isset($payload['action']) && $payload['action'] == 'download-product') {
        if ($SSC->check()) {
            exit(JSON_FORMATTER(['status' => -1,'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
        }
        $product_id = intval($payload['product-id']);
        $vtd = $thanhdieudb->prepare("SELECT p.download_url, p.trangthai
        FROM ws_history_products h 
        LEFT JOIN ws_products p ON h.product_id = p.id 
        WHERE h.product_id = ? AND h.taikhoan = ?
        LIMIT 1");
        $vtd->bind_param("is", $product_id, $taikhoan);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $w = $OoO->fetch_assoc()) {
            if ($w['trangthai'] != 1) {
                exit(JSON_FORMATTER([
                    'status' => -1,
                    'msg' => 'Tải xuống không thành công vì đơn hàng này không còn khả dụng.'
                ]));
            } elseif (!empty($w['download_url'])) {
                exit(JSON_FORMATTER([
                    'status' => 200,
                    'msg' => 'Đang lấy liên kết tải xuống...',
                    // 'url' => 'https://api.thanhdieu.com/goto?url='.$w['download_url'],
                    'url' => $w['download_url'],
                    'timeout' => rand(1000, 1500),
                ]));
            } else {
                exit(JSON_FORMATTER([
                    'status' => -1,
                    'msg' => 'Đơn hàng này không còn tồn tại hoặc bị xóa, vui lòng liên hệ hỗ trợ.'
                ]));
            }
        } else {
            exit(JSON_FORMATTER([
                'status' => -1,
                'msg' => 'Không thể tải xuống vì bạn chưa mua đơn hàng này.'
            ]));
        }
    }
    if (isset($payload['action']) && $payload['action'] === 'history-purchase') {
        if ($SSC->check()) {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để có thể xem lịch sử mua hàng!']));
        }
        $OoO = $thanhdieudb->query("SELECT h.*, p.tieude, p.download_url, p.trangthai, p.slug
            FROM ws_history_products h
            LEFT JOIN ws_products p ON h.product_id = p.id
            WHERE h.taikhoan = '$taikhoan'
            ORDER BY h.ngaymua DESC");
        $data = [];
        if ($OoO && $OoO->num_rows > 0) {
            while ($item = $OoO->fetch_assoc()) {
                if ($item['trangthai'] == 0 || empty($item['tieude']) || empty($item['download_url'])) {
                    continue;
                }
                $data[] = [
                    $item['product_id'],
                    $item['magiaodich'],
                    $cut->characters($item['tieude'], isMobile() ? 35 : 55),
                    FormatNumber::TD($item['giamua']) . 'đ',
                    FormatTime::TD($item['ngaymua'], 1),
                    'https://'.$domain.'/details/'.$item['slug'],
                    'hash:' . hash('sha256', $item['download_url'])
                ];
            }
        }
        if (count($data) === 0) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Chưa có lịch sử mua hàng']));
        }
    
        $res = ['recordsTotal' => count($data), 'data' => $data];
        exit(JSON_FORMATTER(['status' => 200, 'msg' => $res]));
    }
    
    
/// END PAYLOAD    
});
  if (isset($_POST['action']) && $_POST['action'] === 'user-make-qr-cccd') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng đăng nhập để sử dụng dịch vụ!']));
    } elseif (!TDSpamChecker::TD($taikhoan, $TD, 2)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
    }
    $socccd = FormatNumber::PREG($_POST['so-cccd']);
    $gioitinh = $socccd[3];
    $hovaten = $_POST['hovaten'];
    $noithuongtru = $_POST['noithuongtru'];
    $ngaysinh = FormatNumber::PREG(DateTime::createFromFormat('Y-m-d', $_POST['ngaysinh'])->format('d/m/Y'));
    $ngaycap = FormatNumber::PREG(DateTime::createFromFormat('Y-m-d', $_POST['ngaycap'])->format('d/m/Y'));
    $data = sprintf('%s|%s|%s|%s|%s|%s|%s', $socccd, WsRandomString::Number(9), $hovaten, $ngaysinh, $gioitinh, $noithuongtru, $ngaycap);
    $size = '255x255';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.qrserver.com/v1/create-qr-code/?data=".urlencode($data)."&size=$size");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: image/png',
    ]);
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode === 200) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Tạo thành công mã QR CCCD!', 'img' => 'data:image/png;base64,'.base64_encode($res)]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể tạo mã QR ngay lúc này!']));
    }
}