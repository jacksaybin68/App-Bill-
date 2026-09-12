<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'acb-privilege') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $stkgui =$_POST["stkgui"];
    $stknhan =$_POST["stknhan"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/acb-privilege.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__.'/';
    $image = imagecreatefromjpeg($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
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
    function canlephai($image, $fontsize, $y, $textColor, $font, $text, $wrap = false) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 500;
        $x = 444;
        if ($wrap) {
            $words = explode(' ', $text);
            $line = '';
            $yOffset = 0;
            foreach ($words as $word) {
                $testLine = $line . ($line ? ' ' : '') . $word;
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $testLine);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                if ($textWidth > $maxWidth) {
                    imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
                    $line = $word;
                    $yOffset += 48;
                } else {
                    $line = $testLine;
                }
            }
            if ($line) {
                imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
            }
            return $yOffset + 48; 
        } else {
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            if ($textWidth + $x > imagesx($image)) {
                $x = 443;
            }
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
            return 48;
        }
    }
    
    // function canletrai($image, $x, $y, $maxWidth, $color, $font, $text, $fontSize, $wrap = 58) {
    //     $text = str_replace(',', '', $text);
    //     if ($wrap === true) {
    //         $wrappedText = wordwrap($text, 55, "\n", true); 
    //         $lines = explode("\n", $wrappedText);
    //         foreach ($lines as $line) {
    //             imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $line);
    //             $y += 48; 
    //         }
    //     } else {
    //         imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
    //     }
    // }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_tcb; 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
    function cansatletrai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 200;
        $x = 58;
        $words = explode(' ', $text);
        $line = '';
        $yOffset = 0;
        foreach ($words as $word) {
            $testLine = $line . ($line ? ' ' : '') . $word;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $testLine);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            if ($textWidth > $maxWidth) {
                imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
                $line = $word;
                $yOffset += 60;
            } else {
                $line = $testLine;
            }
        }
        if ($line) {
            imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
        }
    }
    function canlethoigian($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = (int)$fontsize;
        $x = (int)$x_tcb; 
        $y = (int)$y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    
    $yPosition1 = 1565;
    $yPosition2 = $yPosition1 + 65;
    $YNganHang = 1162;
    imagettftext($image, 25, 0, 330, 720, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Regular.ttf', $stkgui);
    imagettftext($image, 27, 0, 330, 1128, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Medium.ttf', $magiaodich);
    imagettftext($image, 27, 0, 330, 785, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Bold.ttf', $tennguoinhan);
    // canchinhphai2($image, 25, 835, imagecolorallocate($image, 68, 75, 81), $fontPath.'/common/Helvetica/Helvetica-Bold.ttf', $tennguoinhan);
    imagettftext($image, 27, 0, 330, 670, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Bold.ttf', $tennguoichuyen);
    imagettftext($image, 30, 0, 330, 995, imagecolorallocate($image, 68, 75, 81), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
    imagettftext($image, 24, 0, 330, 885, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Regular.ttf', $stknhan);
    imagettftext($image, 25, 0, 330, 835, imagecolorallocate($image, 68, 75, 81), $fontPath . '/Inter/Inter-Regular.ttf', $nganhangnhan);

    
    // $NganHangNhan = canlephai($image, 32, $YNganHang, imagecolorallocate($image, 52, 63, 67), $fontPath.'/Inter/Inter-Regular.ttf', $nganhangnhan, true);
    // $y_stk = ($NganHangNhan > 48) ? 3 : 9;
    // canlephai($image, 31, $YNganHang + $NganHangNhan + $y_stk, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Inter/Inter-Regular.ttf', $stkgui);    
    // canlephai($image, 27, 1128, imagecolorallocate($image, 49,60,69), $fontPath.'/Inter/Inter-Medium.ttf', $thoigianchuyen, 330);
    // canlephai($image, 31, $YNganHang + $NganHangNhan + $y_stk, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Inter/Inter-Regular.ttf', $stknhan);    
    // canlephai($image, 36, 1540, imagecolorallocate($image, 68, 75, 81), $fontPath.'/Inter/Inter-Medium.ttf', $magiaodich);
    canletrai($image, 45, 505, imagecolorallocate($image, 0,117,255), $fontPath.'/Inter/Inter-Bold.ttf', FormatNumber::TD($sotienchuyen) . ' VND', 60);
    canletrai($image, 28, 560, imagecolorallocate($image, 128,131,171), $fontPath.'/Inter/Inter-Regular.ttf', ucfirst(convert_number_to_words($sotienchuyen)), 62);
    // cansatletrai($image, 38, 1770, imagecolorallocate($image, 68,71,85), $fontPath.'/common/Helvetica/Helvetica.ttf', $noidungchuyen.'-'.WsRandomString::Number(6).'-'.substr($thoigianchuyen, strpos($thoigianchuyen, ", ") + 2).' '.WsRandomString::Number(6));
    cansatletrai($image, 29, 1310, imagecolorallocate($image, 68, 75, 81), $fontPath.'/Inter/Inter-Regular.ttf', $noidungchuyen, 58);
    canlethoigian($image, 32, 78, imagecolorallocate($image, 255, 255, 255), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 115);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['ACB Privilege','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}