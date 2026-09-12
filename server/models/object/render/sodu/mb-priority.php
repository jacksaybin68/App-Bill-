<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-mbbank-priority') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $gd = FormatNumber::PREG($_POST["gd"]);
    $convertGD = [
    1 => ['mb-priority', '255,255,255', 'dark'],
    2 => ['mb-tuhaovietnampriority', '255,255,255', 'dark'],
    ];    
    [$themeName, $colorCode, $themeNw] = $convertGD[$gd] ?? ['mb-tuhaovietnampriority', '255,255,255', 'dark'];  
    list($r, $g, $b) = explode(',', $colorCode); 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/so-du/'.$themeName.'.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/'.$themeNw.'.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30,100);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function CanSoDu($image, $text, $font, $size, $color, $vnd_font, $vnd_size, $vnd_color, $y, $x, $name)
    {
        $fixed_left_position = $x;
        $right_padding = 10;
        $image_width = imagesx($image);
        $formatted_text = $text;
        $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;
        if ($text_width + $fixed_left_position + $right_padding > $image_width) {
            $text_left_margin = $image_width - $text_width - $right_padding;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
        $text_width_vnd = $text_width + 5; 
        $vnd_left_margin = $text_left_margin + $text_width_vnd;
        imagettftext($image, $vnd_size, 0, $vnd_left_margin, $y, $vnd_color, $vnd_font, $name);
    }
    function CanThoiGian($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 100; 
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
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
    $width = imagesx($image);
    $height = imagesy($image);
    $dest_img = imagecreatetruecolor($width, $height);
    $lenxuongSodu = ($themeName === 'mb-priority') ? 510 : (($themeName === 'mb-tuhaovietnampriority') ? 510 : 593);
    $traiphaiSodu = ($themeName === 'mb-priority') ? 405 : (($themeName === 'mb-tuhaovietnampriority') ? 405 : 442);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);
    CanSoDu($dest_img, FormatNumber::TD($sodu,2), $fontPath . 'SoleilBook.otf',45, imagecolorallocate($dest_img, (int)$r, (int)$g, (int)$b), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 37, imagecolorallocate($dest_img, (int)$r, (int)$g, (int)$b), $lenxuongSodu, $traiphaiSodu,' VND');
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, ...(($themeNw === 'dark') ? [0, 0, 0] : [255, 255, 255])), 85);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['MB Bank Priority','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}