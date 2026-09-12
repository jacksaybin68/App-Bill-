<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'zalopay') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phigiaodich = $_POST["phigiaodich"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/zalopay.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        if ($customX) {
            $x = $imageWidth - $textWidth - 120;
        } else {
            $x = ($customX == null) ? ($imageWidth - $textWidth - 170) : $customX;
        }
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
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
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = (int)$fontsize; 
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = (int)(($imageWidth - $textWidth) / 2); 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_tcb; 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2)
        {
            $lines = explode("\n", $text);
            $imageWidth = imagesx($image);

            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 85;

                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
        function canletrai_bank($image, $fontsize, $y, $textColor, $font, $text, $x_offset = 285)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_offset;
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function drawBankIcon($image, $iconBankPath) {
            $iconBank = imagecreatefrompng($iconBankPath);
            $iconWidth = imagesx($iconBank);
            $iconHeight = imagesy($iconBank);
            $newIconWidth = 92;
            $newIconHeight = 92; 
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconBank, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $x = 155; 
            $y = 1652;
            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
            imagedestroy($iconBank);
        }
        function drawUserAvatar($image, $avatarPath) {
            if (empty($avatarPath['tmp_name'])) {
                return; 
            }
            $avatar = imagecreatefromjpeg($avatarPath['tmp_name']);
            $avatarWidth = imagesx($avatar);
            $avatarHeight = imagesy($avatar);
            $newAvatarWidth = 100;
            $newAvatarHeight = 100;
            $resizedAvatar = imagecreatetruecolor($newAvatarWidth, $newAvatarHeight);
            imagealphablending($resizedAvatar, false);
            imagesavealpha($resizedAvatar, true);
            imagecopyresampled($resizedAvatar, $avatar, 0, 0, 0, 0, $newAvatarWidth, $newAvatarHeight, $avatarWidth, $avatarHeight);
            $x = 50;
            $y = 50;
            imagecopy($image, $resizedAvatar, $x, $y, 0, 0, $newAvatarWidth, $newAvatarHeight);
            imagedestroy($avatar);
        }
        drawBankIcon($image, $iconBankPath);
        canletrai($image, 31, 1620, imagecolorallocate($image, 28,47,74), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $tennguoinhan,152);
        canletrai($image, 70, 972, imagecolorallocate($image, 0,52,200), $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf', FormatNumber::TD($sotienchuyen,1).'đ',151);
        canletrai($image, 31, 1148, imagecolorallocate($image, 28,47,74), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $phigiaodich,152);
        canletrai_bank($image, 28, 1680, imagecolorallocate($image, 16,45,77), $fontPath.'/common/Roboto/Roboto-Regular.ttf', 'STK: '.$stk);
        canletrai_bank($image, 28, 1742, imagecolorallocate($image,16,45,77), $fontPath.'/common/Roboto/Roboto-Regular.ttf', ucwords($nganhangnhan));
        canchinhgiua($image, 64, 696, imagecolorallocate($image, 0,28,63), $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf',FormatNumber::TD($sotienchuyen,1).'đ');
        canchinhphai($image, 29, 2265, imagecolorallocate($image, 101,121,139), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $thoigianchuyen);
        canletrai($image, 37, 90, imagecolorallocate($image, 255,255,255), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 100);
        canletrai($image, 31, 1952, imagecolorallocate($image, 28,47,74), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $noidungchuyen,153);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['Ví Zalopay','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}