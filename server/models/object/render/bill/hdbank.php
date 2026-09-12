<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'hdbank') {
    $sogiaodich = $_POST["sogiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigianhieuluc = $_POST["thoigianhieuluc"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stknhan = FormatNumber::PREG($_POST["stknhan"]);
    $stkgui = FormatNumber::PREG($_POST["stkgui"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/hdbank.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefromjpeg($phoiBank);
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
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 27) {
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
    canchinhphai($image, 34, 2220, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhphai($image, 34, 1920, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $tennguoinhan);
    canchinhphai($image, 34, 1775, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $stknhan);
    canchinhphai($image, 34, 1628, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $stkgui);
    canchinhphai($image, 34, 1040, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $sogiaodich);
    canchinhphai($image, 34, 1335, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $thoigianhieuluc);
    canchinhphai($image, 34, 1187, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $thoigianchuyen);
    canletrai($image, 39, 85, imagecolorallocate($image, 255, 255,255), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 140);
    canchinhphai_noidung($image, 34, 2480, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $noidungchuyen,1.6);
    canchinhphai_nh($image, 34, 2068, imagecolorallocate($image, 51, 51, 51), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $nganhangnhan);
    canchinhphai($image, 34, 1480, imagecolorallocate($image, 51, 51, 51), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 'Chuyển khoản nhanh 24/7');
    canchinhphai($image, 34, 2365, imagecolorallocate($image, 51, 51, 51), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf','Miễn phí');

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Hdbank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
