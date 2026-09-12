<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'vpbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $matrasoat = $_POST["matrasoat"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $stkchinh = FormatNumber::PREG($_POST["stkchinh"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $kieuchuyen = $_POST["kieuchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'vpbank.png' : 'vpbank-bdsd.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefrompng($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image, 1.7, 33);
    }
    if (!file_exists($iconBank)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Ngân hàng nhận không hợp lệ."]));
    } else {
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 80)
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
        function canlephai($image, $fontsize, $y, $textColor, $font, $text, $wrap = false)
        {
            $fontSize = $fontsize;
            $maxWidth = imagesx($image) - 730;
            $x = 954;
            if ($wrap) {
                $words = explode(' ', $text);
                $line = '';
                $yOffset = 0;
                foreach ($words as $word) {
                    $testLine = $line.($line ? ' ' : '').$word;
                    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $testLine);
                    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                    if ($textWidth > $maxWidth) {
                        imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
                        $line = $word;
                        $yOffset += 50;
                    } else {
                        $line = $testLine;
                    }
                }
                if ($line) {
                    imagettftext($image, $fontSize, 0, $x, $y + $yOffset, $textColor, $font, $line);
                }
                return $yOffset + 50;
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
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
        }

        function cangiua_nganhang($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 5)
        {
            $icon = imagecreatefrompng($iconBank);
            list($iconWidth, $iconHeight) = [47, 47];
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
            imagettftext($image, $fontSize, 0, round($x + $iconWidth + 18), round($y), $textColor, $font, $name_bank);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
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
        function canchinhbdsd($image, $startY, $textColor, $lines) {
            $currentY = $startY; 
            foreach ($lines as $index => $line) {
                $x = 186;
                $fontsize = $line['fontsize']; 
                $font = $line['font']; 
                $text = $line['text'];
                if ($index > 0) {
                    $currentY += 2;
                }
        
                imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $text);
                $currentY += $fontsize + 21; 
            }
        }        
        canletrai($image, 39, 85, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 130);
        if ($kieuchuyen !== 'macdinh') {
            $lines = [
                ['text' => "- ".FormatNumber::TD($sotienchuyen, 2)." ₫", 'font' => $fontPath.'common/San Francisco/SanFranciscoDisplay-Bold.otf', 'fontsize' => 45], 
                ['text' => "Tài khoản: " . (strlen($stk) > 4 ? substr($stk, 0, 2) . '****' . substr($stk, -2) : $stk), 'font' => $fontPath . 'Inter-Regular.ttf', 'fontsize' => 32],
                ['text' => "Số dư: ".FormatNumber::TD($soduchinh, 2)." ₫", 'font' => $fontPath.'Inter-Regular.ttf', 'fontsize' => 32],
                ['text' => $noidungchuyen, 'font' => $fontPath.'Inter-Regular.ttf', 'fontsize' => 32],
            ];
            canchinhbdsd(
                $image,
                228, 
                imagecolorallocate($image, 1, 1, 1),
                $lines
            );

        }

        function money_vpbank($image, $fontsize, $y, $moneyColor, $moneyFont, $symbolColor, $symbolFont, $sotien)
        {
            $formattedMoney = number_format($sotien, 0, '', ' ');
            $x = 230;
            imagettftext($image, $fontsize, 0, $x, $y, $moneyColor, $moneyFont, $formattedMoney);
            $bbox = imagettfbbox($fontsize, 0, $moneyFont, $formattedMoney);
            $symbolX = $x + abs($bbox[2] - $bbox[0]) + 50;
            imagettftext($image, $fontsize, 0, $symbolX, $y, $symbolColor, $symbolFont, '₫');
        }

        function drawBankIcon($image, $iconBank)
        {
            $banksConfig = [
                'vietinbank' => ['x' => 80, 'y' => 831, 'w' => 107, 'h' => 107],
                'techcombank' => ['x' => 78, 'y' => 833, 'w' => 110, 'h' => 110],
                'vietcombank' => ['x' => 80, 'y' => 839, 'w' => 100, 'h' => 100],
                'acbbank' => ['x' => 73, 'y' => 823, 'w' => 121, 'h' => 121],
                'agribank' => ['x' => 92, 'y' => 846, 'w' => 80, 'h' => 80],
                'bidv' => ['x' => 85, 'y' => 840, 'w' => 90, 'h' => 90],
                'sacombank' => ['x' => 78, 'y' => 833, 'w' => 105, 'h' => 105],
                'mbbank' => ['x' => 89, 'y' => 839, 'w' => 93, 'h' => 93],
                'namabank' => ['x' => 83, 'y' => 833, 'w' => 100, 'h' => 100],
                'dongabank' => ['x' => 86, 'y' => 839, 'w' => 90, 'h' => 90],
                'ocb' => ['x' => 83, 'y' => 835, 'w' => 100, 'h' => 100],
                'tpbank' => ['x' => 87, 'y' => 847, 'w' => 90, 'h' => 90],
                'vpbank' => ['x' => 82, 'y' => 838, 'w' => 100, 'h' => 100],
                'sgb' => ['x' => 92, 'y' => 845, 'w' => 80, 'h' => 80],
                'vib' => ['x' => 86, 'y' => 844, 'w' => 92, 'h' => 92],
                'seabank' => ['x' => 92, 'y' => 845, 'w' => 80, 'h' => 80],
            ];

            $bankName = basename($iconBank, '.png');
            if (!isset($banksConfig[$bankName])) {
                return;
            }
            $config = $banksConfig[$bankName];
            $icon = imagecreatefrompng($iconBank);
            $resizedIcon = imagecreatetruecolor($config['w'], $config['h']);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled(
                $resizedIcon, $icon,
                0, 0, 0, 0,
                $config['w'], $config['h'],
                imagesx($icon), imagesy($icon)
            );
            imagecopy($image, $resizedIcon, $config['x'], $config['y'], 0, 0, $config['w'], $config['h']);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
        money_vpbank(
            $image,
            81,
            625,
            imagecolorallocate($image, 0, 0, 0),
            $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf',
            imagecolorallocate($image, 142, 152, 154),
            $fontPath.'common/San Francisco/SanFranciscoDisplay-Bold.otf',
            $sotienchuyen
        );
        drawBankIcon($image, $iconBank);
        canletrai($image, 38, 873, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $tennguoinhan, 215);
        canletrai($image, 35, 937, imagecolorallocate($image, 142, 152, 154), $fontPath.'common/Roboto/Roboto-Regular.ttf', $stk, 215);
        canchinhphai($image, 34, 1133, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
        canchinhphai($image, 34, 1288, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $noidungchuyen);
        canchinhphai($image, 34, 1430, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 'Chuyển nhanh Napas 247');
        canchinhphai($image, 34, 1580, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $matrasoat);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['VP Bank', 'Chuyển Khoản'];
        require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
    }
}
