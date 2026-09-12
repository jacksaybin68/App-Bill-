<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'vcb-galaxy') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk =$_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $kieuchuyen = $_POST["kieuchuyen"];
    // $bdsd= $_POST["bdsd"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/vcb-galaxy.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = @imagecreatefrompng($phoiBank);
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $iconBankPath = $kieuchuyen === 'trongbank' ? $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/vietcombank.png': $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
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
        
        function canlephai_banks($image, $y, $textColor, $font, $iconBankPath, $nganhang_stk, $fullname, $fontSize, $fullnameFont, $fullnameColor, $iconOffsetY = 5, $iconWidth = 40, $iconHeight = 40, $vtBankWidth = 80, $vtBankHeight = 80)
        {
            global $kieuchuyen;
            $iconVtBank = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/vt-bank.png');
            $iconVtBankResized = imagecreatetruecolor($vtBankWidth, $vtBankHeight);
            // imagealphablending($iconVtBankResized, false);
            // imagesavealpha($iconVtBankResized, true);
            $transparent = imagecolorallocatealpha($iconVtBankResized, 0, 0, 0, 127);
            imagefill($iconVtBankResized, 0, 0, $transparent);
            imagecopyresampled($iconVtBankResized, $iconVtBank, 0, 0, 0, 0, $vtBankWidth, $vtBankHeight, imagesx($iconVtBank), imagesy($iconVtBank));
            $icon = imagecreatefrompng($iconBankPath);
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            $transparent = imagecolorallocatealpha($resizedIcon, 0, 0, 0, 127);
            imagefill($resizedIcon, 0, 0, $transparent);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
            $iconBankX = ($vtBankWidth - $iconWidth) / 2;
            $iconBankY = ($vtBankHeight - $iconHeight) / 2;
            imagecopy($iconVtBankResized, $resizedIcon, (int)$iconBankX, (int)$iconBankY, 0, 0, (int)$iconWidth, (int)$iconHeight);
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $nganhang_stk);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $vtBankWidth + 10 + $textWidth;
            $x = $imageWidth - $totalWidth - 46;
            $iconY = $y - $vtBankHeight + $iconOffsetY;
            imagecopy($image, $iconVtBankResized, $x, $iconY, 0, 0, $vtBankWidth, $vtBankHeight);
            imagettftext($image, $fontSize, 0, $x + $vtBankWidth + 10, $y, $textColor, $font, $nganhang_stk);
            $fullnameFontSize = $fontSize - ($kieuchuyen==='trongbank' ? 7 : 6); 
            $fullnameBoundingBox = imagettfbbox($fullnameFontSize, 0, $fullnameFont, $fullname);
            $fullnameWidth = $fullnameBoundingBox[2] - $fullnameBoundingBox[0];
            $fullnameX = $imageWidth - $fullnameWidth - 46;
            $fullnameY = $y + 46;
            imagettftext($image, $fullnameFontSize, 0, $fullnameX, $fullnameY, $fullnameColor, $fullnameFont, $fullname);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
            imagedestroy($iconVtBank);
            imagedestroy($iconVtBankResized);
        }
        function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen($text);
            if ($textLength > 27) {
                $maxCharsPerLine = 25; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 50;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
        // function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
        // {
        //     $imageWidth = imagesx($image);
        //     $maxWidth = $imageWidth - 282;
        //     $words = explode(' ', $text);
        //     $currentLine = '';
        //     $lines = [];
        //     foreach ($words as $word) {
        //         $tempLine = $currentLine.(empty($currentLine) ? '' : ' ').$word;
        //         $tempLineBoundingBox = imagettfbbox($fontsize, 0, $font, $tempLine);
        //         $tempLineWidth = $tempLineBoundingBox[2] - $tempLineBoundingBox[0];
        //         if ($tempLineWidth > $maxWidth) {
        //             $lines[] = $currentLine;
        //             $currentLine = $word;
        //         } else {
        //             $currentLine = $tempLine;
        //         }
        //     }
        //     if (!empty($currentLine)) {
        //         $lines[] = $currentLine;
        //     }
        //     if (count($lines) > 3) {
        //         $secondLineWidth = imagettfbbox($fontsize, 0, $font, $lines[1])[2] - imagettfbbox($fontsize, 0, $font, $lines[1])[0];
        //         $thirdLine = $lines[2];
        //         while (imagettfbbox($fontsize, 0, $font, $thirdLine.'...')[2] - imagettfbbox($fontsize, 0, $font, $thirdLine)[0] > $secondLineWidth) {
        //         $thirdLine = substr($thirdLine, 0, -1);
        //         }
        //         $lines[2] = trim($thirdLine).'...';
        //         $lines = array_slice($lines, 0, 3);
        //     }
        //     foreach ($lines as $index => $line) {
        //         $x = 225; 
        //         $currentY = $y + ($index * ($fontsize + 15));
        //         imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
        //     }
        // }
        function canlephai($image, $fontsize, $y, $textColor, $font, $text)
        {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $x = imagesx($image) - 50 - $textWidth;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }


        if ($kieuchuyen === 'ngoaibank') {
        $vcbbank = [
            'vietinbank' => ['name' => 'Vietinbank', 'fullname' => 'Ngân hàng Công Thương Việt Nam'],
            'techcombank' => ['name' => 'Techcombank', 'fullname' => 'Ngân hàng Kỹ Thương Việt Nam'],
            'acbbank' => ['name' => 'ACB', 'fullname' => 'Ngân hàng TMCP Á Châu'],
            'agribank' => ['name' => 'Agribank', 'fullname' => 'Ngân hàng Nông thôn Việt Nam'],
            'bidv' => ['name' => 'BIDV', 'fullname' => 'Ngân hàng Đầu tư và phát triển Việt Nam'],
            'msb' => ['name' => 'MSB', 'fullname' => 'Ngân hàng TMCP Hàng Hải Việt Nam'],
            'sacombank' => ['name' => 'Sacombank', 'fullname' => 'Ngân hàng Sài Gòn Thương Tín'],
            'mbbank' => ['name' => 'MB', 'fullname' => 'Ngân hàng Quân đội'],
            'namabank' => ['name' => 'Nam Á Bank', 'fullname' => 'Ngân hàng thương mại cổ phần Nam Á'],
            'ocb' => ['name' => 'OCB', 'fullname' => 'Ngân Hàng TMCP Phương Đông'],
            'tpbank' => ['name' => 'TP Bank', 'fullname' => 'Ngân hàng Cổ phần Tiên Phong'],
            'vpbank' => ['name' => 'VP Bank', 'fullname' => 'Ngân hàng Việt Nam Thịnh Vượng'],
            'shb' => ['name' => 'SHB', 'fullname' => 'Ngân hàng TMCP Sài Gòn Hà Nội'],
            'sgb' => ['name' => 'MSB', 'fullname' => 'Ngân hàng Sài Gòn Công Thương'],
            'oceanbank' => ['name' => 'OceanBank', 'fullname' => 'Ngân hàng Đại Dương'],
        ];
        $nganhang_stk = isset($vcbbank[$nganhangnhan]) ? strtoupper($vcbbank[$nganhangnhan]['name']) : strtoupper($nganhangnhan);
        $fullnamebank = isset($vcbbank[$nganhangnhan]) ? $vcbbank[$nganhangnhan]['fullname'] : '';
        } else {
            $nganhang_stk = 'Vietcombank';
            $fullnamebank = 'Ngân hàng TMCP Ngoại thương Việt Nam';
        }
        $stc = FormatNumber::TD($sotienchuyen, 2);
        $vnd = 'VND';
        $textBox = imagettfbbox(45, 0, $fontPath.'vietcombank/Manrope-Bold.ttf', $stc);
        $textWidth = $textBox[2] - $textBox[0];
        $vndBox = imagettfbbox(22, 0, $fontPath.'vietcombank/SVN-Arial 3.ttf', $vnd);
        $vndWidth = $vndBox[2] - $vndBox[0];
        $imageWidth = imagesx($image);
        $padding = 22;
        $xAmount = ($imageWidth - $textWidth - $vndWidth - $padding) / 2;
        $yAmount = 475;
        $xVND = $xAmount + $textWidth + $padding;
        $yVND = 448;
        $xAmount = round($xAmount);
        $yAmount = round($yAmount);
        $xVND = round($xVND);
        $yVND = round($yVND);
        // if ($bdsd === 'bdsd') {
        //     canchinhbdsd($image, 30, 260, imagecolorallocate($image, 14,15,14), $fontPath.'common/San Francisco/SanFranciscoText-Regular.otf', 'Số dư TK VCB '.$stk_nc.' -'.FormatNumber::TD(FormatNumber::PREG($stc),2).' VND lúc '.date('d-m-Y H:i:s').'.'.' Số dư '.FormatNumber::TD($soduchinh,2).' VND.'.' Ref MBVCB.'.$magiaodich.'.'.WsRandomString::Number(6).'.'.$noidungchuyen);
        // } 
        // $mauthoigian = ($bdsd === 'bdsd') ? imagecolorallocate($image, 255,255,255) : imagecolorallocate($image, 0, 1, 2);
        imagettftext($image, 45, 0, $xAmount, $yAmount, imagecolorallocate($image, 192, 240, 70), $fontPath.'vietcombank/Manrope-Bold.ttf', $stc);
        imagettftext($image, 22, 0, $xVND, $yVND, imagecolorallocate($image, 140,168,132), $fontPath.'vietcombank/SVN-Arial 3.ttf', $vnd);
        canlephai($image, 25, 738, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $tennguoinhan);
        // canchinhphai($image, 25, 656, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $stk);
        canlephai($image, 25, 645, imagecolorallocate($image, 255, 255, 255), $fontPath . 'vietcombank/UTM HelveBold.ttf', $stk);
        canchinhgiua($image, 22, 525, imagecolorallocate($image, 206, 206, 206), $fontPath.'common/Helvetica/Helvetica.ttf', $thoigianchuyen);
        imagettftext($image, 28, 0, 105, 60, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt);
        // canletrai($image, 26, 83, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 110);
        canlephai_banks($image, 823, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $iconBankPath, $nganhang_stk, $fullnamebank, 25, $fontPath.'vietcombank/SVN-Arial 3.ttf', imagecolorallocate($image, 255, 255, 255), 17, 29, 29, 52, 52);
        canchinhphai_noidung($image, 25, 965, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $noidungchuyen, 1.9);
        // canchinhphai($image, 33, 1642, imagecolorallocate($image, 39,39,39), $fontPath.'vietcombank/UTM HelveBold.ttf', 'Miễn phí'.str_repeat(" ",6));
        // canchinhphai($image, 33, 1642, imagecolorallocate($image, 39,39,39), $fontPath.'vietcombank/UTM HelveBold.ttf', 'Miễn phí');
        canlephai($image, 25, 1190, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', 
        $kieuchuyen === 'trongbank' ? 
        "Chuyển tiền trong\n".str_repeat(" ",8)."" : 
        "Chuyển tiền nhanh\n".str_repeat(" ",24).""
         );
        // canchinhphai($image, 25, 1332, imagecolorallocate($image, 255, 255, 255), $fontPath.'vietcombank/UTM HelveBold.ttf', $magiaodich);
        canlephai($image, 25, 1328, imagecolorallocate($image, 255, 255, 255), $fontPath. 'vietcombank/UTM HelveBold.ttf', $magiaodich);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['Vcb-Galaxy','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
