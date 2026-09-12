<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-vcb') {
    $ctk = $_POST["ctk"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/sodu-vcb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
    // imagettftext($image, 22, 0, 150, 545, imagecolorallocate($image, 255, 255, 255), $fontPath . 'Inter/Inter-SemiBold.ttf', $ctk);
    imagettftext($dest_img, 25, 0, 155, 550, imagecolorallocate($dest_img, 255, 255, 255), $fontPath . 'Inter/Inter-SemiBold.ttf', $ctk);
    $balance = $sodu;
    $vndFont = $fontPath . '/Snv Becker Regular/Snv Becker Regular.ttf';
    $balanceSize = 30;
    $balanceBox = imagettfbbox($balanceSize, 0, $vndFont, number_format($balance));
    $balanceWidth = $balanceBox[2] - $balanceBox[0];
    $balanceX = 253;
    $balanceY = 681;
    imagettftext($dest_img, $balanceSize, 0, $balanceX, $balanceY, imagecolorallocate($dest_img, 255, 255, 255), $vndFont, number_format($balance));
    $vndX = $balanceX + $balanceWidth - 5;
    $smallImagePath = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/icon/bank/addon/eye.png';
    $smallImage = imagecreatefrompng($smallImagePath);
    $desiredWidth = 120; 
    $originalWidth = imagesx($smallImage);
    $originalHeight = imagesy($smallImage);
    $aspectRatio = $originalHeight / $originalWidth;
    $desiredHeight = (int)round($desiredWidth * $aspectRatio);
    $resizedSmallImage = imagescale($smallImage, $desiredWidth, $desiredHeight);
    if ($resizedSmallImage !== false) {
    $smallImageWidth = imagesx($resizedSmallImage);
    $smallImageHeight = imagesy($resizedSmallImage);
    $smallImageX = $vndX + 20; 
    $smallImageY = $balanceY - $smallImageHeight + 13;
    imagecopy($dest_img, $resizedSmallImage, $smallImageX, $smallImageY, 0, 0, $smallImageWidth, $smallImageHeight);
    imagedestroy($resizedSmallImage);
    }
    imagedestroy($smallImage);
    $accountNumber = $stk;
    $accountFont = $fontPath . '/Snv Becker Regular/Snv Becker Regular.ttf';
    $accountSize = 27;
    $spacing = 5; 
    $accountX = 258;
    $accountY = 612;
    for ($i = 0; $i < strlen($accountNumber); $i++) {
    $char = $accountNumber[$i];
    imagettftext($dest_img, $accountSize, 0, $accountX, $accountY, imagecolorallocate($dest_img, 255, 255, 255), $accountFont, $char);
    $charBox = imagettfbbox($accountSize, 0, $accountFont, $char);
    $charWidth = $charBox[2] - $charBox[0];
    $accountX += $charWidth + $spacing;
    }
    $vndX = $accountX + $charWidth - 10;
    $smallImagePath = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/icon/bank/addon/iconcoppy.png';
    $smallImage = imagecreatefrompng($smallImagePath);
    $smallImageWidth = imagesx($smallImage);
    $smallImageHeight = imagesy($smallImage);
    $smallImageX = $vndX + 5; 
    $smallImageY = $accountY - $smallImageHeight + 10;
    imagecopy($dest_img, $smallImage, $smallImageX, $smallImageY, 0, 0, $smallImageWidth, $smallImageHeight);
    imagedestroy($smallImage);
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 35, imagecolorallocate($dest_img, 0, 1, 2), 85);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['Vcb','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }