<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'seabank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $stkgui = $_POST["stkgui"];
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $stknhan = $_POST["stknhan"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $tongtien = FormatNumber::PREG($_POST["tongtien"]);
    $noidungchuyen = $_POST["noidungchuyen"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/seabank.jpg';
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
                $x = $imageWidth - $textWidth - 52;
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
    canbentren($image, 170, 113, imagecolorallocate($image,0,0,0), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 38);
    canchinhphai($image, 36, 759, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $magiaodich, 52);
    canchinhphai($image, 38, 895, imagecolorallocate($image,20,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $stkgui, 52);
    canchinhphai($image, 40, 1035, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $tennguoichuyen, 52);
    canchinhphai($image, 36, 1169, imagecolorallocate($image,0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $nganhangnhan, 52);
    canchinhphai($image, 38, 1300, imagecolorallocate($image,0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $stknhan, 52);
    canchinhphai($image, 40, 1435, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $tennguoinhan, 47);
    canchinhphai($image, 40, 1566, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', FormatNumber::TD($sotienchuyen, 2).' VND', 52);
    canchinhphai($image, 40, 1900, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', FormatNumber::TD($tongtien, 2).' VND', 52);
    canchinhphai_noidung($image, 33, 2030, imagecolorallocate($image, 0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $noidungchuyen, 1.9);
    canchinhphai($image, 36, 2167, imagecolorallocate($image,0,0,0), $fontPath.'common/Roboto/Roboto-Medium.ttf', $thoigianchuyen, 52);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Seabank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
