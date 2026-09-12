<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'mbbank-noel') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    // $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $stkchinh = FormatNumber::PREG($_POST["stkchinh"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $kieuchuyen = $_POST["kieuchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'mb-noel.jpg' : 'mb-noel-bdsd.jpg');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefromjpeg($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30);
    }    
    //====== SETTING PHỤ TRỢ ======//
    $marginRightOption = 64; // Trái Phải
    $marginTopOption = 45; // Lên Xuống
    $sizeSignal = [55, 35]; // Vạch sóng
    $sizeWifi = [50, 35];   // Wi-Fi
    $sizePin = [75, 35];    // Pin
    $fontSizeTinHieu = 31;  // Tín hiệu
    $displayTinHieu = 'dark';  // Light - Dark Tín Hiệu
    $sizeDynamics = [505, 170]; // Disnamics
    //=============================//
    // Điều chỉnh lên/xuống riêng (0 là mặc định)
    $yOffsetSignal = 0; // Lên Xuống
    $yOffsetWifi = 0; // Lên Xuống
    $yOffsetMangText = 22; // Lên Xuống
    $yOffsetMang = 17; // Lên Xuống
    $yOffsetPin = 0; // Lên Xuống
    //============KHOẢNG CÁCH=======//
    $spacingCombo = 14;
    //=============================//
    if (!file_exists($iconBank)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Ngân hàng nhận không hợp lệ."]));
    } else {
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
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
            $imageWidth = imagesx($image);
            $x = (int) (($imageWidth - $textWidth) / 2);
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }

        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
        }

        function cangiua_nganhang($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 8)
        {
            $icon = imagecreatefrompng($iconBank);
            list($iconWidth, $iconHeight) = [73, 73];
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));

            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $name_bank);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $iconWidth + 20 + $textWidth;
            $x = ($imageWidth - $totalWidth) / 2;
            $iconY = $y - $iconHeight + $iconOffsetY;
            imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
            imagettftext($image, $fontSize, 0, round($x + $iconWidth +22), round($y), $textColor, $font, $name_bank);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
        $mbbank = [
            'vietinbank' => 'Vietinbank (CTG)',
            'vietcombank' => 'Vietcombank (VCB)',
            'techcombank' => 'Techcombank (TCB)',
            'acbbank' => 'ACB',
            'agribank' => 'Agribank (ARB)',
            'bidv' => 'BIDV (BIDV)',
            'sacombank' => 'Sacombank (STB)',
            'mbbank' => 'MBBank (MB)',
            'namabank' => 'NamABank',
            'dongabank' => 'DongABank',
            'ocb' => 'OCB',
            'tpbank' => 'TP Bank (TPB)',
            'vpbank' => 'VP Bank (VPB)',
            'sgb' => 'Saigonbank (SGB)',
            'vib' => 'VIB',
            'seabank' => 'SeAbank',
        ];
        $name_bank = isset($mbbank[$nganhangnhan]) ? $mbbank[$nganhangnhan].' - '.$stk : ucfirst($nganhangnhan).' - '.$stk;
        // function BDSD($image, $text, $x, $y, $fontSize, $fontFile, $color, $margin) {
        //     $imageWidth = imagesx($image);
        //     $maxLineWidth = $imageWidth - 2 * $margin;
        //     $lines = [];
        //     $currentLine = '';
        //     $words = explode(' ', $text);
        //     foreach ($words as $word) {
        //         $testLine = $currentLine.' '.$word;
        //         $textBox = imagettfbbox($fontSize, 0, $fontFile, $testLine);
        //         $textWidth = $textBox[2] - $textBox[0];
        //         if ($textWidth > $maxLineWidth) {
        //             $lines[] = trim($currentLine);
        //             $currentLine = $word;
        //         } else {
        //             $currentLine = $testLine;
        //         }
        //     }
        //     $lines[] = trim($currentLine);
        //     foreach ($lines as $line) {
        //         imagettftext($image, $fontSize, 0, intval($x), intval($y), $color, $fontFile, $line);
        //         $y += intval($fontSize * 1.5);
        //     }
        // }
        function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
        {
            $imageWidth = imagesx($image);
            $maxWidth = $imageWidth - 300;
            $maxWidthSecondLine = $imageWidth - 300;
            $words = explode(' ', $text);
            $currentLine = '';
            $lines = [];
            foreach ($words as $word) {
                $tempLine = $currentLine . (empty($currentLine) ? '' : ' ') . $word;
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
            if (count($lines) > 1) {
                $secondLine = $lines[1];
                if (mb_strlen($secondLine, 'UTF-8') > 50) {
                    $secondLine = mb_substr($secondLine, 0, 50, 'UTF-8');
                }
                $secondLine .= '...';
                $secondLineBoundingBox = imagettfbbox($fontsize, 0, $font, $secondLine);
                $secondLineWidth = $secondLineBoundingBox[2] - $secondLineBoundingBox[0];
                if ($secondLineWidth > $maxWidthSecondLine) {
                    while (imagettfbbox($fontsize, 0, $font, $secondLine)[2] - imagettfbbox($fontsize, 0, $font, $secondLine)[0] > $maxWidthSecondLine) {
                        $secondLine = mb_substr($secondLine, 0, -4, 'UTF-8') . '...';
                    }
                }
                $lines[1] = $secondLine;
                $lines = array_slice($lines, 0, 2);
            }
            foreach ($lines as $index => $line) {
                $x = 218;
                $currentY = $y + ($index * ($fontsize + 20));
                imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
            }
        }
        canletrai($image, 42, 103, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt,136);
        if ($kieuchuyen!=='macdinh') {
        canchinhbdsd($image, 33, 314, imagecolorallocate($image, 0,0,0), $fontPath.'Inter-Regular.ttf', "TK ".FormatStk($stkchinh)."|GD: -".FormatNumber::TD($sotienchuyen, 2)."VND ".DateTime::createFromFormat('H:i - d/m/Y', $thoigianchuyen)->format('d/m/y H:i')." |SD: ".FormatNumber::TD($soduchinh, 2)."VND|DEN: ".$tennguoinhan." - $stk"." |".$noidungchuyen);
        }
        canchinhgiua($image, 63, 830, imagecolorallocate($image, 14,166,120), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
        canchinhgiua($image, 28, 920, imagecolorallocate($image, 113,117,116), $fontPath.'common/Roboto/Roboto-Regular.ttf', $thoigianchuyen);
        canchinhgiua($image, 45, 1200, imagecolorallocate($image, 50,51,53), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan);
        cangiua_nganhang($image, 1298, imagecolorallocate($image, 31,48,57), $fontPath.'common/Roboto/Roboto-Regular.ttf', $iconBank, $name_bank, 34, 17);
        canchinhgiua($image, 34, 1390, imagecolorallocate($image, 31,48,57), $fontPath.'common/Roboto/Roboto-Regular.ttf', $noidungchuyen);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['MB Bank Noel','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
}