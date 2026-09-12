<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'eximbank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stknhan = $_POST["stknhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $magiaodich = $_POST["magiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $ngaygiaodich = $_POST["ngaygiaodich"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $themeDisplay ='light';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/eximbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    $image = imagecreatefrompng($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image, 1, 30);
    }    
    if (!file_exists($iconBank)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Ngân hàng nhận không hợp lệ."]));
    }
    function safeImagettfbbox($size, $angle, $fontfile, $text) {
        if (!file_exists($fontfile)) {
            die("Font file không tồn tại: $fontfile");
        }
        $bbox = imagettfbbox($size, $angle, $fontfile, $text);
        if ($bbox === false) {
            die("Không thể đọc bbox với font $fontfile");
        }
        return $bbox;
    }
    function canlephai($image, $fontsize, $y, $textColor, $font, $text)
    {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 50 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb = 275) {
        imagettftext($image, $fontsize, 0, $x_tcb, $y, $textColor, $font, $text);
    }
    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
        $bbox = safeImagettfbbox($fontsize, 0, $font, $text);
        $textWidth = $bbox[2] - $bbox[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        imagettftext($image, $fontsize, 0, (int)$x, (int)$y, $textColor, $font, $text);
    }
    function alignRight($image, $text, $font, $size, $color, $y, $nhan = 95) {
        $bbox = safeImagettfbbox($size, 0, $font, $text);
        $text_width = $bbox[2] - $bbox[0];
        $x = imagesx($image) - $text_width - $nhan;
        imagettftext($image, $size, 0, (int)$x, (int)$y, $color, $font, $text);
    }
    function drawBankIcon($image, $iconBank, $x, $y, $bankCode) {
        $icon = imagecreatefrompng($iconBank);
        list($iconWidth, $iconHeight) = ($bankCode === 'ACB') ? [60, 60] : [61, 60];

        $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));

        imagecopy($image, $resizedIcon, $x, $y, 0, 0, $iconWidth, $iconHeight);

        imagedestroy($icon);
        imagedestroy($resizedIcon);
    }
    function drawBankName($image, $text, $font, $size, $color, $x, $y) {
        imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
    }
    $eximbank = [
    'Vietinbank' => 'Vietinbank',
    'Vietcombank' => 'Vietcombank',
    'Vechcombank' => 'Techcombank',
    'acbbank' => 'ACB',
    'agribank' => 'Agribank',
    'bidv' => 'BIDV',
    'sacombank' => 'Sacombank',
    'mbbank' => 'MB Bank',
    'namabank' => 'Nam Á Bank',
    'dongabank' => 'Đông Á Bank',
    'ocb' => 'OCB',
    'tpbank' => 'TPBank',
    'vpbank' => 'VPBank',
    'sgb' => 'Saigonbank',
    'vib' => 'VIB',
    'seabank' => 'SeABank',
];
    $name_bank = isset($eximbank[$nganhangnhan]) ? $eximbank[$nganhangnhan] : ucfirst($nganhangnhan);
    imagettftext($image, 25, 0, 65, 55, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold_Fix.otf', $thoigiantrendt);
    cangiua($image, 42, 512, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/AvertaStd/AvertaStd-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
    function splitTextToLines($text, $font, $fontSize, $maxWidth)
                {
                    $words = explode(' ', $text);
                    $lines = [];
                    $currentLine = '';

                    foreach ($words as $word) {
                        $testLine = trim($currentLine . ' ' . $word);
                        $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
                        $textWidth = $bbox[2] - $bbox[0];

                        if ($textWidth <= $maxWidth) {
                            $currentLine = $testLine;
                        } else {
                            $lines[] = $currentLine;
                            $currentLine = $word;
                        }
                    }

                    if (!empty($currentLine)) {
                        $lines[] = $currentLine;
                    }

                    return $lines;
                }
                $font = $fontPath . 'common/AvertaStd/AvertaStd-Regular.otf';
                $textColor = imagecolorallocate($image, 123, 144, 158);
                $fontSize = 21; 
                $maxWidth = imagesx($image) - 100; 
                $lines = splitTextToLines($tennguoinhan, $font, $fontSize, $maxWidth);
                if (count($lines) > 1) {
                    $fontSize = 23;
                    $startY = 980; 
                    $lineSpacing = 8; 
                } else {
                    $startY = 1015; 
                    $lineSpacing = 10; 
                }
                foreach ($lines as $index => $line) {
                    $bbox = imagettfbbox($fontSize, 0, $font, $line);
                    $textWidth = $bbox[2] - $bbox[0];
                    $x = 164; 
                    $y = $startY + ($index * ($fontSize + $lineSpacing)); 
                    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $line);
                }

                
                $font9 = $fontPath . 'common/AvertaStd/AvertaStd-Semibold.otf';
 
                canlephai($image, 26, 1240, imagecolorallocate($image, 235, 244, 249), $fontPath . 'common/AvertaStd/AvertaStd-Semibold.otf', $magiaodich);

                imagettftext($image, 25, 0, 164, 1060, imagecolorallocate($image, 235, 244, 249), $font9, $stknhan . ' |');
                imagettftext($image, 23, 0, 164, 1105, imagecolorallocate($image, 235, 244, 249), $font9, $nganhangnhan);
    drawBankIcon($image, $iconBank, 73, 992 - 10 + 11, $name_bank);
    // drawBankName($image, $name_bank, $fontPath.'common/AvertaStd/AvertaStd-Semibold.otf', 33, imagecolorallocate($image, 100, 99, 107), 135 + 89 + 52, 1555);
    // canletrai($image, 34, 1630 , imagecolorallocate($image, 100, 99, 107), $fontPath . 'Inter/Inter-Regular.ttf', $stknhan, 275);
    canlephai($image, 26, 1333, imagecolorallocate($image, 235, 244, 249), $fontPath.'common/AvertaStd/AvertaStd-Semibold.otf', $noidungchuyen);
    canlephai($image, 26, 1533, imagecolorallocate($image, 235, 244, 249), $font9, $ngaygiaodich);
    canlephai($image, 26, 1433, imagecolorallocate($image, 235, 244, 249), $font9, $thoigianchuyen);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Eximbank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
?>