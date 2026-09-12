<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-zalopay') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/zalopay.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function canchinhphai2($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canletraisdzalopay($image, $text, $font, $size, $color, $y, $x_zalopay=100) {
        $fixed_left_position = $x_zalopay; 
        $image_width = imagesx($image);
        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    $width = imagesx($image);
    $height = imagesy($image);
    $dest_img = imagecreatetruecolor($width, $height);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);
    canletraisdzalopay($dest_img, FormatNumber::TD($sodu).'đ', $fontPath.'common/San Francisco/SanFranciscoText-Bold.otf', 43, imagecolorallocate($dest_img, 1,1,1), 600,97);    
    canletraisdzalopay($dest_img, FormatNumber::TD($sodu).'đ', $fontPath.'common/San Francisco/SanFranciscoText-Bold.otf', 42, imagecolorallocate($dest_img, 249,249,249), 370,240);    
    canletraisdzalopay($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Bold.otf', 35, imagecolorallocate($dest_img, 229,246,255), 84);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['Ví Zalopay','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}