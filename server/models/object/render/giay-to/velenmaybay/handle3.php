<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'fake-velenmaybay3') {
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
    $deptime = $_POST["deptime"];
    $khu = $_POST["khu"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/velenmaybay/velenmaybay3.png';
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


    canchinhphai($image, 20, 215, imagecolorallocate($image, 82,81,79), $fontPath.'Nunito-Bold.ttf', $cua, 340);
    canchinhphai($image, 22, 216, imagecolorallocate($image, 82,81,79), $fontPath.'Nunito-Bold.ttf', $nam, 175);
    canchinhphai($image, 20, 213, imagecolorallocate($image, 31,29,30), $fontPath.'Nunito-Bold.ttf', $tg, 455);
    canchinhphai($image, 9, 262, imagecolorallocate($image, 30,26,17), $fontPath.'Nunito-Bold.ttf', $no, 610);
    canchinhphai($image, 11, 140, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $chuyenbay, 170);
    canchinhphai($image, 11, 137, imagecolorallocate($image, 40,38,39), $fontPath.'Nunito-Bold.ttf', $date, 315);
    canchinhphai($image, 11, 96, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $ten, 175);
    canchinhphai($image, 11, 120, imagecolorallocate($image, 36,27,20), $fontPath.'Nunito-Bold.ttf', $ditu, 586);
    canchinhphai($image, 11, 170, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $den, 167);
    canchinhphai($image, 10, 88, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $ten, 585);
    canchinhphai($image, 17, 567, imagecolorallocate($image, 36,27,20), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ditu, 1045);
    canchinhphai($image, 9, 134, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $den, 585);
    canchinhphai($image, 8, 294, imagecolorallocate($image, 63,59,60), $fontPath.'common/Roboto/Roboto-Regular.ttf', $tkne, 310);
    canchinhphai($image, 8, 246, imagecolorallocate($image, 63,59,60), $fontPath.'common/Roboto/Roboto-Regular.ttf', $tkne, 600);
    canchinhphai($image, 8, 213, imagecolorallocate($image, 31,29,30), $fontPath.'Nunito-Bold.ttf', $tg, 595);
    canchinhphai($image, 15, 830, imagecolorallocate($image, 30,26,17), $fontPath.'Ubuntu/Ubuntu-Medium.ttf', $no, 1226);
    canchinhphai($image, 11, 166, imagecolorallocate($image, 40,38,39), $fontPath.'Nunito-Bold.ttf', $date, 586);
    canchinhphai($image, 8, 213, imagecolorallocate($image, 13,13,13), $fontPath.'Nunito-Bold.ttf', $chuyenbay, 678);
    canchinhphai($image, 8, 294, imagecolorallocate($image, 31,29,30), $fontPath.'Nunito-Bold.ttf', $ghichu, 85);
    canchinhphai($image, 20, 920, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $ghichu, 1150);
    canchinhphai($image, 11, 136, imagecolorallocate($image, 40,38,39), $fontPath.'Nunito-Bold.ttf', $deptime, 485);
    canchinhphai($image, 20, 276, imagecolorallocate($image, 30,26,17), $fontPath.'common/Roboto/Roboto-Bold.ttf', $khu, 490);
    
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Vé Lên Máy Bay Loại 3','Giấy tờ'];
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
