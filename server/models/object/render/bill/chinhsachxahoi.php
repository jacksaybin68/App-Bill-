<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'chinhsachxahoi') {
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
    $themeDisplay ='light';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/chinhsachxahoi.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
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

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = (int) $fontsize;
        $x = (int) $x_tcb;
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
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
    function alignRight($image, $text, $font, $size, $color, $y,$nhan=109)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; // Điều chỉnh giá trị 10 tùy theo lề phải mong muốn
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
    canchinhgiua($image, 60, 1015, imagecolorallocate($image, 198, 18, 89), $fontPath.'/chinhsachxahoi/itc-avant-garde-gothic-lt-demi.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    alignRight($image, substr($stkgui, 0, 2) . '************' . substr($stkgui, -2), $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', 39, imagecolorallocate($image, 52, 53, 55), 1190);
    alignRight($image, $stknhan, $fontPath.'/chinhsachxahoi/itc-avant-garde-gothic-lt-demi.ttf', 38, imagecolorallocate($image, 52, 53, 55), 1390);
    alignRight($image, $tennguoigui, $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', 38, imagecolorallocate($image, 52, 53, 55), 1265);
    alignRight($image, $tennguoinhan, $fontPath.'/chinhsachxahoi/itc-avant-garde-gothic-lt-demi.ttf', 35, imagecolorallocate($image, 52, 53, 55), 1465);
    canletrai($image, 40, 95, imagecolorallocate($image, 255, 255,255), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 105);
    canchinhphai_noidung($image, 38, 1740, imagecolorallocate($image, 52, 53, 55), $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', $noidungchuyen,1.6);
    canchinhphai_nh($image, 38, 1535, imagecolorallocate($image, 52, 53, 55), $fontPath.'/SVN-Gilroy/SVN-Gilroy Bold.woff', $nganhangnhan, 1.6);
    alignRight($image, $thoigianchuyen, $fontPath.'/chinhsachxahoi/itc-avant-garde-gothic-lt-demi.ttf', 38, imagecolorallocate($image, 52, 53, 55), 2000);
    alignRight($image, $sogiaodich, $fontPath.'/chinhsachxahoi/ITC Avant Garde Gothic Book Regular.otf', 38, imagecolorallocate($image, 52, 53, 55), 2215);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Chính sách xã hội','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
