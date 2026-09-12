<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'tpbank-new') {
    // $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    // $stk_nc = FormatNumber::STK($_POST["stk_nc"]);
    $stk = FormatNumber::STK($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    // $cachthucchuyen = $_POST["cachthucchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/tpbank-new.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
        function canletrai_bank($image, $fontsize, $y, $textColor, $font, $text, $x_offset = 60)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_offset;
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function canchinhphai_banks($image, $y, $textColor, $font, $iconBankPath, $nganhangnhan, $fontSize, $iconOffsetY = 5, $iconWidth = 40, $iconHeight = 40, $vtBankWidth = 80, $vtBankHeight = 80)
        {
            $bankIconAlign = [
                'vietcombank'   => ['trai-phai' => 0, 'len-xuong' => 2],
                'vietinbank'    => ['trai-phai' => 1, 'len-xuong' => 1],
                'bidv'          => ['trai-phai' => 0, 'len-xuong' => 1],
                'agribank'      => ['trai-phai' => 0, 'len-xuong' => 2],
                'techcombank'   => ['trai-phai' => 0, 'len-xuong' => 2],
                'mb bank'       => ['trai-phai' => 0, 'len-xuong' => 0],
                'acb'           => ['trai-phai' => 1, 'len-xuong' => 3],
                'sacombank'     => ['trai-phai' => 0, 'len-xuong' => 0],
                'vpbank'        => ['trai-phai' => 0, 'len-xuong' => 2],
                'vib'           => ['trai-phai' => 0, 'len-xuong' => 3],
                'tpbank'        => ['trai-phai' => 1, 'len-xuong' => 3],
                'hdbank'        => ['trai-phai' => 1, 'len-xuong' => 2],
                'ocb'           => ['trai-phai' => 1, 'len-xuong' => 1],
                'shb'           => ['trai-phai' => 0, 'len-xuong' => 1],
                'msb'           => ['trai-phai' => 0, 'len-xuong' => 0],
                'seabank'       => ['trai-phai' => 0, 'len-xuong' => 1],
                'scb'           => ['trai-phai' => 1, 'len-xuong' => 1],
                'namabank'      => ['trai-phai' => 1, 'len-xuong' => 0],
                'kienlongbank'  => ['trai-phai' => 0, 'len-xuong' => 1],
                'saigonbank'    => ['trai-phai' => 0, 'len-xuong' => 1],
                'vietbank'      => ['trai-phai' => 0, 'len-xuong' => 1],
                'oceanbank'     => ['trai-phai' => 1, 'len-xuong' => 1],
                'shinhanbank'   => ['trai-phai' => 1, 'len-xuong' => 1],
            ];
            $offsetX = $bankIconAlign[strtolower($nganhangnhan)]['trai-phai'] ?? 0;
            $offsetY = $bankIconAlign[strtolower($nganhangnhan)]['len-xuong'] ?? 0;                                   
            $iconVtBank = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/vt-bank-3.png');
            $iconVtBankResized = imagecreatetruecolor($vtBankWidth, $vtBankHeight);
            $transparent = imagecolorallocatealpha($iconVtBankResized, 0, 0, 0, 127);
            imagefill($iconVtBankResized, 0, 0, $transparent);
            imagecopyresampled($iconVtBankResized, $iconVtBank, 0, 0, 0, 0, $vtBankWidth, $vtBankHeight, imagesx($iconVtBank), imagesy($iconVtBank));
            $icon = imagecreatefrompng($iconBankPath);
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            $transparent = imagecolorallocatealpha($resizedIcon, 0, 0, 0, 127);
            imagefill($resizedIcon, 0, 0, $transparent);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
            $iconBankX = ($vtBankWidth - $iconWidth) / 2 + $offsetX;
            $iconBankY = ($vtBankHeight - $iconHeight) / 2 + $offsetY;
            imagecopy($iconVtBankResized, $resizedIcon, (int)$iconBankX, (int)$iconBankY, 0, 0, (int)$iconWidth, (int)$iconHeight);
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $nganhangnhan);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $vtBankWidth + 15 + $textWidth;
            $x = $imageWidth - $totalWidth - 362;
            $iconY = $y - $vtBankHeight + $iconOffsetY;
            imagecopy($image, $iconVtBankResized, $x, $iconY, 0, 0, $vtBankWidth, $vtBankHeight);
            imagettftext($image, $fontSize, 0, $x + $vtBankWidth + 15, $y, $textColor, $font, $nganhangnhan);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
            imagedestroy($iconVtBank);
            imagedestroy($iconVtBankResized);
        }
        $bankIconSizes = [
            'agribank'      => ['width' => 32, 'height' => 32],
            'mb bank'      => ['width' => 38, 'height' => 17],
            'vib'      => ['width' => 30, 'height' => 30],
            'tpbank'      => ['width' => 30, 'height' => 30],
            'shb'      => ['width' => 25, 'height' => 25],
            'msb'      => ['width' => 27, 'height' => 27],
            'seabank'      => ['width' => 27, 'height' => 27],
            'vietabank'      => ['width' => 29, 'height' => 29],
            'saigonbank'      => ['width' => 27, 'height' => 27],
        ];
        $bankSize = $bankIconSizes[strtolower($nganhangnhan)] ?? ['width' => 46, 'height' => 46];
        $fullnamebank = isset($tpbank[$nganhangnhan]) ? $tpbank[$nganhangnhan]['fullname'] : '';
        // function drawBankIcon($image, $iconBankPath) {
        //     $iconBank = imagecreatefrompng($iconBankPath);
        //     $iconWidth = imagesx($iconBank);
        //     $iconHeight = imagesy($iconBank);
        //     $newIconWidth = 43;
        //     $newIconHeight = 43; 
        //     $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
        //     imagealphablending($resizedIcon, false);
        //     imagesavealpha($resizedIcon, true);
        //     imagecopyresampled($resizedIcon, $iconBank, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
        //     $x = 417; 
        //     $y = 1325;
        //     imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
        //     imagedestroy($iconBank);
        // }
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
        // drawBankIcon($image, $iconBankPath);
        // canletrai_bank($image, 26, 990, imagecolorallocate($image, 44, 30, 80), $fontPath.'/FzRubik-Regular.ttf', $tennguoichuyen);
        // canletrai_bank($image, 24, 1035, imagecolorallocate($image,123,127,155), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $stk_nc);
        // canchinhphai_banks($image, 30, 1362, imagecolorallocate($image,58,50,74), $fontPath.'/common/Roboto/Roboto-Regular.ttf', $nganhangnhan.' | '.strtoupper($stk));
        canchinhgiua($image, 34, 1268, imagecolorallocate($image, 124,65,184), $fontPath.'/FzRubik-Regular.ttf', $tennguoinhan);
        canchinhgiua($image, 65, 1086, imagecolorallocate($image, 46,34,81), $fontPath.'/common/Noto Sans/NotoSansGeorgian-Regular.ttf',FormatNumber::TD($sotienchuyen,2).' VND');
        canchinhphai($image, 30, 1623, imagecolorallocate($image, 34,30,60), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $thoigianchuyen);
        canletrai($image, 37, 90, imagecolorallocate($image, 0,1,2), $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf', $thoigiantrendt, 100);
        // canchinhphai($image, 28, 1361, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $magiaodich);
        canchinhphai($image, 28, 1532, imagecolorallocate($image, 50,46,72), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $noidungchuyen);
        // canchinhphai($image, 28, 1720, imagecolorallocate($image, 44,30,80), $fontPath.'/common/Roboto/Roboto-Medium.ttf', $cachthucchuyen);
        canchinhphai_banks(
            $image,
            1362,
           imagecolorallocate($image, 40,31,66),    // Mau chu
            $fontPath.'common/Roboto/Roboto-Regular.ttf', // $font path
            $iconBankPath,                             // Icon path
            $nganhangnhan.'  |  '.strtoupper($stk),                            // Ngan hang nhan
            30,                                        // Font size
            20,                                         // Lên xuống icon bank
            $bankSize['width'],                                        // Chiều dài icon bank
            $bankSize['height'],                                        // Chiều cao icon bank
            73,                                        // Chiều dài viền tròn
            73                                         // Chiều cao vòng tròn
        );
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['TP Bank New','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}