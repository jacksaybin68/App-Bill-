<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'agribank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $phigiaodich = $_POST["phigiaodich"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/agribank.jpg';
    $image = imagecreatefrompng($phoiBank);
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
            $x = ($customX == null) ? ($imageWidth - $textWidth - 240) : $customX;
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
    function canlephai($image, $fontsize, $y, $textColor, $font, $text, $wrap = false) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 730;
        $x = 624;
        if ($wrap) {
            $words = explode(' ', $text);
            $line = '';
            $yOffset = 0;
            foreach ($words as $word) {
                $testLine = $line . ($line ? ' ' : '') . $word;
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $testLine);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                if ($textWidth > $maxWidth) {
                    imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
                    $line = $word;
                    $yOffset += 50;
                } else {
                    $line = $testLine;
                }
            }
            if ($line) {
                imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
            }
            return $yOffset + 50; 
        } else {
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            if ($textWidth + $x > imagesx($image)) {
                $x = 443;
            }
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
            return 48;
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
    function canlephai_iconbank($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 5)
    {
        $icon = imagecreatefrompng($iconBank);
        list($iconWidth, $iconHeight) = [50, 50];
        $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $name_bank);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $iconWidth - 20 - 93;
        $iconY = $y - $iconHeight + $iconOffsetY;
        imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
        imagettftext($image, $fontSize, 0, round($x + $iconWidth + 18), round($y), $textColor, $font, $name_bank);
        imagedestroy($icon);
        imagedestroy($resizedIcon);
    }
    canlephai($image, 36, 858, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', $tennguoinhan, true);
    canchinhgiua($image, 63, 486, imagecolorallocate($image, 176,13,52), $fontPath.'acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canlephai($image, 36, 1078, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', $nganhangnhan, true);
    canlephai($image, 36, 968, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', $stk);
    canlephai($image, 36, 1304, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', $phigiaodich);
    canlephai($image, 36, 1413, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', $thoigianchuyen);
    canlephai($image, 36, 1522, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Medium.otf', VnTones($noidungchuyen), true);
    canletrai($image, 38, 84, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 100);
    canchinhphai($image, 31, 586, imagecolorallocate($image, 61,59,59), $fontPath.'common/Noto Sans/NotoSans-Regular.ttf','Mã giao dịch: '.$magiaodich, true);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Agribank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
