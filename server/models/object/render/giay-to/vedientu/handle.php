<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'fake-vedientu') {
    $madonhang = $_POST["madonhang"];
    $quydanh = $_POST["quydanh"];
    $hoten = $_POST["hoten"];
    $sove = $_POST["sove"];
    $hanhlysachtay = $_POST["hanhlysachtay"];
    $hanhlykygui = $_POST["hanhlykygui"];
    $loaive = $_POST["loaive"];
    $sanbaynoiden = $_POST["sanbaynoiden"];
    $gioden = $_POST["gioden"];
    $giodi = $_POST["giodi"];
    $sanbaynoidi = $_POST["sanbaynoidi"];
    $madatcho = $_POST["madatcho"];
    $noidi = $_POST["noidi"];
    $noiden = $_POST["noiden"];
    $thoigianbay = $_POST["thoigianbay"];
    $sohieuchuyenbay = $_POST["sohieuchuyenbay"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/vedientu/vedientu.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
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

    function canletraigpkd(
    $image, 
    $fontsize, 
    $y, 
    $textColor, 
    $font, 
    $text, 
    $x_tcb
) {
    $fontSize = (int) $fontsize;
    $x        = (int) $x_tcb;
    $y        = (int) $y;

    imagettftext(
        $image, 
        $fontSize, 
        0, 
        $x, 
        $y, 
        $textColor, 
        $font, 
        $text
    );
}

    // function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2)
    // {
    //     $lines = explode("\n", $text);
    //     $imageWidth = imagesx($image);
    //     for ($index = 0; $index < min(2, count($lines)); $index++) {
    //         $line = $lines[$index];
    //         $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
    //         $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    //         $x = $imageWidth - $textWidth - 85;

    //         imagettftext($image, (int) $fontSize, 0, (int) $x, (int) ($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
    //     }
    // }
    // // $textBox = imagettfbbox(46, 0, $fontPath.'acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen));
    // $vndBox = imagettfbbox(26, 0, $fontPath.'acb/NivaSmallCaps-Light.ttf', 'VND');
    // $textWidth = $textBox[2] - $textBox[0];
    // $vndWidth = $vndBox[2] - $vndBox[0];
    // $xAmount = round((imagesx($image) - $textWidth - $vndWidth - 15) / 2);
    // $yAmount = 525;
    // $xVND = round($xAmount + $textWidth + 15);
    // $yVND = 495;
    function drawWrappedText(
    $image, 
    $fontSize, 
    $startY, 
    $lineHeight, 
    $textColor, 
    $fontPath, 
    $text, 
    $maxWidth, 
    $x
) {
    $words = explode(' ', $text);
    $line = '';
    $y = (int) $startY;

    foreach ($words as $word) {
        $testLine = $line . ' ' . $word;
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $testLine);
        $lineWidth = $bbox[2] - $bbox[0];

        if ($lineWidth > $maxWidth && $line !== '') {
            imagettftext($image, $fontSize, 0, (int)$x, $y, $textColor, $fontPath, trim($line));
            $line = $word;
            $y += (int) round($fontSize * $lineHeight);
        } else {
            $line = $testLine;
        }
    }

    // Dòng cuối cùng
    if ($line !== '') {
        imagettftext($image, $fontSize, 0, (int)$x, $y, $textColor, $fontPath, trim($line));
    }
}


    canchinhphai($image, 14, 86, imagecolorallocate($image, 0,0,0), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $madonhang, 675);
    canchinhphai($image, 17, 300, imagecolorallocate($image, 77,77,77), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $quydanh, 160);
    canchinhphai($image, 17, 300, imagecolorallocate($image, 26,26,26), $fontPath.'/SF-Pro-Text-Semibold.otf', $hoten, 250);
    canchinhphai($image, 14, 300, imagecolorallocate($image, 26,26,26), $fontPath.'/SF-Pro-Text-Semibold.otf', $sove, 533);
    canchinhphai($image, 14, 300, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $hanhlysachtay, 755);
    canchinhphai($image, 14, 300, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $hanhlykygui, 895);
    canchinhphai($image, 12, 300, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $loaive, 1060);
    canchinhphai($image, 14, 420, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $sanbaynoiden, 685);
    canchinhphai($image, 14, 442, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $gioden, 685);
    canchinhphai($image, 14, 442, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $giodi, 265);
    canchinhphai($image, 14, 420, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $sanbaynoidi, 280);
    canchinhphai($image, 14, 161, imagecolorallocate($image, 255,255,255), $fontPath.'/SF-Pro-Text-Semibold.otf', $madatcho, 1030);
    canchinhphai($image, 16, 395, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $noidi, 205);
    canchinhphai($image, 16, 161, imagecolorallocate($image, 255,255,255), $fontPath.'/SF-Pro-Text-Semibold.otf', $noidi, 340);
    canchinhphai($image, 16, 161, imagecolorallocate($image, 255,255,255), $fontPath.'/SF-Pro-Text-Semibold.otf', $noiden, 550);
    canchinhphai($image, 16, 395, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $noiden, 610);
    canchinhphai($image, 13, 440, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $thoigianbay, 1091);
    canchinhphai($image, 13, 417, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', $sohieuchuyenbay, 1140);
    canchinhphai($image, 15, 395, imagecolorallocate($image, 0,0,0), $fontPath.'/SF-Pro-Text-Semibold.otf', "Vietnam Airlines", 1030);
    
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Vé Điện Tử','Giấy tờ'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
    if (!isset($user['rank']) || !in_array($user['rank'], ['admin', 'leader'])) {
    $requiredVIP = intval(preg_replace('/\D/', '', $TD->Setting('giataogiayto') ?? ''));
    $currentVIP = intval(preg_replace('/\D/', '', $plans->TD('tengoi', $taikhoan) ?? ''));
        if ($requiredVIP > 0 && $currentVIP < $requiredVIP) {
            $action = ($currentVIP === 0) ? "mua" : "tối thiểu";
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Vui lòng $action gói " . strtoupper($TD->Setting('giataogiayto')) . " để sử dụng tính năng fake vé điện tử!",
            ]));
        }
    }
}
