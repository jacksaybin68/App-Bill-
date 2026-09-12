<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-momo') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $soduthantai = FormatNumber::PREG($_POST["soduthantai"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/momo.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
    function canletrai($image, $text, $font, $size, $color, $y, $x_zalopay=100) {
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
    $dest_img = imagecreatetruecolor(imagesx($image), imagesy($image));
    imagecopy($dest_img, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
    canchinhphai2($dest_img, 39, 1703, imagecolorallocate($image, 1,1,1), $fontPath.'common/San Francisco/SanFranciscoDisplay-Bold.otf', FormatNumber::TD($sodu).'đ', 182);
    canletrai($dest_img, FormatNumber::TD($sodu+$soduthantai).'đ', $fontPath.'common/San Francisco/SanFranciscoText-Bold.otf', 46, imagecolorallocate($dest_img, 1,1,1), 1335,73);  
    canchinhphai2($dest_img, 39, 1870, imagecolorallocate($image, 1,1,1), $fontPath.'common/San Francisco/SanFranciscoDisplay-Bold.otf', FormatNumber::TD($soduthantai).'đ', 182);
    canletrai($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 38, imagecolorallocate($dest_img, 1,1,1), 86);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['Ví Momo','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}