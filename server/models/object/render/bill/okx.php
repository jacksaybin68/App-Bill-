<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'okx') {
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $diachi = $_POST["diachi"];
    $phimangluoi = FormatNumber::PREG($_POST["phimangluoi"]);
    $idgiaodich = $_POST["idgiaodich"];
    $mathamchieu = $_POST["mathamchieu"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/okx.png';
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
    imagettftext($image,30, 0, 60, 72, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    $sotienchuyen = $sotienchuyen;
    if (strpos($sotienchuyen, '.') !== false) {
    list($integerPart, $decimalPart) = explode('.', $sotienchuyen);
    $formattedInteger = number_format($integerPart, 0, ',', '.');
    $formattedAmount = $formattedInteger . ',' . $decimalPart;
    } else {
    $formattedAmount = number_format($sotienchuyen, 0, ',', '.');
    }
    canchinhgiua($image, 40, 328, imagecolorallocate($image, 255, 255, 255), $fontPath.'binance/BinancePlex-SemiBold.otf', '-' . $formattedAmount . ' USDT', 105);
    imagettftext($image, 22, 0, 670, 710, imagecolorallocate($image, 255, 255, 255), $fontPath . 'binance/BinancePlex-Medium.otf', 'Tron(TRC20)');
    imagettftext($image, 22, 0, 590, 780, imagecolorallocate($image, 255, 255, 255), $fontPath . 'binance/BinancePlex-Medium.otf', 'Rút tiền trên chuỗi');
    imagettftext($image, 23, 0, 720, 845, imagecolorallocate($image, 255, 255, 255), $fontPath . 'binance/BinancePlex-Medium.otf', 'Hoàn tất');
    $words = explode(' ', ($phimangluoi . ' USDT'));
    if (count($words) <= 0) {
    canletrai($image, 16, 1000, imagecolorallocate($image, 255, 255, 255), $fontPath . '/Inter/Inter-SemiBold.ttf', $phimangluoi, 500);
    } else {
    $middleIndex = ceil(count($words) / 1.25);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
    $fontSize = 23; 
    $fontFile = $fontPath . 'binance/BinancePlex-Medium.otf'; 
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $startYFirstLine = 1142; 
    $startYSecondLine = 1080; 
    $startX = 833; 
    $textBoxFirst = imagettfbbox($fontSize, 0, $fontFile, $firstPart);
    $textWidthFirst = abs($textBoxFirst[4] - $textBoxFirst[0]); 
    $xFirstLine = $startX - $textWidthFirst; 
    imagettftext($image,$fontSize,0,$xFirstLine,$startYFirstLine,$textColor,$fontFile,$firstPart
    );
    $textBoxSecond = imagettfbbox($fontSize, 0, $fontFile, $secondPart);
    $textWidthSecond = abs($textBoxSecond[4] - $textBoxSecond[0]); 
    $xSecondLine = $startX - $textWidthSecond; 
    imagettftext($image,$fontSize,0,$xSecondLine,$startYSecondLine,$textColor,$fontFile,$secondPart);
    }
    $text = $diachi;
    function splitTextIntoLines($text, $maxLength) {
    $lines = [];
    while (strlen($text) > $maxLength) {
        $breakPoint = strrpos(substr($text, 0, $maxLength), ' ');
        if ($breakPoint === false || $breakPoint == 0) {
            $breakPoint = $maxLength; 
        }
        $lines[] = trim(substr($text, 0, $breakPoint)); 
        $text = trim(substr($text, $breakPoint));      
    }
    if (!empty($text)) {
        $lines[] = $text; 
    }
    return $lines;
    }
    $lines = splitTextIntoLines($text, 22);
    $startX = 785; 
    $startY = 910; 
    $fontSize = 22; 
    $lineSpacing = 20; 
    $fontFile = $fontPath . 'binance/BinancePlex-Medium.otf';
    $color = imagecolorallocate($image, 255, 255, 255); 
    foreach ($lines as $line) {
    $textBox = imagettfbbox($fontSize, 0, $fontFile, $line);
    $lineWidth = abs($textBox[4] - $textBox[0]); 
    $x = $startX - $lineWidth; 
    imagettftext($image, $fontSize, 0, $x, $startY, $color, $fontFile, $line);
    $startY += $fontSize + $lineSpacing;
    }
    $words = explode(' ', $idgiaodich);
                if (count($words) <= 20) {
    if (!function_exists('splitTextIntoLines')) {
    function splitTextIntoLines($text, $maxLength) {
        $lines = [];
        while (strlen($text) > $maxLength) {
            $breakPoint = strrpos(substr($text, 0, $maxLength), ' '); 
            if ($breakPoint === false) {
                $breakPoint = $maxLength; 
            }
            $lines[] = substr($text, 0, $breakPoint);
            $text = substr($text, $breakPoint + 1);
        }
        $lines[] = $text; 
        return $lines;
    }
    }
    $text = $idgiaodich; 
    $lines = splitTextIntoLines($text, 24);
    $fontSize = 21; 
    $maxX = 785; 
    $startY = 1007; 
    $lineSpacing = 15;
    $fontFile = $fontPath . 'binance/BinancePlex-Medium.otf'; 
    $color = imagecolorallocate($image, 255, 255, 255);
    $underlineColor = imagecolorallocate($image, 0, 0, 0);
    foreach ($lines as $line) {
    $textBox = imagettfbbox($fontSize, 0, $fontFile, $line);
    $lineWidth = abs($textBox[4] - $textBox[0]); 
    $x = $maxX - $lineWidth; 
    imagettftext($image, $fontSize, 0, $x, $startY, $color, $fontFile, $line);
    imageline(
        $image,              
        $x,                         
        $startY + 2,                
        $x + $lineWidth,             
        $startY + 2,                 
        $underlineColor            
    );
    $startY += $fontSize + $lineSpacing;
    }
                } else {
                    $middleIndex = ceil(count($words) / 2);
                    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
                    $secondPart = implode(' ', array_slice($words, $middleIndex));
                    canletrai($image, 16, 400, imagecolorallocate($image, 255, 255, 255), $fontPath . '/Inter/Inter-SemiBold.ttf', removeAccentsAndToUpper($firstPart), 105);
                    canletrai($image, 16, 425, imagecolorallocate($image, 255, 255, 255), $fontPath . '/Inter/Inter-SemiBold.ttf', removeAccentsAndToUpper($secondPart), 100);
                }
    $xStart = 835;
    $text = $mathamchieu;
    if (is_numeric($text)) {
    if (strpos($text, '.') !== false) {
        list($integerPart, $decimalPart) = explode('.', $text);
        $integerPart = number_format($integerPart, 0, ',', '.');
        $text = $integerPart . ',' . $decimalPart;
    } else {
        $text = number_format($text, 0, '', '');
    }
    }
    $fontSize = 23;
    $fontFile = $fontPath . 'binance/BinancePlex-Medium.otf'; 
    $textColor = imagecolorallocate($image, 255, 255, 255); 
    $xStart = 785;
    $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
    $textWidth = abs($textBox[4] - $textBox[0]);
    $x = $xStart - $textWidth;
    imagettftext($image, $fontSize, 0, $x, 1275,$textColor, $fontFile, $text);
    imagettftext($image, 23, 0,560, 1210, imagecolorallocate($image, 255, 255, 255),$fontPath . 'binance/BinancePlex-Medium.otf', $thoigianchuyen);

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    imagedestroy($img);
    $namebill = ['OKX','Sàn Giao Dịch'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}