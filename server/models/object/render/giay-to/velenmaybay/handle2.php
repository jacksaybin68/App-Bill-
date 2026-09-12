<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'fake-velenmaybay2') {
    $cua = $_POST["cua"];
    $nam = $_POST["nam"];
    $tg = $_POST["tg"];
    $no = $_POST["no"];
    $chuyenbay = $_POST["chuyenbay"];
    $date = $_POST["date"];
    $ten = $_POST["ten"];
    $ditu = $_POST["ditu"];
    $den = $_POST["den"];
    $tkne = $_POST["tkne"];
    $ghichu = $_POST["ghichu"];
    $reg = $_POST["reg"];
    $khu = $_POST["khu"];
    // $stk = FormatNumber::PREG($_POST["stk"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/velenmaybay/velenmaybay2.png';
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


    canchinhphai($image, 36, 772, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $cua, 533);
    canchinhphai($image, 37, 772, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $nam, 719);
    canchinhphai($image, 23, 830, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $tg, 1005);
    canchinhphai($image, 16, 809, imagecolorallocate($image, 30,26,17), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $no, 857);
    canchinhphai($image, 20, 650, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $chuyenbay, 608);
    canchinhphai($image, 20, 650, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $date, 837);
    canchinhphai($image, 17, 640, imagecolorallocate($image, 36,27,20), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ten, 1005);
    canchinhphai($image, 20, 750, imagecolorallocate($image, 36,27,20), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ditu, 149);
    canchinhphai($image, 20, 840, imagecolorallocate($image, 36,27,20), $fontPath.'common/Roboto/Roboto-Bold.ttf', $den, 149);
    canchinhphai($image, 20, 650, imagecolorallocate($image, 36,27,20), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ten, 149);
    canchinhphai($image, 17, 567, imagecolorallocate($image, 36,27,20), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $ditu, 1045);
    canchinhphai($image, 17, 594, imagecolorallocate($image, 36,27,20), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $den, 1045);
    canchinhphai($image, 17, 538, imagecolorallocate($image, 124,114,105), $fontPath.'common/Roboto/Roboto-Regular.ttf', $tkne, 1100);
    canchinhphai($image, 33, 851, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $tg, 590);
    canchinhphai($image, 15, 830, imagecolorallocate($image, 30,26,17), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $no, 1226);
    canchinhphai($image, 20, 750, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $date, 1237);
    canchinhphai($image, 20, 750, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $chuyenbay, 1043);
    canchinhphai($image, 20, 940, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ghichu, 160);
    canchinhphai($image, 20, 920, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ghichu, 1150);
    canchinhphai($image, 16, 686, imagecolorallocate($image, 124,114,105), $fontPath.'common/Roboto/Roboto-Regular.ttf', $reg, 1070);
    canchinhphai($image, 20, 840, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $khu, 745);
    
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Vé Lên Máy Bay Loại 2','Giấy tờ'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
    if (!isset($user['rank']) || !in_array($user['rank'], ['admin', 'leader'])) {
    $requiredVIP = intval(preg_replace('/\D/', '', $TD->Setting('giataogiayto') ?? ''));
    $currentVIP = intval(preg_replace('/\D/', '', $plans->TD('tengoi', $taikhoan) ?? ''));
        if ($requiredVIP > 0 && $currentVIP < $requiredVIP) {
            $action = ($currentVIP === 0) ? "mua" : "tối thiểu";
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Vui lòng $action gói " . strtoupper($TD->Setting('giataogiayto')) . " để sử dụng tính năng fake vé máy bay!",
            ]));
        }
    }
}
