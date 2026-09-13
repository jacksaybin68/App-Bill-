<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && ($_POST['action'] === 'sodu-mbnoel' || $_POST['action'] === 'sodu-mbbank-noel')) {
    $thoigiantrendt = $_POST["thoigiantrendt"] ?? date('H:i');
    $sodu = FormatNumber::PREG($_POST["sodu"] ?? 0);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/sodu-mbnoel.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefromstring(file_get_contents($phoiBank));
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';

    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image, 1, 30, 100);
    }    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"] ?? 'wifi', $iconDynamicsIsland ?? 'none');

    if (!function_exists('CanSoDuMbNoel')) {
        function CanSoDuMbNoel($image, $text, $font, $size, $color, $vnd_font, $vnd_size, $vnd_color, $y, $x, $name)
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
    }
    if (!function_exists('CanThoiGianMbNoel')) {
        function CanThoiGianMbNoel($image, $text, $font, $size, $color, $y) {
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
    }

    $width = imagesx($image);
    $height = imagesy($image);
    $dest_img = imagecreatetruecolor($width, $height);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);

    CanSoDuMbNoel($dest_img, FormatNumber::TD($sodu, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 45, imagecolorallocate($dest_img, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, 255, 255, 255), 616, 460, '  VND');
    CanThoiGianMbNoel($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 33, imagecolorallocate($dest_img, 255, 255, 255), 85);    

    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    imagedestroy($image);
    $namebill = ['MB Bank Noel', 'Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
