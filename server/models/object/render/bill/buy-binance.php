<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'buy-binance') {
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $sotienrut = FormatNumber::PREG($_POST["sotienrut"]);
    $diachi = $_POST["diachi"];
    $phimangluoi = FormatNumber::PREG($_POST["phimangluoi"]);
    $idgiaodich = $_POST["idgiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/buy-binance-dark.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $img = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $img = Watermark::Render($img);
    }    
    
    function canchinhphai($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $bbox[2] - $bbox[0];
        $x = imagesx($image) - $text_width - $margin;
        imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
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
    function canchinhnganhang($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $maxLength = 30;
        if (mb_strlen($text, 'UTF-8') > $maxLength) {
            $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
            
            if ($lastSpace !== false) {
                $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
                $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8'); 
            } else {
                $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
                $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
            }
        } else {
            $firstLine = $text;
            $secondLine = '';
        }
        $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
        $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
        $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
        imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);
        if (!empty($secondLine)) {
            $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
            $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
            $currentY = $y + $size + 24;
            $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;
    
            imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
        }
    }
    
    function canchinhtien($image, $text, $font, $size, $color, $y, $margin = 74)
{
    $text = ucwords(strtolower($text));
    $text = str_replace(' đồng', ' Đồng', $text);
    $text = str_ireplace(' Ai Mươi', ' Hai Mươi', $text);
    $maxLength = 34;
    if (mb_strlen($text, 'UTF-8') > $maxLength) {
        $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');

        if ($lastSpace !== false) {
            $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
            $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8');
        } else {
            $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
            $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
        }
    } else {
        $firstLine = $text;
        $secondLine = '';
    }

    $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
    $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
    $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
    imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);

    if (!empty($secondLine)) {
        $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
        $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
        $currentY = $y + $size + 24;
        $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;

        imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
    }
}

    function canchinhnoidung($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $maxLength = 31;
        if (mb_strlen($text, 'UTF-8') > $maxLength) {
            $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
            
            if ($lastSpace !== false) {
                $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
                $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8'); 
            } else {
                $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
                $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
            }
        } else {
            $firstLine = $text;
            $secondLine = '';
        }
        $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
        $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
        $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
        imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);
        if (!empty($secondLine)) {
            $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
            $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
            $currentY = $y + $size + 24;
            $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;
    
            imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
        }

    }
    function canchinhnoidung2($image, $text, $font, $size, $color, $y, $margin = 74)
{
    $maxLength = 31;
    if (mb_strlen($text, 'UTF-8') > $maxLength) {
        $firstSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
        if ($firstSpace !== false) {
            $firstLine = mb_substr($text, 0, $firstSpace, 'UTF-8');
            $remainingText = mb_substr($text, $firstSpace + 1, null, 'UTF-8');
        } else {
            $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
            $remainingText = mb_substr($text, $maxLength, null, 'UTF-8');
        }
    } else {
        $firstLine = $text;
        $remainingText = '';
    }
    if (mb_strlen($remainingText, 'UTF-8') > $maxLength) {
        $secondSpace = mb_strrpos(mb_substr($remainingText, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
        if ($secondSpace !== false) {
            $secondLine = mb_substr($remainingText, 0, $secondSpace, 'UTF-8');
            $thirdText = mb_substr($remainingText, $secondSpace + 1, null, 'UTF-8');
        } else {
            $secondLine = mb_substr($remainingText, 0, $maxLength, 'UTF-8');
            $thirdText = mb_substr($remainingText, $maxLength, null, 'UTF-8');
        }
    } else {
        $secondLine = $remainingText;
        $thirdText = '';
    }
    if (mb_strlen($thirdText, 'UTF-8') > $maxLength) {
        $thirdLine = mb_substr($thirdText, 0, $maxLength - 1, 'UTF-8') . '…';
    } else {
        $thirdLine = $thirdText;
    }
    $bbox1 = imagettfbbox($size, 0, $font, $firstLine);
    $width1 = $bbox1[2] - $bbox1[0];
    $x1 = imagesx($image) - $width1 - $margin;
    imagettftext($image, $size, 0, $x1, $y, $color, $font, $firstLine);
    imageline($image, $x1, $y + 4, $x1 + $width1, $y + 4, $color);
    if (!empty($secondLine)) {
        $y2 = $y + $size + 24;
        $bbox2 = imagettfbbox($size, 0, $font, $secondLine);
        $width2 = $bbox2[2] - $bbox2[0];
        $x2 = imagesx($image) - $width2 - $margin;
        imagettftext($image, $size, 0, $x2, $y2, $color, $font, $secondLine);
        imageline($image, $x2, $y2 + 4, $x2 + $width2, $y2 + 4, $color);
    }
    if (!empty($thirdLine)) {
        $y3 = $y + ($size + 24) * 2;
        $bbox3 = imagettfbbox($size, 0, $font, $thirdLine);
        $width3 = $bbox3[2] - $bbox3[0];
        $x3 = imagesx($image) - $width3 - $margin;
        imagettftext($image, $size, 0, $x3, $y3, $color, $font, $thirdLine);
        imageline($image, $x3, $y3 + 4, $x3 + $width3, $y3 + 4, $color);
    }
}

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
            $imageWidth = imagesx($image);
            $x = (int) (($imageWidth - $textWidth) / 2);
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
    }
    $width = imagesx($img);
    $height = imagesy($img);
    $image = imagecreatetruecolor($width, $height);
    imagecopy($image, $img, 0, 0, 0, 0, $width, $height);
    imagettftext($image, 28, 0, 98, 72, imagecolorallocate($image, 234, 236, 238), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    canchinhnoidung($image, $diachi, $fontPath . 'binance/BinancePlex-Medium.otf',21,imagecolorallocate($image, 234, 236, 238), 712);  
    canchinhnoidung2($image, $idgiaodich, $fontPath . 'binance/BinancePlex-Medium.otf',20,imagecolorallocate($image, 234, 236, 238), 816);    
    canchinhgiua($image, 38, 300, imagecolorallocate($image, 234, 236, 238), $fontPath . 'binance/BinancePlex-SemiBold.otf', '-' . FormatNumber::TD($sotienchuyen, 1) . ' USDT', 105); 
    canchinhphai2($image, 21, 966, imagecolorallocate($image, 234, 236, 238), $fontPath . 'binance/BinancePlex-SemiBold.otf', FormatNumber::TD($sotienrut, 1), 112);    
    canchinhphai2($image, 21, 1043, imagecolorallocate($image, 234, 236, 238), $fontPath . 'binance/BinancePlex-SemiBold.otf', FormatNumber::TD($phimangluoi, 1), 112);
    canchinhphai2($image, 21, 1200, imagecolorallocate($image, 234, 236, 238), $fontPath . 'binance/BinancePlex-SemiBold.otf', $thoigianchuyen, 33);

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    imagedestroy($img);
    $namebill = ['Binance','Buy Binance'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}