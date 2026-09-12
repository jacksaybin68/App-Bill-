<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'acb-new') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $stk =$_POST["stk"];
    $stk_nc = FormatNumber::PREG($_POST["stk_nc"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    // $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $ngayhieuluc = $_POST["ngayhieuluc"];
    // $kieuchuyen = $_POST["kieuchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/acb-new.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
        $x = 435;
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
    
    function canletrai($image, $x, $y, $maxWidth, $color, $font, $text, $fontSize, $wrap = false) {
        $text = str_replace(',', '', $text);
        if ($wrap === true) {
            $wrappedText = wordwrap($text, 55, "\n", true); 
            $lines = explode("\n", $wrappedText);
            foreach ($lines as $line) {
                imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $line);
                $y += 48; 
            }
        } else {
            imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
        }
    }
    function cansatletrai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 200;
        $x = 80;
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
    function canlephai_nganhang($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 200;
        $x = 80;
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
    $yPosition2 = $yPosition1 + 70;
    $YNganHang = 1100;
    // if ($kieuchuyen==='bdsd') {
    // canchinhbdsd($image, 32, 400, imagecolorallocate($image, 16,23,33), $fontPath.'/common/Roboto/Roboto-Regular.ttf', "ACB: TK ".$stk_nc.'(VND)'.' - '.FormatNumber::TD($sotienchuyen,2).' luc '.$thoigiantrendt.' '.date('d/m/Y').'.'.' So du '.FormatNumber::TD($soduchinh,2).'.'.' GD: '.$noidungchuyen.'-'.WsRandomString::Number(6).'-'.substr($thoigianchuyen, strpos($thoigianchuyen, ", ") + 2).' '.WsRandomString::Number(6));
    // }
    canlephai($image, 38, 885, imagecolorallocate($image, 50, 63, 70), $fontPath.'/common/Helvetica/Helvetica-Bold.ttf', $tennguoichuyen);
    canlephai($image, 32, 960, imagecolorallocate($image, 72, 72, 72), $fontPath.'/common/Helvetica/Helvetica.ttf', '*****' . substr($stk_nc, -2));
    canlephai($image, 38, 1036, imagecolorallocate($image, 72, 72, 72), $fontPath.'/common/Helvetica/Helvetica-Bold.ttf', $tennguoinhan);
    $NganHangNhan = canlephai($image, 36, $YNganHang, imagecolorallocate($image, 52, 63, 67), $fontPath.'/common/San Francisco/SanFranciscoText-Regular.otf', $nganhangnhan, true);
    $y_stk = ($NganHangNhan > 450) ? 3 : 9;
    canlephai($image, 34, $YNganHang + $NganHangNhan + $y_stk, imagecolorallocate($image, 72, 72, 72), $fontPath.'/common/Helvetica/Helvetica.ttf', $stk);    
    canlephai($image, 36, 1360, imagecolorallocate($image, 49,60,69), $fontPath.'/common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
    // canlephai($image, 36, 1450, imagecolorallocate($image, 49,60,69), $fontPath.'/common/San Francisco/SanFranciscoText-Semibold.otf', 'Miễn phí');
    canlephai($image, 36, 1448, imagecolorallocate($image, 49,60,69), $fontPath.'/common/San Francisco/SanFranciscoText-Semibold.otf', $ngayhieuluc);
    canlephai($image, 36, 1625, imagecolorallocate($image, 49,60,69), $fontPath.'/common/San Francisco/SanFranciscoText-Semibold.otf', $magiaodich);
    canletrai($image, 80, 670, 660, imagecolorallocate($image, 24, 113, 244), $fontPath.'/acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen) . ' VND', 58);
    canletrai($image, 80, 737, 200, imagecolorallocate($image, 109,118,130), $fontPath.'/common/Helvetica/Helvetica.ttf', ucfirst(convert_number_to_words($sotienchuyen)), 33, true);
    // cansatletrai($image, 38, 1770, imagecolorallocate($image, 68,71,85), $fontPath.'/common/Helvetica/Helvetica.ttf', $noidungchuyen.'-'.WsRandomString::Number(6).'-'.substr($thoigianchuyen, strpos($thoigianchuyen, ", ") + 2).' '.WsRandomString::Number(6));
    cansatletrai($image, 38, 1850, imagecolorallocate($image, 68,71,85), $fontPath.'/common/Helvetica/Helvetica.ttf', $noidungchuyen);
    canlethoigian($image, 39, 90, imagecolorallocate($image, 0, 1, 2), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 111);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['ACB-New','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}