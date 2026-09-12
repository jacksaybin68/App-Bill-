<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-agribank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $name = $_POST["name"];
    $chinhanh = $_POST["chinhanh"];
    $stk = $_POST["stk"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/agribank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function khhaha($image, $fontsize, $y, $textColor, $font, $text)
    {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; 
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    imagettftext($image, 26, 0, 510, 387, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $stk);
    imagettftext($image, 29, 0, 100, 72, imagecolorallocate($image, 0, 0, 0), $fontPath . '/Inter/Inter-SemiBold.ttf', $thoigiantrendt);
    $balance = $sodu;
    $balanceText = number_format($balance) . ' VND'; 
    imagettftext($image, 26, 0, 510, 530, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $balanceText);
    $balance = $sodu;
    $balanceText = number_format($balance) . ' VND';
    imagettftext($image, 26, 0, 510, 673, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $balanceText);
    $currentDate = date('d/m/Y'); 
    $previousDate = date('d/m/Y', strtotime('-1 month')); 
    imagettftext($image, 28, 0, 535, 1500, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $currentDate);
    imagettftext($image, 28, 0, 75, 1500, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $previousDate);
    imagettftext($image, 26, 0, 510, 955, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $chinhanh);
    $balanceX = 600;
    $spaceBetweenChars = 20;
    $vndX = $balanceX - $spaceBetweenChars;
    imagettftext($image, 26, 0, 510, 816, imagecolorallocate($image, 51, 51, 51), $fontPath . '/vietcombank/Manrope-SemiBold.ttf', $name);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Agribank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}