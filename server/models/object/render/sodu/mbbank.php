<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-mbbank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $gd = FormatNumber::PREG($_POST["gd"]);
    $convertGD = [
    1 => ['mb-macdinh', '255,255,255', 'light'],
    2 => ['mb-canhenmuaxuan', '255,255,255', 'light'],
    3 => ['mb-diudang', '0,0,0', 'dark'],
    4 => ['mb-meothanntai', '17,49,60', 'dark'],
    5 => ['mb-mondaymood', '255,255,255', 'dark'],
    6 => ['mb-nammoirucro', '255,255,255', 'light'],
    7 => ['mb-nhipdapsanco', '255,255,255', 'light'],
    8 => ['mb-tienbuocvungvang', '255,255,255', 'light'],
    9 => ['mb-tuhaovietnam', '255,255,255', 'light'],
    10 => ['mb-higreen', '19,39,50', 'dark'],
    11 => ['mb-khatvongvuoncao', '25,45,57', 'dark'],
    12 => ['mb-binhan', '25,45,57', 'dark'],
    13 => ['mb-bethesky', '25,45,57', 'dark'],
    14 => ['mb-sweetlove', '25,45,57', 'dark'],
    15 => ['mb-khampha', '25,45,57', 'dark'],
    16 => ['mb-pholang', '255,255,255', 'light'],
    17 => ['mb-chinhphucdinhcao', '255,255,255', 'light'],
    18 => ['mb-pickleball', '25,45,57', 'dark'],
    19 => ['mb-dreambig', '255,255,255', 'light'],
    20 => ['mb-tretrung', '25,45,57', 'dark'],
    21 => ['mb-truongsaxanh', '25,45,57', 'dark'],
    ];    
    [$themeName, $colorCode, $themeNw] = $convertGD[$gd] ?? ['mb-canhenmuaxuan', '255,255,255', 'light'];  
    list($r, $g, $b) = explode(',', $colorCode); 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/so-du/'.$themeName.'.jpeg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefromjpeg($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/'.$themeNw.'.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30,100);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function CanSoDuMb($image, $text, $font, $size, $color, $vnd_font, $vnd_size, $vnd_color, $y, $x, $name)
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
    function CanThoiGianMb($image, $text, $font, $size, $color, $y) {
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
    function canchinhphai2Mb($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
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
    $lenxuongSodu = ($themeName === 'mb-macdinh') ? 616 : (($themeName === 'mb-higreen') ? 620 : 593);
    $traiphaiSodu = ($themeName === 'mb-macdinh') ? 460 : (($themeName === 'mb-higreen') ? 460 : 442);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);
    CanSoDuMb($dest_img, FormatNumber::TD($sodu,2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf',45, imagecolorallocate($dest_img, (int)$r, (int)$g, (int)$b), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, (int)$r, (int)$g, (int)$b), $lenxuongSodu, $traiphaiSodu,'  VND');
    CanThoiGianMb($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, ...(($themeNw === 'dark') ? [0, 0, 0] : [255, 255, 255])), 85);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['MB Bank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}