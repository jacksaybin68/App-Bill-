<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'bvbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stkchuyen = $_POST["stkchuyen"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/bvbank.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefromjpeg($phoiBank);
    if ($nganhangnhan === 'vtd') {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,15,122,400,);
    }    
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
        $fontSize = $fontsize;
        $lines = explode('<br>', $text);
        $lineHeight = $fontsize * 1.7;
        foreach ($lines as $i => $line) {
            $yOffset = $y + ($i * $lineHeight);
            imagettftext($image, $fontSize, 0, $x_tcb, $yOffset, $textColor, $font, $line);
        }
    }
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen($text);
            if ($textLength > 20) {
                $maxCharsPerLine = 28; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 55;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    canchinhphai($image, 42, 980, imagecolorallocate($image, 94,167,65), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan, 47);
    canchinhphai($image, 42, 1230, imagecolorallocate($image, 94,167,65), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND', 48);
    canchinhphai($image, 40, 1130, imagecolorallocate($image,94,167,65), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $nganhangnhan, 44);
    canchinhphai($image, 40, 1030, imagecolorallocate($image,255, 255, 255), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stk, 50);
    canchinhphai($image, 40, 876, imagecolorallocate($image,255, 255, 255), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stkchuyen, 47);
    canchinhphai_noidung($image, 33, 1449, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $noidungchuyen, 1.9);
    canchinhphai($image, 38, 767, imagecolorallocate($image,255, 255, 255), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigianchuyen, 50);
    canchinhphai($image, 32, 659, imagecolorallocate($image, 255,255,blue: 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $magiaodich, 50);
    canbentren($image, 120, 94, imagecolorallocate($image,0, 0, 0), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 45);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['BVBank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
