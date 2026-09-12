<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'viettel-money') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk =$_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $kieuchuyen = $_POST["kieuchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'viettel-money.png' : 'viettel-money-chi-tiet.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.($nganhangnhan==='MB Bank' ? 'mb-text' : strtolower($nganhangnhan)).'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefrompng($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    if (!file_exists($iconBankPath)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Ngân hàng nhận không hợp lệ."]));
    } else{
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 60)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = $imageWidth - $textWidth - $customX;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text, $currencyFont, $currencySize) {
            $fontSize = (int)$fontsize; 
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = (int)(($imageWidth - $textWidth) / 2); 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
            $currency = " đ";
            $currencyBoundingBox = imagettfbbox($currencySize, 0, $currencyFont, $currency);
            $currencyWidth = $currencyBoundingBox[2] - $currencyBoundingBox[0];
            $currencyX = $x + $textWidth - 2; 
            $currencyY = $y;
            imagettftext($image, $currencySize, 0, $currencyX, $currencyY, $textColor, $currencyFont, $currency);
        }
        
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_tcb; 
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
            $x = $imageWidth - $totalWidth - 60;
            $iconY = $y - $vtBankHeight + $iconOffsetY;
            imagecopy($image, $iconVtBankResized, $x, $iconY, 0, 0, $vtBankWidth, $vtBankHeight);
            imagettftext($image, $fontSize, 0, $x + $vtBankWidth + 15, $y, $textColor, $font, $nganhangnhan);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
            imagedestroy($iconVtBank);
            imagedestroy($iconVtBankResized);
        }
        function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen($text);
            if ($textLength > 20) {
                $maxCharsPerLine = 30; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 60;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
        function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
        {
            $imageWidth = imagesx($image);
            $maxWidth = $imageWidth - 282;
            $words = explode(' ', $text);
            $currentLine = '';
            $lines = [];
            foreach ($words as $word) {
                $tempLine = $currentLine.(empty($currentLine) ? '' : ' ').$word;
                $tempLineBoundingBox = imagettfbbox($fontsize, 0, $font, $tempLine);
                $tempLineWidth = $tempLineBoundingBox[2] - $tempLineBoundingBox[0];
                if ($tempLineWidth > $maxWidth) {
                    $lines[] = $currentLine;
                    $currentLine = $word;
                } else {
                    $currentLine = $tempLine;
                }
            }
            if (!empty($currentLine)) {
                $lines[] = $currentLine;
            }
            if (count($lines) > 3) {
                $secondLineWidth = imagettfbbox($fontsize, 0, $font, $lines[1])[2] - imagettfbbox($fontsize, 0, $font, $lines[1])[0];
                $thirdLine = $lines[2];
                while (imagettfbbox($fontsize, 0, $font, $thirdLine.'...')[2] - imagettfbbox($fontsize, 0, $font, $thirdLine)[0] > $secondLineWidth) {
                $thirdLine = substr($thirdLine, 0, -1);
                }
                $lines[2] = trim($thirdLine).'...';
                $lines = array_slice($lines, 0, 3);
            }
            foreach ($lines as $index => $line) {
                $x = 225; 
                $currentY = $y + ($index * ($fontsize + 15));
                imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
            }
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
        $bankSize = $bankIconSizes[strtolower($nganhangnhan)] ?? ['width' => 36, 'height' => 36];
        $fullnamebank = isset($vtmoney[$nganhangnhan]) ? $vtmoney[$nganhangnhan]['fullname'] : '';
        canchinhgiua($image, 71,1037, imagecolorallocate($image, 34,34,34), $fontPath . 'common/Inter/Inter-Bold.otf', FormatNumber::TD($sotienchuyen, 1), $fontPath . 'common/Inter/Inter-Regular.otf', 38);
        canchinhphai($image, 37, 1175, imagecolorallocate($image, 34,34,34), $fontPath.'common/Inter/Inter-Medium.otf', $tennguoinhan);
        canchinhphai($image, 37, 1260, imagecolorallocate($image, 34,34,34), $fontPath.'common/Inter/Inter-Medium.otf', $stk);
        canletrai($image, 36, 83, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 110);
        canchinhphai_banks(
            $image,
            1355,
           imagecolorallocate($image, 34,34,34),    // Mau chu
            $fontPath.'common/Inter/Inter-Medium.otf', // $font path
            $iconBankPath,                             // Icon path
            $nganhangnhan,                             // Ngan hang nhan
            37,                                        // Font size
            8,                                         // Lên xuống icon bank
            $bankSize['width'],                                        // Chiều dài icon bank
            $bankSize['height'],                                        // Chiều cao icon bank
            55,                                        // Chiều dài viền tròn
            55                                         // Chiều cao vòng tròn
        );
        canchinhphai_noidung($image, 33, 1440, imagecolorallocate($image, 34,34,34), $fontPath.'common/Inter/Inter-Medium.otf', $noidungchuyen,1.3);
        if ($kieuchuyen==='chitiet') {
        canchinhphai($image, 33, 1807, imagecolorallocate($image, 34,34,34), $fontPath.'common/Inter/Inter-Medium.otf', $thoigianchuyen);
        }
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['Viettel Money','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
}