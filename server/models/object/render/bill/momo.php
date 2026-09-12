<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'momo') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $kieuchuyen = $_POST["kieuchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi/bill/' . ($kieuchuyen === 'macdinh' ? 'momo-lienbank.jpg' : 'momo-lienbank-bdsd.jpg');
    $iconBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/' . $nganhangnhan . '.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/dark.php';
    if (empty($iconPins) || !file_exists($iconBank)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Ngân hàng nhận không hợp lệ."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        if ($customX) {
            $x = $imageWidth - $textWidth - 120;
        } else {
            $x = ($customX == null) ? ($imageWidth - $textWidth - 93) : $customX;
        }
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
        $fontSize = (int) $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = (int) (($imageWidth - $textWidth) / 2);
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = (int) $fontsize;
        $x = (int) $x_tcb;
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canlephai_iconbank($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 5)
    {
        $icon = imagecreatefrompng($iconBank);
        list($iconWidth, $iconHeight) = [50, 50];
        $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $name_bank);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $iconWidth - 20 - 93;
        $iconY = $y - $iconHeight + $iconOffsetY;
        imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
        imagettftext($image, $fontSize, 0, round($x + $iconWidth + 18), round($y), $textColor, $font, $name_bank);
        imagedestroy($icon);
        imagedestroy($resizedIcon);
    }
    $momo = [
        'vietinbank' => 'Vietinbank',
        'vietcombank' => 'Vietcombank',
        'techcombank' => 'Techcombank',
        'acbbank' => 'ACB',
        'agribank' => 'Agribank',
        'bidv' => 'BIDV',
        'sacombank' => 'Sacombank',
        'mbbank' => 'MBBank',
        'namabank' => 'Nam Á Bank',
        'dongabank' => 'Đông Á Bank',
        'ocb' => 'OCB',
        'tpbank' => 'TPBank',
        'vpbank' => 'VPBank',
        'sgb' => 'Saigonbank',
        'vib' => 'VIB',
        'seabank' => 'SeABank',
    ];
    $name_bank = isset($momo[$nganhangnhan]) ? $momo[$nganhangnhan] : ucfirst($nganhangnhan);
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2)
    {
        $lines = explode("\n", $text);
        $imageWidth = imagesx($image);

        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 85;

            imagettftext($image, (int) $fontSize, 0, (int) $x, (int) ($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
    {
        $imageWidth = imagesx($image);
        $maxWidth = $imageWidth - 250;
        $maxWidthSecondLine = $imageWidth - 430;
        $words = explode(' ', $text);
        $currentLine = '';
        $lines = [];

        foreach ($words as $word) {
            $tempLine = $currentLine . (empty($currentLine) ? '' : ' ') . $word;
            $tempLineBoundingBox = imagettfbbox($fontsize, 0, $font, $tempLine);
            $tempLineWidth = $tempLineBoundingBox[2] - $tempLineBoundingBox[0];

            if ($tempLineWidth > $maxWidth) {
                $lines[] = trim($currentLine);
                $currentLine = $word;
                if (count($lines) == 2) {
                    break;
                }
            } else {
                $currentLine = $tempLine;
            }
        }

        if (count($lines) < 2 && !empty($currentLine)) {
            $lines[] = trim($currentLine);
        }
        if (count($lines) == 2) {
            $secondLine = $lines[1];
            $accountPos = mb_strpos($secondLine, 'số tài khoản');

            if ($accountPos !== false) {
                $startOfAccountNumber = $accountPos + mb_strlen('số tài khoản') + 1;
                $requiredText = mb_substr($secondLine, 0, $startOfAccountNumber + 2);
                $secondLine = $requiredText . "...";
                while (true) {
                    $secondLineBoundingBox = imagettfbbox($fontsize, 0, $font, $secondLine);
                    $secondLineWidth = $secondLineBoundingBox[2] - $secondLineBoundingBox[0];

                    if ($secondLineWidth <= $maxWidthSecondLine) {
                        break;
                    }
                    $secondLine = mb_substr($secondLine, 0, -4, 'UTF-8') . "...";
                }
                $lines[1] = $secondLine;
            }
        }
        foreach ($lines as $index => $line) {
            $x = 161;
            $currentY = $y + ($index * ($fontsize + 20));
            imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
        }
    }
    if ($kieuchuyen !== 'macdinh') {
        canchinhbdsd($image, 28, 245, imagecolorallocate($image, 16, 23, 33), $fontPath . 'common/Roboto/Roboto-Regular.ttf', "Bạn đã chuyển thành công số tiền " . FormatNumber::TD($sotienchuyen) . " đ đến " . $tennguoinhan . ' (' . $name_bank . '), số tài khoản ' . $stk);
    }
    canchinhphai($image, 35, 824, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $tennguoinhan);
    canletrai($image, 50, 467, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Bold.otf', FormatNumber::TD($sotienchuyen) . 'đ', 240);
    canchinhphai($image, 35, 725, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
    canchinhphai($image, 35, 912, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $stk);
    canlephai_iconbank($image, 1000, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $iconBank, $name_bank, 35, 8);
    canletrai($image, 37, 83, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 76);
    canchinhphai($image, 35, 1083, imagecolorallocate($image, 239, 47, 147), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $magiaodich, 845, true);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Ví Momo','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}
