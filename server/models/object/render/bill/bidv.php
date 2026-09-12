<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'bidv') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $kieuchuyen = $_POST["kieuchuyen"] ?? 'macdinh';
    $sothamchieu = $_POST["mathamchieu"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'bidv.jpeg' : 'bidv-bdsd.jpeg');
    $image = imagecreatefromjpeg($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
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
            $x = $imageWidth - $textWidth - 354;
        } else {
            $x = ($customX == null) ? ($imageWidth - $textWidth - 240) : $customX;
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
    function canlephai($image, $fontsize, $y, $textColor, $font, $text, $wrap = false) {
        $fontSize = $fontsize;
        $maxWidth = imagesx($image) - 730;
        $x = 624;
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
    function BIDV($image, $fontsize, $startY, $BIDV, $maxLines = 5)
    {
        extract($GLOBALS);
        $imageWidth = imagesx($image);
        $fontSize = (int)$fontsize;
        $lines = [];
        $currentLine = '';
        $currentLineParts = [];
        foreach ($BIDV as $part) {
            $words = preg_split('/(\s+)/u', $part['text'], -1, PREG_SPLIT_DELIM_CAPTURE);
            foreach ($words as $word) {
                $testLine = $currentLine.$word;
                $box = imagettfbbox($fontSize, 0, $part['font'], $testLine);
                $textWidth = $box[2] - $box[0];
                if ($textWidth > $imageWidth - 150) {
                    $lines[] = $currentLineParts;
    
                    if (count($lines) >= $maxLines) {
                        break 2;
                    }
                    $currentLine = $word;
                    $currentLineParts = [[
                        'text' => $word,
                        'font' => $part['font'],
                        'color' => $part['color'],
                    ]];
                } else {
                    $currentLine .= $word;
                    $currentLineParts[] = [
                        'text' => $word,
                        'font' => $part['font'],
                        'color' => $part['color'],
                    ];
                }
            }
        }
    
        if (count($lines) < $maxLines) {
            $lines[] = $currentLineParts;
        }
        foreach ($lines as $i => $lineParts) {
            $lineWidth = 0;
            $wordCount = count($lineParts);
            foreach ($lineParts as $part) {
                $box = imagettfbbox($fontSize, 0, $part['font'], $part['text']);
                $lineWidth += $box[2] - $box[0];
            }
            $spaceBetweenWords = 1; 
            $x = (imagesx($image) - $lineWidth) / 2;
            $y = $startY + $i * ($fontSize + 38);
    
            $currentX = $x;
    
            foreach ($lineParts as $j => $part) {
                if ($part['text'] === '/') {
                    $currentX += 1.8; 
                }
                imagettftext($image, $fontSize, 0, (int)$currentX, (int)$y, $part['color'], $part['font'], $part['text']);
                $box = imagettfbbox($fontSize, 0, $part['font'], $part['text']);
                $currentX += $box[2] - $box[0];
    
                if ($part['text'] === '/') {
                    $currentX += 5;
                }
                $currentX += $spaceBetweenWords;  
            }
        }
    }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = (int) $fontsize;
        $x = (int) $x_tcb;
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    canchinhgiua($image, 50, 450, imagecolorallocate($image, 0,102,173), $fontPath.'common/Mulish/Mulish-Bold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhgiua($image, 24, 565, imagecolorallocate($image, 117,117,117), $fontPath.'common/Mulish/Mulish-Bold.ttf', $sothamchieu, true);
    $BIDV = [
        ['text' => 'Quý khách đã chuyển thành công đến số tài khoản ', 'font' => $fontPath.'common/Mulish/Mulish-SemiBold.ttf', 'color' => imagecolorallocate($image, 61,68,87)],
        ['text' => $stk, 'font' => $fontPath.'common/Mulish/Mulish-Bold.ttf', 'color' => imagecolorallocate($image, 0, 102, 173)],
        ['text' =>  '/', 'font' => $fontPath.'common/Mulish/Mulish-SemiBold.ttf', 'color' => imagecolorallocate($image, 61,68,87)],
        ['text' => $tennguoinhan, 'font' => $fontPath.'common/Mulish/Mulish-Bold.ttf', 'color' => imagecolorallocate($image, 0, 102, 173)],
        ['text' => '/', 'font' => $fontPath.'common/Mulish/Mulish-SemiBold.ttf', 'color' => imagecolorallocate($image, 61,68,87)],
        ['text' => $nganhangnhan, 'font' => $fontPath.'common/Mulish/Mulish-Bold.ttf', 'color' => imagecolorallocate($image, 0, 102, 173)],
        ['text' => ' vào lúc '.$thoigianchuyen.'. Nội dung: '.$noidungchuyen, 'font' => $fontPath.'common/Mulish/Mulish-SemiBold.ttf', 'color' => imagecolorallocate($image, 61,68,87)],
    ];
    BIDV($image, 29, 670, $BIDV, 10);
    canletrai($image, 29, 70, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt, 70);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['BIDV','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
