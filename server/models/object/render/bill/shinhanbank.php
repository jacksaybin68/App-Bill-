<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'shinhanbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $tennguoigui = $_POST["tennguoigui"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $stknhan = $_POST["stknhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/shinhanbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    $image = imagecreatefrompng($phoiBank);
    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    // function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
    //     $fontSize = $fontsize;
    //     $lines = explode('<br>', $text);
    //     $lineHeight = $fontsize * 1.7;
    //     foreach ($lines as $i => $line) {
    //         $yOffset = $y + ($i * $lineHeight);
    //         imagettftext($image, $fontSize, 0, $x_tcb, $yOffset, $textColor, $font, $line);
    //     }
    // }
//     function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
// {


//     // Thiết lập kích thước font chữ
//     $fontSize = $fontsize;


//     imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
// }
//     function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
//     {
//         $fontSize = $fontsize;
//         $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
//         $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
//         $imageWidth = imagesx($image);
//         $x = $imageWidth - $textWidth - $customX;
//         imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
//     }
//     function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
//         imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
//     }
//     function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
//         {
//             $fontSize = $fontsize;
//             $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
//             $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
//             $imageWidth = imagesx($image);
//             $x = (int) (($imageWidth - $textWidth) / 2);
//             imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
//         }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
    }
    
    function cangiua($image, $fontsize, $y, $textColor, $font, $text)
    {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
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
    canletrai($image, 27, 895, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf', $stknhan, 90);
    canletrai($image, 28, 1020, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf', $tennguoinhan, 90);
    canletrai($image, 28, 755, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf', $tennguoigui, 90);
    canchinhgiua($image, 23, 595, imagecolorallocate($image, 92, 90, 98), $fontPath . '/SFProText-Semibold_fix.otf', $thoigianchuyen, 52);
    canletrai($image, 26, 1175, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf',  FormatNumber::TD($sotienchuyen, 2), 203);
    canletrai($image, 26, 1315, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf', "0", 203);
    canletrai($image, 28, 1435, imagecolorallocate($image, 41, 41, 43), $fontPath . '/SF-Pro-Text-Semibold.otf', $noidungchuyen, 90);
    imagettftext($image, 29, 0, 115, 70, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);

    // canletrai($image, 17, 555, imagecolorallocate($image, 10,9,8), $fontPath.'Inter/Inter-Medium.ttf', $tennguoinhan, 35);
    // canletrai($image, 30, 410, imagecolorallocate($image,10,9,8), $fontPath.'Inter/Inter-SemiBold.ttf', 'Chuyển thành công<br>VND '.FormatNumber::TD($sotienchuyen, 2), 30);
    // canletrai($image, 17, 650, imagecolorallocate($image,10,9,8), $fontPath.'Inter/Inter-Medium.ttf', $nganhangnhan, 35);
    // canletrai($image, 17, 580, imagecolorallocate($image,10,9,8), $fontPath.'Inter/Inter-Medium.ttf', $stk, 35);
    // canletrai($image, 17, 790, imagecolorallocate($image,10,9,8), $fontPath.'Inter/Inter-Medium.ttf', $thoigianchuyen, 35);
    // canbentren($image, 46, 54, imagecolorallocate($image,10,9,8), $fontPath.'Inter/Inter-Medium.ttf', $thoigiantrendt, 19);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Shinhanbank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
