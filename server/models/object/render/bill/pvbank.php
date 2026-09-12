<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'pvbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $stkgui = $_POST["stkgui"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/pvbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefrompng($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30);
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
        function canbentrai($image, $fontsize, $y, $textColor, $font, $text, $leftPadding = 145)
        {
            $fontSize = $fontsize;
            $x = $leftPadding; // Căn từ lề trái, có thể thay đổi padding nếu cần
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function canbentrai_nganhang($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 8, $leftPadding = 145)
        {
            $icon = imagecreatefrompng($iconBank);
        
            // Tùy chỉnh kích thước theo tên ngân hàng
            list($iconWidth, $iconHeight) = ($name_bank === 'ACB') ? [89, 89] : [73, 73];
        
            // Resize icon
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled(
                $resizedIcon,
                $icon,
                0, 0, 0, 0,
                $iconWidth, $iconHeight,
                imagesx($icon), imagesy($icon)
            );
        
            // Tính tọa độ X bắt đầu từ lề trái
            $x = $leftPadding;
        
            // Tọa độ Y cho icon
            $iconY = $y - $iconHeight + $iconOffsetY;
        
            // Vẽ icon
            imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
        
            // Vẽ tên ngân hàng bên cạnh icon
            $textX = round($x + $iconWidth + 25); // khoảng cách giữa icon và text
            imagettftext($image, $fontSize, 0, $textX, round($y), $textColor, $font, $name_bank);
        
            // Dọn bộ nhớ
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }

        $mbbank = [
            'vietinbank' => 'CTG',
            'vietcombank' => 'VCB',
            'techcombank' => 'TCB',
            'acbbank' => 'ACB',
            'agribank' => 'ARB',
            'bidv' => 'BIDV',
            'sacombank' => 'STB',
            'mbbank' => 'MB',
            'namabank' => 'NAB',
            'dongabank' => 'DAB',
            'ocb' => 'OCB',
            'tpbank' => 'TPB',
            'vpbank' => 'VPB',
            'sgb' => 'SGB',
            'vib' => 'VIB',
            'seabank' => 'SAB',
        ];
        $name_bank = isset($mbbank[$nganhangnhan]) ? $mbbank[$nganhangnhan] : ucfirst($nganhangnhan);
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
        
        canletrai($image, 42, 105, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt,136);
        canchinhgiua($image, 70, 1048, imagecolorallocate($image, 66,66,66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' đ');
        canchinhgiua($image, 40, 1135, imagecolorallocate($image, 33, 43, 54), $fontPath.'common/San Francisco/SanFranciscoText-Regular.otf', $thoigianchuyen);
        canbentrai($image, 40, 1537, imagecolorallocate($image, 66,66,66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan);
        canbentrai_nganhang($image, 1413, imagecolorallocate($image, 66,66,66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $iconBank, $name_bank, 40, $name_bank === 'ACB' ? 25 :17);
        canbentrai($image, 43, 1605, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Regular.otf', $stk);
        canchinhphai($image, 42, 1780, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $noidungchuyen);
        canchinhphai($image, 42, 1930, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stkgui);
        canchinhphai($image, 42, 2080, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $magiaodich);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['PVBank','Chuyển Khoản'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
}