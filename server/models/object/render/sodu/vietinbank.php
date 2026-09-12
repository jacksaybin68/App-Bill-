<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-vietinbank') {
    $ctk = $_POST["ctk"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/vietinbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    } 
     CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function CanChuTaiKhoan($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 320;
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
    function CanSoTaiKhoan($image, $text, $font, $size, $color, $y) {
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
    
    function CanSoDu($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 100;
        $right_padding = 10; 
        $image_width = imagesx($image);
        
        $formatted_text = number_format($text) . ' VND';
        
        $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;
        
        if ($text_width + $fixed_left_position + $right_padding > $image_width) {
            $text_left_margin = $image_width - $text_width - $right_padding;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
    }

    function CanThoiGian($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 77;
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
    CanChuTaiKhoan($dest_img, $ctk, $fontPath.'vietinbank/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 255, 255, 255), 400);
    CanSoTaiKhoan($dest_img, $stk, $fontPath.'vietinbank/URWGeometricSemiBold.otf', 32, imagecolorallocate($dest_img, 18, 36, 57), 740);
    CanSoDu($dest_img, $sodu, $fontPath.'vietinbank/SVN-Gilroy Bold.otf', 43, imagecolorallocate($dest_img, 43, 86, 133), 868);
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 35, imagecolorallocate($dest_img, 255, 255, 255), 85);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['Vietinbank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
