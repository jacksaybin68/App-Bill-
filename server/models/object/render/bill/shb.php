<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'shb') {
    $name_nhan = $_POST["name_nhan"];
    $stkgui = $_POST["stkgui"];
    $stknhan = $_POST["stknhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $magiaodich = $_POST["magiaodich"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/shb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $themeDisplay ='light';
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
    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = (int) round(($imageWidth - $textWidth) / 2);
    $y = (int) round($y); 
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function alignRight($image, $text, $font, $size, $color, $y, $nhan = 50)
            {
                $bbox = imagettfbbox($size, 0, $font, $text);
                $text_width = $bbox[2] - $bbox[0];
                $x = (int) round(imagesx($image) - $text_width - $nhan);
                $y = (int) round($y);
                imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
            }

    $words = explode(' ', ($noidung));
    if (count($words) <= 7) {
    } else {
    $middleIndex = ceil(count($words) / 2);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
      alignRight($image, $firstPart, $fontPath.'/OpenSans/OpenSans-Medium.ttf', 30, imagecolorallocate($image, 33, 43, 54), 1555);
       alignRight($image, $secondPart, $fontPath.'/OpenSans/OpenSans-Medium.ttf', 30, imagecolorallocate($image, 33, 43, 54), 1610);
              
    }
        if (!isset($words2s) || !is_array($words2s)) {
    $words2s = [];
    }
    if (count($words2s) <= 4) {
    } else {
    alignRight($image, 'Ngân hàng', $fontPath.'/OpenSans/OpenSans-Medium.ttf', 30, imagecolorallocate($image, 33, 43, 54), 500);
    alignRight($image, $nganhangnhan, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 30, imagecolorallocate($image, 33, 43, 54), 500);
    }
    cangiua($image, 37, 1595, imagecolorallocate($image, 0, 0, 0), $fontPath.'/OpenSans/OpenSans-Medium.ttf', FormatNumber::TD($sotienchuyen, 2) . ' VND');
    cangiua($image, 37, 2050, imagecolorallocate($image, 0, 0, 0), $fontPath.'/OpenSans/OpenSans-Medium.ttf', FormatNumber::TD($sotienchuyen, 2) . ' VND');
    cangiua($image, 32, 2585, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $thoigianchuyen);
    cangiua($image, 37, 980, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $stknhan);
    cangiua($image, 37, 1130, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $name_nhan);
    cangiua($image, 37, 830, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', 'Chuyển khoản nhanh NAPAS 247');
    cangiua($image, 37, 1745, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', '0 VND');
    cangiua($image, 37, 1895, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', 'Thu phí người chuyển');
    cangiua($image, 37, 2430, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $magiaodich);
    cangiua($image, 37, 2215, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $noidung);
    cangiua($image, 37, 1440, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $stkgui);
    cangiua($image, 37, 1285, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', 'Ngân hàng ' . $nganhangnhan);

         $words = explode(' ', $sotienchuyen);
    if (count($words) <= 6) {
    } else {
    $middleIndex = ceil(count($words) / 2);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
     alignRight($image, $firstPart, $fontPath.'/OpenSans/OpenSans-Medium.ttf', 35, imagecolorallocate($image, 4, 88, 146), 1350);
       alignRight($image, $secondPart, $fontPath.'/OpenSans/OpenSans-Medium.ttf', 35, imagecolorallocate($image, 4, 88, 146), 1400);
    cangiua($image, 30, 480, imagecolorallocate($image, 141, 158, 170), $fontPath.'/heebo/Heebo-Bold.ttf', $thoigianchuyen);
    cangiua($image, 30, 1250, imagecolorallocate($image, 33, 43, 54), $fontPath.'/OpenSans/OpenSans-Medium.ttf', $nganhangnhan);
    }    
    imagettftext($image, 37, 0, 160, 95, imagecolorallocate($image, 255,255,255), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['SHB','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
