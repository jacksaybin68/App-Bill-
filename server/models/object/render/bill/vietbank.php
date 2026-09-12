<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'vietbank') {
    $name_nhan = $_POST["name_nhan"];
    $stkgui = $_POST["stkgui"];
    $stknhan = $_POST["stknhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/vietbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    $image = imagecreatefrompng($phoiBank);
    if ($nganhangnhan === 'vtd') {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,15,122,400,);
    }    
function canletrai($image, $fontSize, $y, $color, $font, $text, $x = 105) {
    imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
}
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    // function cangiua($image, $fontSize, $y, $color, $font, $text) {
    //     $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    //     $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    //     $imageWidth = imagesx($image);
    //     $x = ($imageWidth - $textWidth) / 2;
    //     imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
    //     $intValue = (int) 359.5;
    // }
            function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
            $imageWidth = imagesx($image);
            $x = (int) (($imageWidth - $textWidth) / 2);
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }

    canletrai($image, 40, 1746, imagecolorallocate($image, 53, 54, 59), $fontPath.'/vietbank/Yantramanav-Medium.ttf', $name_nhan, 105);
    // cangiua($image, 60, 838, imagecolorallocate($image, 11, 88, 144), $fontPath.'/vietbank/Yantramanav-Bold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhgiua($image, 60, 838, imagecolorallocate($image, 11, 88, 144), $fontPath.'/vietbank/Yantramanav-Bold.ttf', FormatNumber::TD($sotienchuyen, 1) . ' VND', 105);
    canletrai($image, 39, 1525, imagecolorallocate($image, 53, 54, 59), $fontPath.'/vietbank/Yantramanav-Medium.ttf', $nganhangnhan, 105);
    canletrai($image, 44, 1094, imagecolorallocate($image, 53, 54, 59), $fontPath.'/vietbank/Yantramanav-Medium.ttf', $stkgui, 105);
    canletrai($image, 44, 1310, imagecolorallocate($image, 53, 54, 59), $fontPath.'/vietbank/Yantramanav-Medium.ttf', $stknhan, 105);
    canletrai($image, 35, 1920, imagecolorallocate($image, 10, 9, 8), $fontPath.'/vietbank/Yantramanav-Medium.ttf', $noidung, 105);
    canbentren($image, 92, 97, imagecolorallocate($image, 255, 255, 255), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 42);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['VietBank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
