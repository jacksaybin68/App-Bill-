<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-acb') {
    $ctk = $_POST["ctk"];
    $tendem = $_POST["tendem"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $diemrewards = FormatNumber::PREG($_POST["diemrewards"]);
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $color_bg = $_POST["color-bg"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi/bill/so-du/acb.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/dark.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function CanLeTrai($image, $text, $font, $size, $color, $y)
    {
        $fixed_left_position = 230;
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    function canchinhphai2($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function CanSoTaiKhoan($image, $text, $font, $size, $color, $y)
    {
        $fixed_left_position = 100;
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    function CanSoDu($image, $text, $font, $size, $color, $vnd_font, $vnd_size, $vnd_color, $y, $x, $name)
    {
        $fixed_left_position = $x;
        $right_padding = 10;
        $image_width = imagesx($image);
        $formatted_text = $text;
        $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;
        if ($text_width + $fixed_left_position + $right_padding > $image_width) {
            $text_left_margin = $image_width - $text_width - $right_padding;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
        $text_width_vnd = $text_width + 5; 
        $vnd_left_margin = $text_left_margin + $text_width_vnd;
        imagettftext($image, $vnd_size, 0, $vnd_left_margin, $y, $vnd_color, $vnd_font, $name);
    }

    function CanThoiGian($image, $text, $font, $size, $color, $y)
    {
        $fixed_left_position = 85;
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    // function canletrai2($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    // {
    //     $fontSize = (int) $fontsize;
    //     $x = (int) $x_tcb;
    //     $y = (int) $y;
    //     imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    // }
    function CheckFullTime($time)
    {
        $hour = DateTime::createFromFormat('Y-m-d H:i:s', $time)->format('H');
        if ($hour >= 3 && $hour < 10) {
            return "Chào buổi sáng";
        } elseif ($hour >= 10 && $hour < 15) {
            return "Chào buổi trưa";
        } elseif ($hour >= 15 && $hour < 17) {
            return "Chào buổi chiều";
        } elseif ($hour >= 17 && $hour <= 23) {
            return "Chào buổi tối";
        } else {
            return "Chào buổi sáng";
        }
    }
    // if (isset($_POST['avatar']) && !empty($_POST['avatar'])) {
    //     $avatar = $_POST['avatar'];
    //     if (preg_match('/^data:image\/(\w+);base64,/', $avatar, $type)) {
    //         $data = substr($avatar, strpos($avatar, ',') + 1);
    //         $type = strtolower($type[1]);
    //         if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
    //             die(JSON_FORMATTER([
    //                 "status" => -1,
    //                 "msg" => "Ảnh đại diện chỉ hỗ trợ các định dạng JPG/PNG/JPEG.",
    //             ]));
    //         }
    //         $data = base64_decode($data);
    //         $size = strlen($data);
    //         if (!WsCheckIMG::SizeLimit($size, 2)) {
    //             die(JSON_FORMATTER([
    //                 "status" => -1,
    //                 "msg" => "Kích thước của ảnh không được vượt quá giới hạn cho phép (2MB).",
    //             ]));
    //         }
    //         $avatar2 = imagecreatefromstring($data);
    //         $width = imagesx($avatar2);
    //         $height = imagesy($avatar2);
    //         $circle_img = imagecreatetruecolor($width, $height);
    //         imagesavealpha($circle_img, true);
    //         $transparent = imagecolorallocatealpha($circle_img, 0, 0, 0, 127);
    //         imagefill($circle_img, 0, 0, $transparent);
    //         $black = imagecolorallocate($circle_img, 0, 0, 0);
    //         imagefilledellipse($circle_img, (int)($width / 2), (int)($height / 2), (int)$width, (int)$height, $black);
    //         imagecopymerge($circle_img, $avatar2, 0, 0, 0, 0, $width, $height, 100);
    //         $avatar_width = 120;
    //         $avatar_height = 120;
    //         $final_image = imagecreatetruecolor($avatar_width, $avatar_height);
    //         imagecopyresampled($final_image, $circle_img, 0, 0, 0, 0, $avatar_width, $avatar_height, $width, $height);
    //         imagecopy($image, $final_image, 40, 189, 0, 0, $avatar_width, $avatar_height);
    //         imagedestroy($avatar2);
    //         imagedestroy($circle_img);
    //         imagedestroy($final_image);

    //     } else {
    //         die(JSON_FORMATTER([
    //             "status" => -1,
    //             "msg" => "Dữ liệu không phải là ảnh hợp lệ.",
    //         ]));
    //     }

    // } else {
    //     die(JSON_FORMATTER([
    //         "status" => -1,
    //         "msg" => "Ảnh đại diện không được bỏ trống!",
    //     ]));
    // }
    $dest_img = imagecreatetruecolor(imagesx($image), imagesy($image));
    imagecopy($dest_img, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
    $rgb_converter = hex2rgb($color_bg);
    $circle_x = 130;
    $circle_y = 228;
    imagefilledellipse($dest_img, $circle_x, $circle_y, 63 * 2, 63 * 2, imagecolorallocate($dest_img, $rgb_converter['r'], $rgb_converter['g'], $rgb_converter['b']));
    $textBox = imagettfbbox(32, 0, $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', $tendem);
    $textWidth = $textBox[2] - $textBox[0];
    $textHeight = $textBox[7] - $textBox[1];
    // $textX = (int) ($circle_x - ($textWidth / 2));
    $textX = $circle_x - 31;
    $textY = $circle_y + 19;
    imagettftext($dest_img, 37, 0, $textX, $textY, imagecolorallocate($image, 252, 252, 250), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', $tendem);
    CanLeTrai($dest_img, CheckFullTime($time), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', 31, imagecolorallocate($dest_img, 51, 64, 77), 210);
    CanLeTrai($dest_img, $ctk, $fontPath . 'vietinbank/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 1, 1, 1), 280);
    CanSoDu($dest_img, FormatNumber::TD($sodu), $fontPath . 'vietinbank/SVN-Gilroy Bold.otf', 40, imagecolorallocate($dest_img, 2, 115, 248), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', 34, imagecolorallocate($dest_img, 2, 113, 248), 528,120,' VND');
    CanSoDu($dest_img, FormatNumber::TD($diemrewards), $fontPath . 'vietinbank/SVN-Gilroy Bold.otf', 40, imagecolorallocate($dest_img, 2, 115, 248), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', 34, imagecolorallocate($dest_img, 2, 113, 248), 528,776,' điểm');
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 37, imagecolorallocate($dest_img, 1, 1, 1), 85);
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['ACB','Số Dư'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}
