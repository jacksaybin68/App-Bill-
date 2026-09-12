<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-techcombank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $gd = FormatNumber::PREG($_POST["gd"]);
    $convertGD = [
    1 => ['tech-macdinh', '255,255,255', 'light'],
    2 => ['tech-thanhphobandem', '255,255,255', 'light'],
    3 => ['tech-baibien', '255,255,255', 'dark'],
    4 => ['tech-thanhphobanngay', '255,255,255', 'dark'],
    5 => ['tech-macdinh1', '255,255,255', 'light'],
    6 => ['tech-congvienmuaxuan', '255,255,255', 'dark'],
    7 => ['tech-canhdongxanh', '255,255,255', 'dark'],
    8 => ['tech-khuphonhao', '255,255,255', 'dark'],
    9 => ['tech-bienhoanghon', '255,255,255', 'light'],
    10 => ['tech-canhbienbinhminh', '255,255,255', 'dark'],
    11 => ['tech-nangdongthanhpho', '255,255,255', 'dark'],
    12 => ['tech-caubetruotvan', '255,255,255', 'dark'],
    13 => ['tech-vandongvienduongdua', '255,255,255', 'dark'],
    14 => ['tech-xuanvungcao', '255,255,255', 'dark'],
    15 => ['tech-thanhphohiendai', '255,255,255', 'dark'],
    16 => ['tech-caoocxanh', '255,255,255', 'dark'],
    17 => ['tech-muathupho', '255,255,255', 'light'],
    18 => ['tech-', '255,255,255', 'dark'],
    19 => ['tech-', '255,255,255', 'dark'],
    20 => ['tech-', '255,255,255', 'dark'],
    21 => ['tech-', '255,255,255', 'dark'],
    22 => ['tech-', '255,255,255', 'dark'],
    23 => ['tech-', '255,255,255', 'dark'],
    ];    
    [$themeName, $colorCode, $themeNw] = $convertGD[$gd] ?? ['tech-thanhphobandem', '255,255,255', 'light'];  
    list($r, $g, $b) = explode(',', $colorCode); 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/so-du/'.$themeName.'.jpeg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefromjpeg($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/'.$themeNw.'.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30,100);
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
    function CanThoiGiansdtech($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 115; 
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    function CaánoDusdtech($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 585;
        $right_padding = 10; 
        $image_width = imagesx($image);
        
        $formatted_text = number_format($text) . '';
        
        $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;
        
        if ($text_width + $fixed_left_position + $right_padding > $image_width) {
            $text_left_margin = $image_width - $text_width - $right_padding;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
    }
    $width = imagesx($image);
    $height = imagesy($image);
    $dest_img = imagecreatetruecolor($width, $height);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);
    CaánoDusdtech($dest_img, $sodu, $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', 38, imagecolorallocate($dest_img, 1, 1, 1), 420);
    CanThoiGiansdtech($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, ...(($themeNw === 'dark') ? [0, 0, 0] : [255, 255, 255])), 85);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['Techcombank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}