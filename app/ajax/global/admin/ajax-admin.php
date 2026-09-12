<?php
/**
 * Kết Nối CSDL
 */
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
/**
 * @author Vương Thanh Diệu
 */
header('Content-Type: application/json');

if (isset($_POST['ws-settings'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $set_name = $_POST['site-name'];
    $set_author = $_POST['site-author'];
    $set_geetest = $_POST['site-id-geetest'];
    $set_geetest2 = $_POST['site-key-geetest'];
    $set_loader = $_POST['site-loader'];
    $set_log = $_POST['site-log'];
    $set_footer = $_POST['site-footer'];
    $set_blacklist = $_POST['site-blacklist'];
    if (in_array($ip, explode("|", $set_blacklist))) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Không thể tự cấm IP chính mình!"]));
    }
    if (substr($set_blacklist, -1) === '|' || strpos($set_blacklist, '||') !== false) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Phân tách ip không đúng cú pháp!"]));
    }
    $vtd = $thanhdieudb->prepare("UPDATE `ws_settings` SET `name-site` = ?, `author` = ?, `id-geetest` = ?, `key-geetest` = ?, `loader` = ?,`is-log`=?, `footer` = ?, `black-ip` = ?");
    if ($vtd) {
        $vtd->bind_param("ssssiiss", $set_name, $set_author, $set_geetest, $set_geetest2, $set_loader, $set_log, $set_footer, $set_blacklist);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => "Thông tin đã được cập nhật!"])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => $vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['modal'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $modal = $_POST['modal'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `is-modal` = ?")) {
        $vtd->bind_param("i", $modal);
        if ($vtd->execute()) {
            $msg = $modal ? 'Đã bật hiện thông báo modal' : 'Đã tắt ẩn thông báo modal';
            exit(JSON_FORMATTER((["status" => 200, "msg" => $msg])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['ws-setting-info'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $site_title = $_POST['site-title'];
    $site_desc = $_POST['site-desc'];
    $site_keywords = $_POST['site-keywords'];
    $site_navbar_logo = $_POST['site-navbar-logo'];
    $site_images = $_POST['site-images'];
    $site_zalo = $_POST['site-zalo'];
    $site_telegram = $_POST['site-telegram'];
    $site_boxchat = $_POST['site-boxchat'];
    if (isset($_FILES['site-logo']) && $_FILES['site-logo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['site-logo']['tmp_name'];
        $fileName = $_FILES['site-logo']['name'];
        $fileSize = $_FILES['site-logo']['size'];
        $fileType = $_FILES['site-logo']['type'];
        $allowed = ['jpg', 'jpeg', 'png'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($extension, $allowed)) {
            $new_file_name = 'logo.png';
            $file_dir = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/';
            $dest_path = $file_dir.$new_file_name;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $site_logo = '/'.__IMG__.'/'.$new_file_name;
            } else {
                exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi tải lên ảnh."])));
            }
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Favicon chỉ hỗ trợ định dạng jpg, png."])));
        }
    } else {
        $site_logo = $thanhdieudb->query("SELECT `favicon` FROM `ws_settings` LIMIT 1")->fetch_assoc()['favicon'];

    }
    $vtd = $thanhdieudb->prepare("UPDATE `ws_settings` SET `title` = ?, `description` = ?, `keywords` = ?, `favicon` = ?, `navbar-logo` = ?, `og:image` = ?, `zalo` = ?, `telegram` = ?, `boxchat` = ?");
    if ($vtd) {
        $vtd->bind_param("sssssssss", $site_title, $site_desc, $site_keywords, $site_logo, $site_navbar_logo, $site_images, $site_zalo, $site_telegram, $site_boxchat);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => "Thông tin đã được cập nhật!"])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => $vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['anti_spam'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $anti_spam = $_POST['anti_spam'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `anti-spam` = ?")) {
        $vtd->bind_param("i", $anti_spam);
        if ($vtd->execute()) {
            $msg = $anti_spam ? 'Đã bật chế độ chống spam' : 'Đã tắt chế độ chống spam';
            exit(JSON_FORMATTER((["status" => 200, "msg" => $msg])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['filterkw'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $filterkw = $_POST['filterkw'];
    $content = $_POST['content'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `filter-kw` = ?")) {
        $vtd->bind_param("s", $content);
        if ($TD->Setting('anti-spam') != 1) {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Vui lòng bật chế độ Spam Blocker trước."])));
        }
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => "Bộ lọc từ khoá đã được kích hoạt"])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['reset_key_aes'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $key = bin2hex(openssl_random_pseudo_bytes(12));
    $vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `key-aes` = ?");
    if ($vtd) {
        $vtd->bind_param("s", $key);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => 'Đã làm mới lại mã hoá cấp cao!'])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Không thể làm mới mã hoá cấp cao."])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi làm mới mã hoá cấp cao."])));
    }
}
if (isset($_POST['maintenance'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $maintenance = $_POST['maintenance'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `bao-tri` = ?")) {
        $vtd->bind_param("i", $maintenance);
        if ($vtd->execute()) {
            $msg = $maintenance == 1 ? 'Website đã được bảo trì' : 'Tắt bảo trì website thành công';
            exit(JSON_FORMATTER((["status" => 200, "msg" => $msg])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['fuckdevtools'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $fuckdevtools = $_POST['fuckdevtools'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `fuck-devtools` = ?")) {
        $vtd->bind_param("i", $fuckdevtools);
        if ($vtd->execute()) {
            $msg = $fuckdevtools == 1 ? 'Đã kích hoạt anti-devtool' : 'Đã tắt anti-devtool';
            exit(JSON_FORMATTER((["status" => 200, "msg" => $msg])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['https'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $https = $_POST['https'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `https` = ?")) {
        $vtd->bind_param("i", $https);
        if ($vtd->execute()) {
            $msg = $https == 1 ? 'Đã bật giao thức HTTP và SSL' : 'Đã tắt giao thức HTTP và SSL';
            exit(JSON_FORMATTER((["status" => 200, "msg" => $msg])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['limit_account'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $limit_account = $_POST['limit_account'];
    if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `limit-account` = ?")) {
        $vtd->bind_param("i", $limit_account);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => 'Đã cập nhật giới hạn tạo tài khoản.'])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Thất bại: ".$vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi cập nhật thông tin."])));
    }
}
if (isset($_POST['ws-setting-callback'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $cuphap = trim($_POST['cu-phap']);
    $minnap = FormatNumber::PREG($_POST['min-nap']);
    $khuyenmai = FormatNumber::PREG($_POST['khuyen-mai']);
    $partner_id = FormatNumber::PREG($_POST['partner-id']);
    $partner_key = trim($_POST['partner-key']);
    $mail_user = trim($_POST['mail-user']);
    $mail_pass = $_POST['mail-pass'];
    if (!empty($mail_user) && !valid_email($mail_user)) {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "Tài khoản Gmail không đúng định dạng!"
        ]));
    }
    if (strpos($cuphap, ' ') !== false) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Nội dung nạp không được chứa dấu cách."])));
    } else {
        if ($vtd = $thanhdieudb->prepare("UPDATE ws_settings SET `cuphap-naptien`=?, `min-nap`=?, `khuyen-mai`=?, `partner-id`=?,`partner-key`=?,`mail-user`=?,`mail-pass`=?")) {
            $vtd->bind_param("siiisss", $cuphap, $minnap, $khuyenmai, $partner_id, $partner_key, $mail_user, $mail_pass);
            if ($vtd->execute()) {
                exit(JSON_FORMATTER((["status" => 200, "msg" => 'Cấu hình đã được cập nhật.'])));
            } else {
                exit(JSON_FORMATTER((["status" => -1, "msg" => "Cập nhật thất bại: <br/>".$vtd->error])));
            }
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi xảy ra khi cập nhật cấu hình."])));
        }
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'add-transfer-bank') {
    CheckRankAndSession::TD($user, $taikhoan);
    $nganhang = $_POST["ten-ngan-hang"];
    $chutaikhoan = $_POST["chu-tai-khoan"];
    $stk = $_POST["stk"];
    $kieubank = $_POST["kieubank"];
    $callback = $_POST["callback"];
    if (!empty($callback) && !valid_url($callback)) {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "API Bank không đúng định dạng!"
        ]));
    }
    $file_db = $_SERVER['DOCUMENT_ROOT'].'/server/models/object/admin/list.bank.db';
    if (file_exists($file_db)) {
        $data = file_get_contents($file_db);
        $banks = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            exit(JSON_FORMATTER([
                'status' => -1,
                'msg' => "Lỗi: ".json_last_error_msg()
            ]));
        }
    } else {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "Không thể tìm thấy file list.bank.db!"
        ]));
    }
    foreach ($banks['data'] as $bank) {
        if ($bank['shortName'] === $nganhang) {
            $logo = $bank['logo'] ?? '';
            break;
        }
    }
    if ($nganhang === "Momo") {
        $logo = 'https://i.imgur.com/AbtjoUD.png';
    }

    if (($vtd = $thanhdieudb->prepare("SELECT 1 FROM ws_transfer WHERE stk = ?")) && $vtd->bind_param("s", $stk) && $vtd->execute() && $vtd->get_result()->num_rows > 0) {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "Số tài khoản hoặc ngân hàng đã tồn tại!"
        ]));
    } else {
        $vtd = $thanhdieudb->prepare("INSERT INTO ws_transfer (stk, chutaikhoan, nganhang, logo, callback, kieubank) VALUES (?, ?, ?, ?, ?, ?)");
        $vtd->bind_param("ssssss", $stk, $chutaikhoan, $nganhang, $logo, $callback, $kieubank);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER([
                'status' => 200,
                'msg' => "Thêm ngân hàng mới thành công!"
            ]));
        } else {
            exit(JSON_FORMATTER([
                'status' => -1,
                'msg' => "Không thể thêm ngân hàng chuyển khoản."
            ]));
        }
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'edit-transfer-bank') {
    CheckRankAndSession::TD($user, $taikhoan);
    $transfer_id = $_POST["transfer-id"];
    $nganhang = $_POST["ten-ngan-hang"];
    $chutaikhoan = $_POST["chu-tai-khoan"];
    $stk = $_POST["stk"];
    $kieubank = $_POST["kieubank"];
    $callback = $_POST["callback"];
    if (!empty($callback) && !valid_url($callback)) {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "API Bank không đúng định dạng!"
        ]));
    } elseif($kieubank==='thucong') {
        $callback = NULL;
    }
    $file_db = $_SERVER['DOCUMENT_ROOT'].'/models/object/admin/list.bank.db';
    if (file_exists($file_db)) {
        $data = file_get_contents($file_db);
        $banks = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            exit(JSON_FORMATTER([
                'status' => -1,
                'msg' => "Lỗi: ".json_last_error_msg()
            ]));
        }
    } else {
        exit(JSON_FORMATTER([
            'status' => -1,
            'msg' => "Không thể tìm thấy file list.bank.db!"
        ]));
    }
    foreach ($banks['data'] as $bank) {
        if ($bank['shortName'] === $nganhang) {
            $logo = $bank['logo'] ?? '';
            break;
        }
    }
    if ($nganhang === "Momo") {
        $logo = 'https://i.imgur.com/AbtjoUD.png';
    }

    if ($vtd = $thanhdieudb->prepare("UPDATE ws_transfer SET `nganhang`=?, `logo`=?, `chutaikhoan`=?,`stk`=? ,`kieubank`=? ,`callback`=? WHERE `transfer_id`='$transfer_id'")) {
            $vtd->bind_param("ssssss", $nganhang, $logo, $chutaikhoan, $stk, $kieubank,$callback);
            if ($vtd->execute()) {
                exit(JSON_FORMATTER((["status" => 200, "msg" => 'Thông tin đã được cập nhật.'])));
            } else {
                exit(JSON_FORMATTER((["status" => -1, "msg" => "Cập nhật thất bại: <br/>".$vtd->error])));
            }
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi xảy ra khi cập nhật ngân hàng."])));
        }
    }
