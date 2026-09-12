<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'cake') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $gd = FormatNumber::PREG($_POST["gd"]);
    $convertGD = [
        1 => ['themeName' => 'cake-light', 'themeDisplay' => 'dark', 'colorMoney' => '12,28,46', 'colorContent' => '12,28,46'],
        2 => ['themeName' => 'cake-dark', 'themeDisplay' => 'dark', 'colorMoney' => '255,255,255', 'colorContent' => '255,255,255'],
    ];
    $gdData = $convertGD[$gd] ?? [
        'themeName' => 'cake-light',
        'themeDisplay' => 'dark',
        'colorMoney' => '37,231,255',
        'colorContent' => '255,255,255'
    ];
    $themeName = $gdData['themeName'];
    $themeDisplay = $gdData['themeDisplay'];
    list($rMoney, $gMoney, $bMoney) = explode(',', $gdData['colorMoney']);
    list($rContent, $gContent, $bContent) = explode(',', $gdData['colorContent']);
    $noidungchuyen = $_POST["noidungchuyen"];
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.$themeName.'.jpeg';
    $image = imagecreatefromjpeg($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';

    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        if ($customX) {
            $x = $imageWidth - $textWidth - 354;
        } else {
            $x = ($customX == null) ? ($imageWidth - $textWidth - 80) : $customX;
        }
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
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 29) {
            $maxCharsPerLine = 23; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 80;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
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
    canchinhphai($image, 26, 550, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $tennguoichuyen);
    canchinhphai($image, 26, 625, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $tennguoinhan);
    canchinhphai($image, 26, 705, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $nganhangnhan);
    canchinhphai($image, 26, 780, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $stk);
    canchinhgiua($image, 44, 430, imagecolorallocate($image, $rMoney, $gMoney, $bMoney), $fontPath.'Inter/Inter-Regular.ttf', '-'.FormatNumber::TD($sotienchuyen, 1).' đ');
    canchinhphai_noidung($image, 26, 840, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $noidungchuyen, 1.9);
    canletrai($image, 26, 63, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 82);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Cake','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
