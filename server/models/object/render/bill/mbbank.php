<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'mbbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $gd = FormatNumber::PREG($_POST["gd"]);
    $noidungchuyen = $_POST["noidungchuyen"];
    $stkchinh = FormatNumber::PREG($_POST["stkchinh"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $kieuchuyen = $_POST["kieuchuyen"];
    $chitiet = (int)($_POST['chitiet'] ?? 0);
    $convertGD = [
        1 => ['themeName' => 'macdinh', 'colorTime' => '110,118,133', 'themeDisplay' => 'dark', 'colorMoney' => '33,33,200', 'colorContent' => '49,55,58', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '37,45,66', 'colorMaGiaoDich' => '37,45,66'],
        2 => ['themeName' => 'meothantai', 'colorTime' => '102,98,87', 'themeDisplay' => 'dark', 'colorMoney' => '192,56,34', 'colorContent' => '47,39,37', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '52,24,18', 'colorMaGiaoDich' => '52,24,18'],
        3 => ['themeName' => 'diudang', 'colorTime' => '95,91,96', 'themeDisplay' => 'dark', 'colorMoney' => '227,74,123', 'colorContent' => '47,39,37', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '43,4,24', 'colorMaGiaoDich' => '43,4,24'],
        4 => ['themeName' => 'sweetlove', 'colorTime' => '100,95,101', 'themeDisplay' => 'dark', 'colorMoney' => '93,20,210', 'colorContent' => '46,46,46', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '26,45,49', 'colorMaGiaoDich' => '26,45,49'],
        5 => ['themeName' => 'nammoirucro', 'colorTime' => '114,109,123', 'themeDisplay' => 'dark', 'colorMoney' => '36,39,145', 'colorContent' => '46,46,46', 'colorTimedt' => '255,255,255', 'colorxTenNguoiNhan' => '27,44,52', 'colorMaGiaoDich' => '27,44,52'],
        6 => ['themeName' => 'dreambig', 'colorTime' => '102,99,108', 'themeDisplay' => 'dark', 'colorMoney' => '205,35,126', 'colorContent' => '47,39,37', 'colorTimedt' => '255,255,255', 'colorxTenNguoiNhan' => '40,14,58', 'colorMaGiaoDich' => '40,14,58'],
        7 => ['themeName' => 'mondaymood', 'colorTime' => '98,97,95', 'themeDisplay' => 'dark', 'colorMoney' => '231,77,100', 'colorContent' => '39,69,105', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '36,67,93', 'colorMaGiaoDich' => '36,67,93'],
        8 => ['themeName' => 'tuhaovietnam', 'colorTime' => '109,103,89', 'themeDisplay' => 'dark', 'colorMoney' => '118,11,14', 'colorContent' => '52,17,19', 'colorTimedt' => '255,255,255', 'colorxTenNguoiNhan' => '47,13,14', 'colorMaGiaoDich' => '47,13,14'],
        9 => ['themeName' => 'truongsaxanh', 'colorTime' => '109,103,89', 'themeDisplay' => 'dark', 'colorMoney' => '40,116,55', 'colorContent' => '15,24,34', 'colorTimedt' => '0,1,2', 'colorxTenNguoiNhan' => '26,46,59', 'colorMaGiaoDich' => '26,46,59'],
        10 => ['themeName' => 'pholang', 'colorTime' => '93,101,100', 'themeDisplay' => 'dark', 'colorMoney' => '39,102,181', 'colorContent' => '47,39,37', 'colorTimedt' => '255,255,255', 'colorxTenNguoiNhan' => '12,22,41', 'colorMaGiaoDich' => '12,22,41'],
    ];    
    if (!isset($convertGD[$gd])) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn 1 giao diện MB."]));

    }
    $gdData = $convertGD[$gd] ?? [];
    $themeName = $gdData['themeName'];
    $themeDisplay = $gdData['themeDisplay'];
    list($rDT, $gDT, $bDT) = 
    ($themeName === 'truongsaxanh' && $themeDisplay === 'dark') ? [0, 0, 0] :
    ($chitiet == 0 ? [255, 255, 255] : ($themeDisplay === "dark" ? [0, 0, 0] : [255, 255, 255]));
    list($rTrendT_R, $rTrendT_G, $rTrendT_B) = ($themeDisplay === "dark") ? [0, 0, 0] : [255, 255, 255];
    list($rTime, $gTime, $bTime) = explode(',', $gdData['colorTime']);
    list($rMoney, $gMoney, $bMoney) = explode(',', $gdData['colorMoney']);
    list($rContent, $gContent, $bContent) = explode(',', $gdData['colorContent']);
    list($rTenNguoiNhan, $gTenNguoiNhan, $bTenNguoiNhan) = explode(',', $gdData['colorxTenNguoiNhan']);
    list($rMaGiaoDich, $gMaGiaoDich, $bMaGiaoDich) = explode(',', $gdData['colorMaGiaoDich']);
    $themeFolder = $themeName !== 'macdinh' ? 'theme/mb/' : '';
    if ($themeName !== 'macdinh') {
        if ($chitiet == 1) {
            $fileName = $themeName . ($kieuchuyen !== 'macdinh' ? '-bdsd-chitiet' : '-chitiet') . '.jpeg';
        } else {
            $fileName = $themeName . ($kieuchuyen !== 'macdinh' ? '-bdsd' : '') . '.jpeg';
        }
    } else {
        if ($chitiet == 1) {
            $fileName = $kieuchuyen === 'macdinh' ? 'mb-3-chitiet.png' : 'mb-3-bdsd-chitiet.png';
        } else {
            $fileName = $kieuchuyen === 'macdinh' ? 'mb-3.png' : 'mb-3-bdsd.png';
        }
    }
    
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.$themeFolder.$fileName;
    
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/'.$themeDisplay.'.php';
    $image = ($themeName==='macdinh') ? imagecreatefrompng($phoiBank) : imagecreatefromjpeg($phoiBank) ;
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,16,190);
    }    
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
        function cangiua_nganhang($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 5)
        {
            global $nganhangnhan;
            $bankIcon = [
                'vietinbank'   => ['w' => 42, 'h' => 42, 'x' => 0,  'y' => -1],
                'techcombank'  => ['w' => 43, 'h' => 43, 'x' => 0,  'y' => 0],
                'vietcombank'  => ['w' => 42, 'h' => 42, 'x' => 0,  'y' => -1],
                'acbbank'      => ['w' => 58, 'h' => 58, 'x' => 0, 'y' => 0],
                'agribank'      => ['w' => 38, 'h' => 38, 'x' => 0, 'y' => -3],
                'bidv-bank'    => ['w' => 34, 'h' => 34, 'x' => 0,  'y' => -6],
                'sacombank'    => ['w' => 42, 'h' => 42, 'x' => 0, 'y' => -1],
                'mbv'          => ['w' => 55, 'h' => 28, 'x' => 0, 'y' => -11],
                'mbbank'       => ['w' => 46, 'h' => 46, 'x' => 0, 'y' => 0],
                'vpbank'       => ['w' => 43, 'h' => 38, 'x' => 0,  'y' => -4],
                'tpbank'       => ['w' => 38, 'h' => 38, 'x' => 0,  'y' => -2],
                'vib'          => ['w' => 39, 'h' => 39, 'x' => 0,  'y' => -3],
                'seabank'      => ['w' => 34, 'h' => 34, 'x' => 0,  'y' => -5],
                'ocb-bank'     => ['w' => 37, 'h' => 37, 'x' => 0,  'y' => -5],
                'hdbank'       => ['w' => 43, 'h' => 43, 'x' => 0,  'y' => -2],
                'bacabank-bank'=> ['w' => 41, 'h' => 41, 'x' => 0,  'y' => 0],
                'dongabank'    => ['w' => 36, 'h' => 36, 'x' => 0,  'y' => -4],
                'namabank-bank'=> ['w' => 43, 'h' => 26, 'x' => 0,  'y' => -10],
                'lpbank-bank'  => ['w' => 39, 'h' => 36, 'x' => 0,  'y' => -6],
                'abb-bank'     => ['w' => 45, 'h' => 31, 'x' => 0,  'y' => -7],
                'msb-bank'     => ['w' => 42, 'h' => 27, 'x' => 0,  'y' => -9],
                'shb'          => ['w' => 42, 'h' => 37, 'x' => 0,  'y' => -6],
                'pg-bank'      => ['w' => 35, 'h' => 46, 'x' => 0,  'y' => -1],
                'sg-bank'      => ['w' => 41, 'h' => 41, 'x' => 0, 'y' => -2],
                'ncb-bank'     => ['w' => 45, 'h' => 35, 'x' => 0, 'y' => -7],
                'kienlongbank' => ['w' => 40, 'h' => 40, 'x' => 0, 'y' => -4],
                'vietbank'     => ['w' => 41, 'h' => 41, 'x' => 0, 'y' => -3],
            ];
            $bankKey = strtolower(trim(preg_replace('/\(.*?\)/', '', $nganhangnhan)));
            $iconW = $bankIcon[$bankKey]['w'] ?? 40;
            $iconH = $bankIcon[$bankKey]['h'] ?? 22;
            $iconX = $bankIcon[$bankKey]['x'] ?? 0; 
            $iconY = $bankIcon[$bankKey]['y'] ?? 0;        
            $icon = imagecreatefrompng($iconBank);
            list($iconWidth, $iconHeight) = [$iconW, $iconH];
            if ($iconWidth <= 0 || $iconHeight <= 0) {
                return;
            }
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $name_bank);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $iconWidth + 20 + $textWidth;
            $x = ($imageWidth - $totalWidth) / 2 + $iconX;
            $iconY = $y - $iconHeight + $iconOffsetY + $iconY;
            imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
            imagettftext($image, $fontSize, 0, round($x + $iconWidth + 18), round($y), $textColor, $font, $name_bank);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
        
        $mbbank = [
            'vietinbank' => 'Vietinbank (CTG)',
            'techcombank' => 'Techcombank (TCB)',
            'vietcombank' => 'Vietcombank (VCB)',
            'acbbank' => 'ACB',
            'agribank' => 'Agribank (VBA)',
            'bidv-bank' => 'BIDV',
            'sacombank' => 'Sacombank (STB)',
            'mbv' => 'MBV',
            'mbbank' => 'MBBank (MB)',
            'vpbank' => 'VP Bank (VPB)',
            'tpbank' => 'TP Bank (TPB)',
            'vib' => 'VIB',
            'seabank' => 'SeaBank (SBB)',
            'ocb-bank' => 'OCB',
            'hdbank' => 'HDBank (HDB)',
            'pvcombank' => 'PVcomBank (PVcomBank)',
            'bacabank-bank' => 'Bac A Bank (NASB)',
            'dongabank' => 'DongA Bank (DAB)',
            'namabank-bank' => 'Nam A Bank (NAB)',
            'lpbank-bank' => 'LPBank (LPB)',
            'abb-bank' => 'ABBank (ABB)',
            'msb-bank' => 'Maritime Bank (MSB)',
            'shb' => 'SHB',
            'pg-bank' => 'PG Bank (PGB)',
            'sg-bank' => 'Sai Gon Bank (SGB)',
            'ncb-bank' => 'NCB',
            'kienlongbank' => 'KienlongBank (KLB)',
            'vietbank' => 'VietBank (VB)',
        ];
        $name_bank = $mbbank[$nganhangnhan] ?? 'Chưa chọn ngân hàng';
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
        function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 1)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen(trim($text));
            if ($textLength > 5) {
                $maxCharsPerLine = 20; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 79;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
        function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
        {
            $imageWidth = imagesx($image);
            $maxWidth = $imageWidth - 200;
            $maxWidthSecondLine = $imageWidth - 170;
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
                        $secondLine = mb_substr($secondLine, 0, -4, 'UTF-8').'...';
                    }
                }
                $lines[1] = $secondLine;
                $lines = array_slice($lines, 0, 2);
            }
            foreach ($lines as $index => $line) {
                $x = 145;
                $currentY = $y + ($index * ($fontsize + 22));
                imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
            }
        }
        canletrai($image, 26, 55, imagecolorallocate($image, $rTrendT_R, $rTrendT_G, $rTrendT_B), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt,70);
        if ($kieuchuyen!=='macdinh') {
        canchinhbdsd($image, 21, 176, imagecolorallocate($image, $rDT, $gDT, $bDT), $fontPath.'common/Inter/Inter-Regular.otf', "TK ".FormatStk($stkchinh)."|GD: -".FormatNumber::TD($sotienchuyen, 2)."VND ".DateTime::createFromFormat('H:i - d/m/Y', $thoigianchuyen)->format('d/m/y H:i')." |SD: ".FormatNumber::TD($soduchinh, 2)."VND|DEN: ".$tennguoinhan." - $stk"." |".$noidungchuyen);
        }
        canchinhgiua($image, 45, 520, imagecolorallocate($image, $rMoney, $gMoney, $bMoney), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
        canchinhgiua($image, 20, 580, imagecolorallocate($image, $rTime, $gTime, $bTime), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $thoigianchuyen);
        canchinhgiua($image, 26, 760, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Semibold.otf', $tennguoinhan);
        cangiua_nganhang($image, 820, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $iconBank, $name_bank, 22, $name_bank === 'ACB' ? 17:11);
        canchinhgiua($image, 22, 875, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $stk);
        canchinhgiua($image, 22, 927, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $noidungchuyen);
        if ($chitiet!=0) {
        canchinhphai_noidung($image, 21, 1042, imagecolorallocate($image, $rTenNguoiNhan, $gTenNguoiNhan, $bTenNguoiNhan), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoichuyen,2);
        canchinhphai($image, 21, 1152, imagecolorallocate($image, $rMaGiaoDich, $gMaGiaoDich, $bMaGiaoDich), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $magiaodich,79);
        }
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['MB Bank','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
 }