if (isset($_POST['truncate_transfer'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    if ($thanhdieudb->query("SELECT COUNT(*) FROM ws_transfer")->fetch_row()[0] > 0) {
        if ($thanhdieudb->query("TRUNCATE TABLE ws_transfer") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả ngân hàng.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xóa ngân hàng thất bại.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['delete_transfer'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $transfer_id = intval($_POST['transfer_id']);
    $remove = $thanhdieudb->query("DELETE FROM ws_transfer WHERE transfer_id = $transfer_id");
    if ($remove) {
        $thanhdieudb->query('SET @row_number := 0;');
        $thanhdieudb->query('UPDATE ws_transfer SET transfer_id = (@row_number := @row_number + 1) ORDER BY transfer_id;');
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá ngân hàng thành công."]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi xoá ngân hàng này."]));
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'ws-create-newfeeds') {
    CheckRankAndSession::TD($user, $taikhoan);
    $title = ucwords(strtolower($_POST["title"]));
    $noidung = $_POST["content"];
    $loai = $_POST["loai"];
    if (empty($title) || empty($noidung)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng điền đầy đủ thông tin vào các mục có chứa (*).']));
    } elseif (mb_strlen($title, 'UTF-8') > 30) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tiêu đề quá dài, vui lòng nhập tiêu đề ngắn hơn!']));
    }
    $vtd = $thanhdieudb->prepare("INSERT INTO ws_newfeeds (tieude, noidung, loai, trangthai) VALUES (?, ?, ?, 1)");
    $vtd->bind_param("sss", $title, $noidung, $loai);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER([
            'status' => 200,
            'msg' => 'Đăng bảng tin lên trang chủ thành công!',
        ]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi: '.$vtd->error]));
    }
}
if (isset($_POST['action']) && $_POST['action'] == 're-edit-newfeed') {
    CheckRankAndSession::TD($user, $taikhoan);
    $title = ucwords(strtolower($_POST["title"]));
    $noidung = $_POST["content"];
    $newfeeds_id = $_POST["newfeeds-id"];
    if (empty($title) || empty($noidung)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng điền đầy đủ thông tin vào các mục có chứa (*).']));
    } elseif (mb_strlen($title, 'UTF-8') > 30) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tiêu đề quá dài, vui lòng nhập tiêu đề ngắn hơn!']));
    }
    $vtd = $thanhdieudb->prepare("UPDATE ws_newfeeds SET tieude=?, noidung=?, loai=? WHERE newfeeds_id=?");
    $vtd->bind_param("sssi", $title, $noidung, $loai, $newfeeds_id);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Bảng tin đã được cập nhật!"]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi cập nhật bảng tin!"]));
    }
}
if (isset($_POST['delete_newfeeds'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $id_newfeeds = intval($_POST['id_newfeeds']);
    $remove = $thanhdieudb->query("DELETE FROM ws_newfeeds WHERE newfeeds_id = $id_newfeeds");
    if ($remove) {
    exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá bảng tin thành công."]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi xoá bảng tin này."]));
    }
}
if (isset($_POST['hide_newfeeds'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $id_newfeeds = intval($_POST['id_newfeeds']);
    $rs = $thanhdieudb->query("SELECT trangthai FROM ws_newfeeds WHERE newfeeds_id = $id_newfeeds");
    $w = $rs->fetch_assoc();
    if ($w['trangthai'] == 1) {
        $thanhdieudb->query("UPDATE ws_newfeeds SET trangthai = 0 WHERE newfeeds_id = $id_newfeeds");
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Đã ẩn bảng tin này.", 'new_status' => 0]));
    } else {
        $thanhdieudb->query("UPDATE ws_newfeeds SET trangthai = 1 WHERE newfeeds_id = $id_newfeeds");
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Đã hiển thị lại bảng tin này.", 'new_status' => 1]));
    }
}
if (isset($_POST['editUsers'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $user_id = $_POST["user_id"];
    $email = $_POST["editEmail"];
    $tongnap = FormatNumber::PREG($_POST["editTongNap"]);
    $tongtieu = FormatNumber::PREG($_POST["editTongTieu"]);
    $sodu = FormatNumber::PREG($_POST["editSoDu"]);
    $quyenhan = $_POST["editQuyenHan"];
    if (!is_numeric($tongnap) || !is_numeric($tongtieu)) {
        $TDTV = ['status' => -1, 'msg' => "Tổng Nạp hoặc Tổng Tiêu phải là số, và có thể chứa dấu chấm!"];
    } elseif (!is_numeric($sodu)) {
        $TDTV = ['status' => -1, 'msg' => "Số Dư phải là số!"];
    } else {
        $vtd = $thanhdieudb->prepare("UPDATE users SET  `email`=?, `tongnap`=?, `tongtieu`=?, `sodu`=?, `rank`=? WHERE user_id=?");
        $vtd->bind_param("siiisi", $email, $tongnap, $tongtieu, $sodu, $quyenhan, $user_id);
        if ($vtd->execute()) {
            $TDTV = ['status' => 200, 'msg' => "Thông tin chỉnh sửa đã được cập nhật!"];
        } else {
            $TDTV = ['status' => -1, 'msg' => "Lỗi khi cập nhật thông tin!"];
        }
    }
    exit(JSON_FORMATTER($TDTV));
}
if (isset($_POST['action']) && $_POST['action'] === 'cong-tien') {
    CheckRankAndSession::TD($user, $taikhoan);
    $sotien = KhuyenMai(FormatNumber::PREG($_POST["sotien"]));
    $tk = mysqli_real_escape_string($thanhdieudb, $_POST["taikhoan"]);
    $who = ($taikhoan === $tk) ? 'chính mình' : $tk;
    if (!is_numeric($sotien)) {
        $TDTV = ['status' => -1, 'msg' => "Số tiền phải là số, và có thể chứa dấu chấm!"];
    } elseif ($sotien == 0) {
        $TDTV = ['status' => -1, 'msg' => "Không thể cộng vì số tiền cần cộng quá thấp!"];
    } else {
        $OoO = mysqli_query($thanhdieudb, "SELECT sodu FROM `users` WHERE `username`='$tk'");
        if ($OoO && mysqli_num_rows($OoO) > 0) {
            $td = mysqli_fetch_assoc($OoO);
            $sodu_hientai = $td['sodu'];
            $sodu_moi = $sodu_hientai + $sotien;
            if (mysqli_query($thanhdieudb, "UPDATE `users` SET `sodu`= '$sodu_moi', `tongnap`=`tongnap` + '$sotien' WHERE `username`='$tk'")) {
                $thanhdieudb->query("INSERT INTO `ws_logs` SET 
                `username`='$taikhoan', 
                `content`= 'cộng ".FormatNumber::TD($sotien)."đ vào tài khoản $who', 
                `action`='Cộng Tiền'");
                $thanhdieudb->query("INSERT INTO `ws_logs` SET 
                `username`='$tk', 
                `content`= 'nạp tiền ".FormatNumber::TD($sotien)."đ vào tài khoản', 
                `action`='Nạp Tiền'");
                $thanhdieudb->query("INSERT INTO `ws_history_bank` SET `loai`='Admin Cộng Tay', `magiaodich`='WT" .WsRandomString::Number(7). "', `sotien`='".preg_replace('/\D/', '', $sotien)."', `noidung`='Nạp tiền vào tài khoản', `username`='$tk',`trangthai`='thanhcong'");
                $TDTV = ['status' => 200, 'msg' => "Đã cộng ".FormatNumber::TD($sotien)."đ cho tài khoản $who!"];
            } else {
                $TDTV = ['status' => -1, 'msg' => "Lỗi khi cập nhật thông tin!"];
            }
        } else {
            $TDTV = ['status' => -1, 'msg' => "Made by -> ThanhDieuTv!"];
        }
    }
    exit(JSON_FORMATTER($TDTV));
} elseif (isset($_POST['action']) && $_POST['action'] === 'tru-tien') {
    CheckRankAndSession::TD($user, $taikhoan);
    $tk = mysqli_real_escape_string($thanhdieudb, $_POST["taikhoan"]);
    $sotien = FormatNumber::PREG($_POST["sotien"]);
    $who = ($taikhoan == $tk) ? 'chính mình' : $tk;
    if (!is_numeric($sotien)) {
        $TDTV = ['status' => -1, 'msg' => "Tổng Nạp hoặc Tổng Tiêu phải là số, và có thể chứa dấu chấm!!"];
    } elseif ($sotien == 0) {
        $TDTV = ['status' => -1, 'msg' => "Không thể trừ vì số tiền cần trừ quá thấp!"];
    } else {
        $OoO = mysqli_query($thanhdieudb, "SELECT `sodu` FROM `users` WHERE `username`='$taikhoan'");
        if ($OoO && mysqli_num_rows($OoO) > 0) {
            $td = mysqli_fetch_assoc($OoO);
            $sodu_hientai = $td['sodu'];
            $sodu_moi = $sodu_hientai - $sotien;
            if ($sodu_moi >= 0) {
                if (mysqli_query($thanhdieudb, "UPDATE `users` SET `sodu`= '$sodu_moi', `tongtieu`=`tongtieu` + '$sotien' WHERE `username`='$tk'")) {
                    $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='trừ ".FormatNumber::TD($sotien)."đ khỏi tài khoản $who', `action`='Trừ Tiền'");
                    $TDTV = [
                        'status' => 200,
                        'msg' => "Đã trừ ".FormatNumber::TD($sotien)."đ khỏi tài khoản $who!!"];
                } else {
                    $TDTV = ['status' => -1, 'msg' => "Lỗi khi thực hiện trừ tiền!"];
                }
            } else {
                $TDTV = ['status' => -1, 'msg' => "Số dư trong tài khoản này không đủ để thực hiện trừ tiền!"];
            }
        } else {
            $TDTV = ['status' => -1, 'msg' => "Made by -> ThanhDieuTv!"];
        }
    }
    exit(JSON_FORMATTER($TDTV));
}
if (isset($_POST['TaoThanhVien'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $username = mysqli_real_escape_string($thanhdieudb, trim($_POST['username']));
    $password = mysqli_real_escape_string($thanhdieudb, trim($_POST['password']));
    $quyenhan = mysqli_real_escape_string($thanhdieudb, trim($_POST['quyenhan']));
    $access_key = mysqli_real_escape_string($thanhdieudb, trim($_POST['access_key']));
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tên tài khoản không được chứa kí tự đặc biệt.']));
    } elseif (mb_strlen($username,'UTF-8') < 4 || mb_strlen($password,'UTF-8') < 5) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tên tài khoản hoặc mật khẩu quá ngắn!']));
    } elseif (mb_strlen($username,'UTF-8') > 22 || mb_strlen($password,'UTF-8') > 27) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tài khoản hoặc mật khẩu quá dài!']));
    } elseif ($username == $password) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không được lấy tên tài khoản làm mật khẩu!']));
    } elseif (!CheckPassword($password)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Mật khẩu không đúng định dạng!']));
    } elseif (($check_username = $thanhdieudb->query("SELECT COUNT(*) as count FROM users WHERE username='$username'")) && $check_username->fetch_assoc()['count'] > 0) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tên tài khoản đã tồn tại,<br/>hãy chọn tên tài khoản khác!']));
    } else {
        if ($thanhdieudb->query("INSERT INTO users (username, password, rank, access_key) VALUES ('$username', '".password_hash($password, PASSWORD_BCRYPT, ['cost' => 7])."','$quyenhan','$access_key')") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Tạo thành viên mới thành công!']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Đã xảy ra lỗi khi tạo thành viên mới!']));
        }
    }
}
if (isset($_POST['delete_users'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $username = $thanhdieudb->real_escape_string($_POST['username']);
    if ($username === $taikhoan) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể tự xoá chính mình!']));
    }
    $tables = 
    [
        'users' => 'username',
        'ws_logs' => 'username',
        'ws_otpmailler' => 'username',
        'ws_plans' => 'taikhoan',
        'ws_spamsms' => 'taikhoan',
        'ws_subdomain' => 'username',
        'ws_limitbill' => 'taikhoan',
        'ws_history_bank' => 'username', 
        'ws_history_card' => 'username',
        'ws_freebill' => 'taikhoan'
    ];
    try 
    {
        $thanhdieudb->query("SET FOREIGN_KEY_CHECKS = 0");
        foreach ($tables as $table => $column) 
        {
            $check_column = $thanhdieudb->query("SHOW COLUMNS FROM $table LIKE '$column'");
            if ($check_column && $check_column->num_rows > 0) 
            {
                $check = $thanhdieudb->query("SELECT 1 FROM $table WHERE $column = '$username' LIMIT 1");
                if ($check && $check->num_rows > 0) {
                    $thanhdieudb->query("DELETE FROM $table WHERE $column = '$username'");
                }
            }
        }
        $thanhdieudb->query("SET FOREIGN_KEY_CHECKS = 1");
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa thành viên thành công.']));
    } catch (Exception $e) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi: '.$e->getMessage()]));
    }
}
if (isset($_POST['truncate_logs'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    if ($thanhdieudb->query("SELECT COUNT(*) FROM ws_logs")->fetch_row()[0] > 0) {
        if ($thanhdieudb->query("TRUNCATE TABLE ws_logs") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả nhật ký.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xóa nhật ký thất bại.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['banned_users'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $user_id = $_POST['user_id'];
    if ($user['user_id'] == $user_id) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể tự khoá bản thân!']));
    }
    $vtd = $thanhdieudb->prepare("SELECT banned,username FROM users WHERE user_id = ?");
    $vtd->bind_param("i", $user_id);
    $vtd->execute();
    $vtd->bind_result($banned, $username);
    $vtd->fetch();
    $vtd->close();
    if ($banned !== null) {
        $new_status = $banned == 0 ? 1 : 0;
        $log_content = $new_status == 0 ? 'mở khoá' : 'đình chỉ';
        $action_content = $new_status == 0 ? 'Mở Khoá Tài Khoản' : 'Đình Chỉ Tài Khoản';
        $update = $thanhdieudb->prepare("UPDATE users SET banned = ? WHERE user_id = ?");
        $update->bind_param("ii", $new_status, $user_id);
        $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='đã $log_content tài khoản $username', `action`='$action_content'");
        exit(JSON_FORMATTER(['status' => $update->execute(), 'new_status' => $new_status]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Người dùng không tồn tại.']));
    }
}
if (isset($_POST['backup_sql'])) {
    CheckRankAndSession::TD($user, $taikhoan);
    $backupdb = $thanhdieudb->query("UPDATE ws_settings SET backupdb = 1");
    if ($backupdb) {
        $backupFile = BACKUP_DATABASE($thanhdieudb);
        if ($backupFile) {
            $folder = $_SERVER['DOCUMENT_ROOT'].'/public/cache/backup/';
            $files = glob($folder.'/backup-*.sql');
            foreach ($files as $file) {
                $parts = explode('-', basename($file));
                $timestamp = (int)end($parts);
                if ($timestamp < time()) {
                    unlink($file);
                }
            }
            $thanhdieudb->query("UPDATE ws_settings SET backupdb = 0");
            exit(JSON_FORMATTER(['status' => 200, 'msg'=> 'Đã xuất file backup!', 'file' => '/public/cache/backup/'.$backupFile]));
        } else {
            $thanhdieudb->query("UPDATE ws_settings SET backupdb = 0");
            exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi backup dữ liệu."]));
        }
    } 
}
if (isset($_POST['action']) && $_POST['action'] === 'create-new-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $tengoi = ucwords(strtolower($_POST["tengoi"]));
    $giagoi = FormatNumber::PREG($_POST["giagoi"]);
    $hansudung = FormatNumber::PREG($_POST["hsd"]);
    $solantao = FormatNumber::PREG($_POST["limit-bill"]);    
    if (in_array('',  [trim($tengoi),$giagoi,$hansudung,$solantao,], true)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng không bỏ trống trường nào."]));
    }
    elseif ($hansudung == 0) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Hạn sử dụng phải tối thiểu trên 1 ngày."])));
    } elseif (mb_strlen($tengoi, 'UTF-8') > 20) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Tên gói tối thiểu 17 kí tự."])));
    }
    $OoO = $thanhdieudb->query("SELECT COUNT(*) as total FROM `ws_dsgoi`");
    $row = $OoO->fetch_assoc();
    if ($row['total'] >= 12) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Không thể tạo thêm gói, tối đa là 12 gói."])));
    }
    $vtd = $thanhdieudb->prepare("INSERT INTO `ws_dsgoi` (`tengoi`, `giagoi`, `gioihanbill`, `hansudung`) VALUES (?, ?, ?, ?)");
    if ($vtd) {
        $vtd->bind_param("siii", $tengoi, $giagoi, $solantao, $hansudung);
        if ($vtd->execute()) {
            exit(JSON_FORMATTER((["status" => 200, "msg" => "Đã tạo thành công gói: ".$tengoi."!"])));
        } else {
            exit(JSON_FORMATTER((["status" => -1, "msg" => $vtd->error])));
        }
    } else {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Có lỗi khi tạo gói vip."])));
    }
}
if (isset($_POST['action']) && $_POST['action'] == 're-edit-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $plan_id = FormatNumber::PREG($_POST['goi_id']);
    $tengoi = ucwords(strtolower($_POST["tengoi"]));
    $giagoi = FormatNumber::PREG($_POST["giagoi"]);
    $hansudung = FormatNumber::PREG($_POST["hsd"]);
    $solantao = FormatNumber::PREG($_POST["limit-bill"]);
    if (in_array('',  [trim($tengoi),$giagoi,$hansudung,$solantao,], true)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng không bỏ trống trường nào."]));
    }
    elseif ($hansudung == 0) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Hạn sử dụng phải tối thiểu trên 1 ngày."])));
    } elseif (mb_strlen($tengoi, 'UTF-8') > 20) {
        exit(JSON_FORMATTER((["status" => -1, "msg" => "Tên gói tối thiểu 17 kí tự."])));
    }
    $vtd = $thanhdieudb->prepare("UPDATE ws_dsgoi SET tengoi=?, giagoi=?, hansudung=?, gioihanbill=? WHERE dsgoi_id=?");
    $vtd->bind_param("siiii", $tengoi, $giagoi, $hansudung, $solantao, $plan_id);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Gói ".$tengoi." đã được cập nhật!"]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi cập nhật gói ".$tengoi."!"]));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'lock-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $plan_id = FormatNumber::PREG($_POST['goi_id']);
    $vtd = $thanhdieudb->prepare("SELECT trangthai FROM ws_dsgoi WHERE dsgoi_id = ?");
    $vtd->bind_param("i", $plan_id);
    $vtd->execute();
    $vtd->bind_result($trangthai);
    $vtd->fetch();
    $vtd->close();
    if ($trangthai !== null) {
        $new_status = $trangthai == 0 ? 1 : 0;
        $action_content = $new_status == 0 ? 'Mở Khoá Tài Khoản' : 'Đình Chỉ Tài Khoản';
        $update = $thanhdieudb->prepare("UPDATE ws_dsgoi SET trangthai = ? WHERE dsgoi_id = ?");
        $update->bind_param("ii", $new_status, $plan_id);
        $update->execute();
        exit(JSON_FORMATTER(['status' => 200, 'new_status' => $new_status]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Gói không tồn tại.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'truncate-plans') {
    CheckRankAndSession::TD($user, $taikhoan);
    if ($thanhdieudb->query("SELECT COUNT(*) FROM ws_dsgoi")->fetch_row()[0] > 0) {
        if ($thanhdieudb->query("TRUNCATE TABLE ws_dsgoi") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả các gói hiện có.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xóa tất cả gói không thành công.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'truncate-history-plans') {
    CheckRankAndSession::TD($user, $taikhoan);
    if ($thanhdieudb->query("SELECT COUNT(*) FROM ws_plans")->fetch_row()[0] > 0) {
        if ($thanhdieudb->query("TRUNCATE TABLE ws_plans") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả dữ liệu lịch sử mua.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xóa tất cả lịch sử mua không thành công.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'set-limit-bill') {
    CheckRankAndSession::TD($user, $taikhoan);
    $limitbill = FormatNumber::PREG($_POST['limit-bill']);
    $giataobill = FormatNumber::PREG($_POST['giataobill'] ?? 0);
    if ($giataobill >= 1000000) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số tiền tạo quá lớn!']));
    } else {
    $bill = $thanhdieudb->prepare("UPDATE ws_settings SET `limit-bill` = ?, `giataobill` = ?");
    $bill->bind_param("ii", $limitbill,$giataobill);
    $bill->execute();
    if ($bill->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã cập nhật limit & giá tạo bill.']));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Cập nhật không thành công.']));
    }
 }
}
if (isset($_POST['action']) && $_POST['action'] === 'set-time-bill') {
    CheckRankAndSession::TD($user, $taikhoan);
    $timebill = FormatNumber::PREG($_POST['time-bill']);
    if ($timebill >= 24) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Thời gian không được vượt quá 24 tiếng!']));
    } else {
    $bill = $thanhdieudb->prepare("UPDATE ws_settings SET `time-bill` = ?");
    $bill->bind_param("i",$timebill);
    $bill->execute();
    if ($bill->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã cập nhật thời gian tạo bill.']));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Cập nhật không thành công.']));
    }
 }
}
if (isset($_POST['action']) && $_POST['action'] === 'truncate-all-bill') {
    CheckRankAndSession::TD($user, $taikhoan);
    if ($thanhdieudb->query("SELECT COUNT(*) FROM ws_history_fakebill")->fetch_row()[0] > 0) {
        if ($thanhdieudb->query("TRUNCATE TABLE ws_history_fakebill") === TRUE) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả lịch sử tạo bill.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Xóa lịch sử tạo bill thất bại.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'delete-bill') {
    CheckRankAndSession::TD($user, $taikhoan);
    $bill_id = intval($_POST['bill_id']);
    $remove = $thanhdieudb->query("DELETE FROM ws_history_fakebill WHERE fakebill_id = $bill_id");
    if ($remove) {
    exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá lịch sử bill này thành công."]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi xoá lịch sử bill này."]));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'banned-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $plan_id = $_POST['plan_id'];
    $vtd = $thanhdieudb->prepare("SELECT trangthai FROM ws_plans WHERE plans_id = ?");
    $vtd->bind_param("i", $plan_id);
    $vtd->execute();
    $vtd->bind_result($trangthai);
    $vtd->fetch();
    $vtd->close();
    if ($trangthai !== null) {
        $new_status = ($trangthai == 2) ? 1 : 2;
        $update = $thanhdieudb->prepare("UPDATE ws_plans SET trangthai = ? WHERE plans_id = ?");
        $update->bind_param("ii", $new_status, $plan_id);
        if ($update->execute()) {
            exit(JSON_FORMATTER(['status' => 200, 'new_status' => $new_status]));
        } else {
            exit(JSON_FORMATTER(['status' => 500, 'msg' => 'Lỗi khi cập nhật trạng thái.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không tìm thấy gói.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'delete-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $plan_id = intval($_POST['plan_id']);
    $remove = $thanhdieudb->query("DELETE FROM ws_plans WHERE plans_id = $plan_id");
    if ($remove) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá gói thành công."]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Lỗi khi xoá gói này."]));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'auto-delete-bill') {
    CheckRankAndSession::TD($user, $taikhoan);
    $values = FormatNumber::PREG($_POST['values']??0);
    if ($values >= 8) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Số ngày quá lớn!']));
    } else {
    $set = $thanhdieudb->prepare("UPDATE ws_settings SET `auto-delete` = ?");
    $set->bind_param("i", $values);
    $set->execute();
    if ($set->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Sẽ tự động xoá lịch sử sau: '.$values. ' ngày.']));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Cập nhật không thành công.']));
    }
 }
}
if (isset($_POST['action']) && $_POST['action'] === 'set-expiration-all-plan') {
    CheckRankAndSession::TD($user, $taikhoan);
    $hansudung = FormatNumber::PREG($_POST["hansudung"]);
    if (empty($hansudung)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng nhập số ngày cần cộng!']));
    }
    $vtd = $thanhdieudb->prepare("UPDATE ws_plans SET ngayhethan = DATE_ADD(ngayhethan, INTERVAL ? DAY) WHERE trangthai = '1'");
    if ($vtd) {
        $vtd->bind_param("i", $hansudung);
        $vtd->execute();
        if ($vtd->affected_rows > 0) {
            $thanhdieudb->query("INSERT INTO `ws_logs` SET 
            `username`='$taikhoan', 
            `content`= 'đã cộng ".$hansudung." ngày cho tất cả các gói', 
            `action`='Cộng Hạn Sử Dụng'");
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã cộng '.$hansudung.' ngày cho tất cả các<br> gói thành viên VIP còn hạn sử dụng.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Hiện chưa có gói nào <br>còn hạn sử dụng để cộng.']));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Có lỗi khi cộng hạn sử dụng.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'ws-create-products') {
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Phiên đã hết hạn vui lòng đăng nhập lại!"]));
    }
    $title = $_POST["title"];
    $noidung = FilterTags($_POST["content"]);
    $slug = TDSlug($_POST["slug"]);
    $giatien = FormatNumber::PREG($_POST["giatien"]) ?: 0;
    // $phanloai = $_POST["phanloai"];
    $download_url = $_POST["download-url"];
    // $privacy = $_POST["post_privacy"];
    $upload_img = [];
    $uploadedFiles = [];
    $error = false;

    if (empty($title) || empty($download_url)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Vui lòng điền đầy đủ thông tin vào các mục có chứa (*).']));
    } elseif (mb_strlen($title, 'UTF-8') > 120) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tiêu đề quá dài, vui lòng nhập tiêu đề ngắn hơn!']));
    } elseif (!valid_url($download_url)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Liên kết tải xuống không hợp lệ, vui lòng nhập đúng định dạng URL.']));
    } elseif (empty($slug)) {
        $slug = TDSlug($title);
        $vtd = $thanhdieudb->prepare("SELECT COUNT(*) AS count FROM ws_products WHERE slug=?");
        $vtd->bind_param("s", $slug);
        $vtd->execute();
        $result = $vtd->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $slug .= '.'.random_int(1000, 99999);
        }
        $vtd->close();
    }
    if (isset($_FILES['anhsanpham'])) {
        foreach ($_FILES['anhsanpham']['tmp_name'] as $key => $tmp_name) {
            $fileInfo = pathinfo($_FILES['anhsanpham']['name'][$key]);
            $extension = strtolower($fileInfo['extension']);
            $fileSize = $_FILES['anhsanpham']['size'][$key];
            if (WsCheckIMG::WsCheckImg($extension)) {
                $sizeCheck = WsCheckIMG::SizeLimit($fileSize,4);
                if ($sizeCheck === true) {
                    $_t = $_SERVER['DOCUMENT_ROOT']."/".__IMG__."/uploads/t/".md5(WsRandomString::Number(10)).'_'.date("Y-m-d").'.'.$extension;
                    $imageHash = md5_file($tmp_name);
                    if (!in_array($imageHash, $uploadedFiles)) {
                        if (move_uploaded_file($_FILES["anhsanpham"]["tmp_name"][$key], $_t)) {
                            $upload_img[] = $_t;
                            $uploadedFiles[] = $imageHash;
                        } else {
                            $error = true;
                            break;
                        }
                    }
                } else {
                    $error = true;
                    exit(JSON_FORMATTER(['status' => -1, 'msg' => $sizeCheck]));
                }
            } else {
                $error = true;
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Định dạng của tệp không hợp lệ. Vui lòng chọn ảnh có định dạng png, jpg, jpeg, webp hoặc gif.']));
            }
        }

        $upload_img_basename = array_map(function ($path) {
            return basename($path);
        }, $upload_img);
        $anhsanpham = implode('|', $upload_img_basename);
        $hinhthunho = $upload_img_basename[0];
        if (!$error) {
            $vtd = $thanhdieudb->prepare("INSERT INTO ws_products (taikhoan, tieude, noidung, hinhthunho, anhsanpham, giatien, slug, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $vtd->bind_param("sssssiss", $taikhoan, $title, $noidung, $hinhthunho, $anhsanpham, $giatien, $slug, $download_url);
            if ($vtd->execute()) {
                exit(JSON_FORMATTER([
                    'status' => 200,
                    'msg' => 'Đã đăng đơn hàng này lên trang thành công!<br/>Xem link: <a target="_blank" href="https://'.$domain.'/details/'.$slug.'">https://'.$domain.'/details/'.$slug. '</a>',
                ]));
            } else {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Lỗi: '.$vtd->error]));
            }
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không có ảnh nào được tải lên, hãy chọn ít nhất 1 ảnh.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] == 're-edit-product') {
    CheckRankAndSession::TD($user, $taikhoan);
    $title = $_POST["tieu-de"];
    $noidung = $_POST["content"];
    $giatien = FormatNumber::PREG($_POST["gia-ban"]) ?: 0;
    $product_id = $_POST["product-id"];
    if (empty($title)) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tiêu đề không được bỏ trống!']));
    } elseif (mb_strlen($title, 'UTF-8') > 120) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Tiêu đề quá dài, vui lòng nhập tiêu đề ngắn hơn!']));
    }
    $vtd = $thanhdieudb->prepare("UPDATE ws_products SET tieude=?, noidung=?, giatien=?, ngaycapnhat=? WHERE id=?");
    $vtd->bind_param("ssisi", $title, $noidung, $giatien, $time, $product_id);
    if ($vtd->execute()) {
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Đơn hàng #".$product_id." đã được cập nhật!"]));
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Có lỗi khi cập nhật đơn hàng #".$product_id."!"]));
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'delete-product') {
    usleep(random_int(400000, 600000));
    CheckRankAndSession::TD($user, $taikhoan);
    $id_product = $_POST['id_product'];
    $vtd = $thanhdieudb->prepare("SELECT * FROM ws_products WHERE id = ?");
    $vtd->bind_param("i", $id_product);
    $vtd->execute();
    $result = $vtd->get_result();
    $product_data = $result->fetch_assoc();
    $vtd->close();
    if (!$product_data) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Đơn hàng không tồn tại."]));
    }
    if (in_array($user['rank'], ['partner', 'leader']) && $product_data['taikhoan'] !== $taikhoan) {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => "Không đủ quyền để xoá đơn hàng này."]));
    }    
    $thumbnail = $product_data['hinhthunho'];
    $images = $product_data['anhsanpham'];
    $thanhdieudb->query("SET FOREIGN_KEY_CHECKS = 0");
    if (!empty($thumbnail)) {
        $thumbnail_path = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/uploads/t/'.$thumbnail;
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }
    }
    if (!empty($images)) {
        $image_list = explode('|', $images);
        foreach ($image_list as $image) {
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/uploads/t/'.trim($image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }
    $thanhdieudb->query("DELETE FROM ws_products WHERE id = $id_product");
    exit(JSON_FORMATTER(['status' => 200, 'msg' => "Xoá sản phẩm thành công."]));
}
if (isset($_POST['action']) && $_POST['action'] == 'discontinued-product') {
    CheckRankAndSession::TD($user, $taikhoan);
    $product_id = intval($_POST['id_product']);
    $rs = $thanhdieudb->query("SELECT trangthai FROM ws_products WHERE id = $product_id");
    $w = $rs->fetch_assoc();
    if ($w['trangthai'] == 1) {
        $thanhdieudb->query("UPDATE ws_products SET trangthai = 0 WHERE id = $product_id");
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Đã ngừng bán đơn hàng này.", 'new_status' => 0]));
    } else {
        $thanhdieudb->query("UPDATE ws_products SET trangthai = 1 WHERE id = $product_id");
        exit(JSON_FORMATTER(['status' => 200, 'msg' => "Đã mở bán lại đơn hàng này.", 'new_status' => 1]));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'truncate-all-product') {
    CheckRankAndSession::TD($user, $taikhoan);
    $oOo = $thanhdieudb->query("SELECT id FROM ws_products");
    if ($oOo && $oOo->num_rows > 0) {
        $all_ids = [];
        while ($row = $oOo->fetch_assoc()) {
            $all_ids[] = $row['id'];
        }
        $errors = 0;
        foreach ($all_ids as $id) {
            $vtd = $thanhdieudb->prepare("DELETE FROM ws_products WHERE id = ?");
            $vtd->bind_param("i", $id);
            if (!$vtd->execute()) {
                $errors++;
            }
        }
        if ($errors === 0) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả đơn hàng.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => "Xoá thất bại một số đơn hàng ($errors lỗi)."]));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'truncate-all-history-product') {
    CheckRankAndSession::TD($user, $taikhoan);
    $oOo = $thanhdieudb->query("SELECT id FROM ws_history_products");
    if ($oOo && $oOo->num_rows > 0) {
        $all_ids = [];
        while ($row = $oOo->fetch_assoc()) {
            $all_ids[] = $row['id'];
        }
        $errors = 0;
        foreach ($all_ids as $id) {
            $vtd = $thanhdieudb->prepare("DELETE FROM ws_history_products WHERE id = ?");
            $vtd->bind_param("i", $id);
            if (!$vtd->execute()) {
                $errors++;
            }
        }
        if ($errors === 0) {
            exit(JSON_FORMATTER(['status' => 200, 'msg' => 'Đã xóa tất cả lịch sử mua hàng.']));
        } else {
            exit(JSON_FORMATTER(['status' => -1, 'msg' => "Xoá thất bại một số dòng lịch sử ($errors lỗi)."]));
        }
    } else {
        exit(JSON_FORMATTER(['status' => -1, 'msg' => 'Không thể xoá vì chưa có dữ liệu.']));
    }
}
