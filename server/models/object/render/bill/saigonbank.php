<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'saigonbank') {
    $sogiaodich = $_POST["sogiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $tennguoigui = $_POST["tennguoigui"];
    $stknhan = FormatNumber::PREG($_POST["stknhan"]);
    $stkgui = FormatNumber::PREG($_POST["stkgui"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/saigonbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    function removeVietnameseTones($str) {
    $unicode = array(
        'a'=>'á|à|ạ|ả|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'e'=>'é|è|ẹ|ẻ|ẽ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ị|ỉ|ĩ',
        'o'=>'ó|ò|ọ|ỏ|õ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỵ|ỷ|ỹ',
        'd'=>'đ',
        'A'=>'Á|À|Ạ|Ả|Ã|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'E'=>'É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ị|Ỉ|Ĩ',
        'O'=>'Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỵ|Ỷ|Ỹ',
        'D'=>'Đ'
    );
    
    foreach ($unicode as $nonUnicode=>$uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    return $str;
    }
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($customX === null) ? ($imageWidth - $textWidth - 96) : $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
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
    function renderBankIcon($image, $iconBankPath, $x, $y, $width = 50, $height = 50) {
    if (!file_exists($iconBankPath)) {
        return $image;
    }

    $icon = @imagecreatefrompng($iconBankPath);
    if (!$icon) return $image;
    imagesavealpha($icon, true);
    imagealphablending($icon, true);
    $resizedIcon = imagecreatetruecolor($width, $height);
    imagealphablending($resizedIcon, false);
    imagesavealpha($resizedIcon, true);
    $transparent = imagecolorallocatealpha($resizedIcon, 0, 0, 0, 127);
    imagefilledrectangle($resizedIcon, 0, 0, $width, $height, $transparent);

    imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $width, $height, imagesx($icon), imagesy($icon));
    imagedestroy($icon);
    imagecopy($image, $resizedIcon, (int)$x, (int)$y, 0, 0, $width, $height);
    imagedestroy($resizedIcon);

    return $image;
}
    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
    {
        $fontSize = (int) $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = (int) (($imageWidth - $textWidth) / 2);
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    if (!function_exists('CanLeTrai1')) {
    function CanLeTrai1($image, $fontsize, $y, $textColor, $font, $text, $x) {
        $x = (int) $x;
        $y = (int) $y;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }
}
    function canchinhphai_nh($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 1)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 15) {
            $maxCharsPerLine = 20; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 98;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2;
    imagettftext($image, $fontSize, 0, (int)$x, (int)$y, $textColor, $font, $text);
    }
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 20)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 24) {
            $maxCharsPerLine = 25; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 98;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    $textBox = imagettfbbox(46, 0, $fontPath.'acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen));
    $vndBox = imagettfbbox(26, 0, $fontPath.'acb/NivaSmallCaps-Light.ttf', 'VND');
    $textWidth = $textBox[2] - $textBox[0];
    $vndWidth = $vndBox[2] - $vndBox[0];
    $xAmount = round((imagesx($image) - $textWidth - $vndWidth - 15) / 2);
    $yAmount = 525;
    $xVND = round($xAmount + $textWidth + 15);
    $yVND = 495;
    function alignRight($image, $text, $font, $size, $color, $y,$nhan=73)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; // Điều chỉnh giá trị 10 tùy theo lề phải mong muốn
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
   
    cangiua($image, 57, 950, imagecolorallocate($image, 255, 255, 255), $fontPath.'Inter/Inter-Medium.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    $image = renderBankIcon($image, $iconBankPath, 142, 1305, 55, 55);
    $words2s = explode(' ', $tennguoinhan);
    if (count($words2s) <= 1) {
    } else {
    $middleIndex = ceil(count($words2s) / 2);
    $firstPart = implode(' ', array_slice($words2s, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words2s, $middleIndex));
     }
$words = explode(' ', $noidungchuyen);  
if (count($words) <= 0) {
    alignRight($image, $noidungchuyen, $fontPath.'/Inter/Inter-Medium.ttf', 34, imagecolorallocate($image, 66, 66, 66), 1315);
} else {
    $maxWordsInPart = 4;
    $firstPart = implode(' ', array_slice($words, 0, $maxWordsInPart));  
    $secondPart = implode(' ', array_slice($words, $maxWordsInPart, $maxWordsInPart)); 
    if (count($words) > $maxWordsInPart * 2) {
        $thirdPart = implode(' ', array_slice($words, $maxWordsInPart * 2));  
        alignRight($image, $thirdPart, $fontPath.'/Inter/Inter-Medium.ttf', 30, imagecolorallocate($image, 13, 42, 70), 1665);
    }
    alignRight($image, $firstPart, $fontPath.'/Inter/Inter-Medium.ttf', 36, imagecolorallocate($image, 66, 67, 69), 2000);
    alignRight($image, $secondPart, $fontPath.'/Inter/Inter-Medium.ttf', 36, imagecolorallocate($image, 66, 67, 69), 2060);
}
CanLeTrai1($image, 37, 1177, imagecolorallocate($image, 66, 67, 69), $fontPath . '/Inter/Inter-Medium.ttf', $stkgui, 265);
CanLeTrai1($image, 37, 1350, imagecolorallocate($image, 66, 67, 69), $fontPath . '/Inter/Inter-Medium.ttf', $stknhan, 265);
$name = $tennguoinhan; 
$name_processed = strtoupper(removeVietnameseTones($name));
$maxWidth = 600;
$bbox = imagettfbbox(37, 0, $fontPath . '/Inter/Inter-Medium.ttf', $name_processed);
$textWidth = $bbox[2] - $bbox[0];

if ($textWidth > $maxWidth) {
    $words = explode(' ', $name_processed);
    $line1 = '';
    $line2 = '';
    foreach ($words as $word) {
        $tempLine = trim($line1 . ' ' . $word);
        $tempBbox = imagettfbbox(37, 0, $fontPath . '/Inter/Inter-Medium.ttf', $tempLine);
        $tempWidth = $tempBbox[2] - $tempBbox[0];

        if ($tempWidth <= $maxWidth) {
            $line1 = $tempLine; 
        } else {
            $line2 .= ' ' . $word; 
        }
    }

    CanLeTrai1($image, 34, 1400, imagecolorallocate($image, 66, 67, 69), $fontPath . '/Inter/Inter-Medium.ttf', trim($line1), 265);
    CanLeTrai1($image, 34, 1455, imagecolorallocate($image, 66, 67, 69), $fontPath . '/Inter/Inter-Medium.ttf', trim($line2), 265);
} else {
    CanLeTrai1($image, 37, 1420, imagecolorallocate($image, 66, 67, 69), $fontPath . '/Inter/Inter-Medium.ttf', $name_processed, 265);
}
        if (count($words2s) <= 411) {
        } else {
            alignRight($image, $nganhangnhan, $fontPath.'SVN-Gilroy/SVN-Gilroy Medium.woff', 30, imagecolorallocate($image, 13, 42, 70), 1250);
        }
    alignRight($image, $thoigianchuyen, $fontPath.'/Inter/Inter-Medium.ttf', 38, imagecolorallocate($image, 66, 67, 69), 2255);
    alignRight($image, $sogiaodich, $fontPath.'/Inter/Inter-Medium.ttf', 36, imagecolorallocate($image, 66, 67, 69), 1800);   
    alignRight($image, $nganhangnhan, $fontPath.'/Inter/Inter-Medium.ttf', 36, imagecolorallocate($image, 66, 67, 69), 1600);
    imagettftext($image, 43, 0, 138, 99, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    // canchinhphai_noidung($image, 38, 1740, imagecolorallocate($image, 52, 53, 55), $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', $noidungchuyen,1.6);
    // canchinhphai_nh($image, 38, 1535, imagecolorallocate($image, 52, 53, 55), $fontPath.'/SVN-Gilroy/SVN-Gilroy Bold.woff', $nganhangnhan, 1.6);
    // alignRight($image, $thoigianchuyen, $fontPath.'/chinhsachxahoi/itc-avant-garde-gothic-lt-demi.ttf', 38, imagecolorallocate($image, 52, 53, 55), 2000);
    // alignRight($image, $sogiaodich, $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', 38, imagecolorallocate($image, 52, 53, 55), 2215);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Saigonbank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}