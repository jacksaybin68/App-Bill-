<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'vibbank') {
    $sogiaodich = $_POST["sogiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stknhan = FormatNumber::PREG($_POST["stknhan"]);
    $stkgui = FormatNumber::PREG($_POST["stkgui"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/vib.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
        $x = ($customX === null) ? ($imageWidth - $textWidth - 62) : $customX;
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
            $x = $imageWidth - $textWidth - 62;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 20) {
            $maxCharsPerLine = 25; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 62;
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
    canchinhphai2($image, 33, 1188, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', FormatNumber::TD($sotienchuyen, 2));
    canchinhphai($image, 34, 1340, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $tennguoinhan);
    canchinhphai($image, 33, 1550, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $stknhan);
    canchinhphai($image, 34, 2377, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $stkgui);
    canchinhphai($image, 33, 2221, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $sogiaodich);
    canchinhphai($image, 33, 2065, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $thoigianchuyen);
    canletrai($image, 40, 107, imagecolorallocate($image, 0, 0, 0), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 155);
    canchinhphai_noidung($image, 33, 1862, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $noidungchuyen,1.5);
    canchinhphai_nh($image, 34, 1705, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf', $nganhangnhan);
    canchinhphai2($image, 34, 2537, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-Medium.ttf','0');

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['VibBank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
