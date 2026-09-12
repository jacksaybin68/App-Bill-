<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'pgbank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stknhan = $_POST["stknhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/pgbank.png';
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
    function canchinhphai2($image, $fontsize, $y, $textColor, $font, $text, $customX = 62)
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
    canchinhphai2($image, 15, 687, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $thoigianchuyen);
    canchinhphai2($image, 15, 375, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $magiaodich);
    canchinhphai2($image, 15, 450, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $tennguoichuyen);
    canchinhphai2($image, 15, 555, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $stknhan);
    canchinhphai2($image, 15, 512, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $tennguoinhan);
    canchinhphai2($image, 15, 600, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $nganhangnhan);
    canchinhphai2($image, 15, 642, imagecolorallocate($image, 50, 50, 50), $fontPath.'common/Roboto/Roboto-Medium.ttf', $noidungchuyen);

    canchinhphai2($image, 17, 800, imagecolorallocate($image, 47, 88, 148), $fontPath.'common/Roboto/Roboto-Medium.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');

    imagettftext($image, 20, 0, 75, 50, imagecolorallocate($image, 255, 255, 255), $fontPath. 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['PGBank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
