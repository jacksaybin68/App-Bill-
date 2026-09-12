<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'tpbank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk_nc = FormatNumber::STK($_POST["stk_nc"]);
    $stk = FormatNumber::STK($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $cachthucchuyen = $_POST["cachthucchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/tpbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1.4);
    }    
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - 117;
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
        function canletrai_bank($image, $fontsize, $y, $textColor, $font, $text, $x_offset = 259)
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
            $newIconWidth = 83;
            $newIconHeight = 83; 
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconBank, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $x = 109; 
            $y = 1156;
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
        if (isset($_FILES['avatar'])) {
         drawUserAvatar($image, $_FILES['avatar']);
        }
        drawBankIcon($image, $iconBankPath);
        canletrai_bank($image, 26, 990, imagecolorallocate($image, 44, 30, 80), $fontPath.'/FzRubik-Regular.ttf', $tennguoichuyen);
        canletrai_bank($image, 24, 1035, imagecolorallocate($image,123,127,155), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $stk_nc);
        canletrai_bank($image, 24, 1235, imagecolorallocate($image,123,127,155), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $stk.' | '.strtoupper($nganhangnhan));
        canletrai_bank($image, 26, 1188, imagecolorallocate($image, 44, 30, 80), $fontPath.'/FzRubik-Regular.ttf', $tennguoinhan);
        canchinhgiua($image, 56, 730, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Noto Sans/NotoSansGeorgian-Regular.ttf',FormatNumber::TD($sotienchuyen,2).' VND');
        canchinhphai($image, 28, 1598, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $thoigianchuyen);
        canletrai($image, 37, 90, imagecolorallocate($image, 255,255,255), $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf', $thoigiantrendt, 100);
        canchinhphai($image, 28, 1361, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $magiaodich);
        canchinhphai($image, 28, 1480, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $noidungchuyen);
        canchinhphai($image, 28, 1720, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $cachthucchuyen);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['TP Bank','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}