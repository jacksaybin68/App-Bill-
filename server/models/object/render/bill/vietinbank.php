<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'vietinbank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk_nc = $_POST["stk_nc"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $phigiaodich = $_POST["phigiaodich"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $kieuchuyen = $_POST["kieuchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'vietinbank.jpg' : 'vietinbank-bdsd.jpg');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $img = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $img = Watermark::Render($img);
    }    
    if($kieuchuyen!=='macdinh' && empty($soduchinh)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng không bỏ trống số dư chính."]));
    }
    function canchinhphai($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $bbox[2] - $bbox[0];
        $x = imagesx($image) - $text_width - $margin;
        imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
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
    function canchinhnganhang($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $maxLength = 30;
        if (mb_strlen($text, 'UTF-8') > $maxLength) {
            $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
            
            if ($lastSpace !== false) {
                $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
                $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8'); 
            } else {
                $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
                $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
            }
        } else {
            $firstLine = $text;
            $secondLine = '';
        }
        $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
        $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
        $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
        imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);
        if (!empty($secondLine)) {
            $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
            $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
            $currentY = $y + $size + 24;
            $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;
    
            imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
        }
    }
    
    function canchinhtien($image, $text, $font, $size, $color, $y, $margin = 74)
{
    $text = ucwords(strtolower($text));
    $text = str_replace(' đồng', ' Đồng', $text);

    // Sửa một số lỗi từ phổ biến nếu có
    $text = str_ireplace(' Ai Mươi', ' Hai Mươi', $text);

    $maxLength = 34;
    if (mb_strlen($text, 'UTF-8') > $maxLength) {
        $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');

        if ($lastSpace !== false) {
            $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
            $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8');
        } else {
            $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
            $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
        }
    } else {
        $firstLine = $text;
        $secondLine = '';
    }

    $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
    $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
    $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
    imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);

    if (!empty($secondLine)) {
        $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
        $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
        $currentY = $y + $size + 24;
        $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;

        imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
    }
}

    function canchinhnoidung($image, $text, $font, $size, $color, $y, $margin = 74)
    {
        $maxLength = 30;
        if (mb_strlen($text, 'UTF-8') > $maxLength) {
            $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength, 'UTF-8'), ' ', 0, 'UTF-8');
            
            if ($lastSpace !== false) {
                $firstLine = mb_substr($text, 0, $lastSpace, 'UTF-8');
                $secondLine = mb_substr($text, $lastSpace + 1, null, 'UTF-8'); 
            } else {
                $firstLine = mb_substr($text, 0, $maxLength, 'UTF-8');
                $secondLine = mb_substr($text, $maxLength, null, 'UTF-8');
            }
        } else {
            $firstLine = $text;
            $secondLine = '';
        }
        $bboxFirstLine = imagettfbbox($size, 0, $font, $firstLine);
        $textWidthFirstLine = $bboxFirstLine[2] - $bboxFirstLine[0];
        $xFirstLine = imagesx($image) - $textWidthFirstLine - $margin;
        imagettftext($image, $size, 0, $xFirstLine, $y, $color, $font, $firstLine);
        if (!empty($secondLine)) {
            $bboxSecondLine = imagettfbbox($size, 0, $font, $secondLine);
            $textWidthSecondLine = $bboxSecondLine[2] - $bboxSecondLine[0];
            $currentY = $y + $size + 24;
            $xSecondLine = imagesx($image) - $textWidthSecondLine - $margin;
    
            imagettftext($image, $size, 0, $xSecondLine, $currentY, $color, $font, $secondLine);
        }

    }
    function canchinhbdsd($image, $fontsize, $y, $textColor, $font, $text)
    {
        $imageWidth = imagesx($image);
        $maxWidth = $imageWidth - 320;
        $lines = [];
        $currentLine = '';
        $length = mb_strlen($text, 'UTF-8');
    
        for ($i = 0; $i < $length; $i++) {
            $currentLine .= mb_substr($text, $i, 1, 'UTF-8');
            $lineBoundingBox = imagettfbbox($fontsize, 0, $font, $currentLine);
            $lineWidth = $lineBoundingBox[2] - $lineBoundingBox[0];
    
            if ($lineWidth > $maxWidth) {
                $lines[] = mb_substr($currentLine, 0, -1, 'UTF-8');
                $currentLine = mb_substr($currentLine, -1, 1, 'UTF-8');
            }
    
            if (count($lines) >= 3) {
                break;
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
            $lines[1] = $secondLine; 
        }
        if (count($lines) > 2) {
            $thirdLine = trim($lines[2]);
            $thirdLineBoundingBox = imagettfbbox($fontsize, 0, $font, $thirdLine);
            $thirdLineWidth = $thirdLineBoundingBox[2] - $thirdLineBoundingBox[0];
            if ($thirdLineWidth > 320) {
                $thirdLine .= '...'; 
            }
            $lines[2] = $thirdLine;
        }
        $lines = array_slice($lines, 0, 3); 
        foreach ($lines as $index => $line) {
            $x = 224;
            $currentY = $y + ($index * ($fontsize + 20));
            imagettftext($image, $fontsize, 0, $x, $currentY, $textColor, $font, $line);
        }
    }
    
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
    }
    $width = imagesx($img);
    $height = imagesy($img);
    $image = imagecreatetruecolor($width, $height);
    imagecopy($image, $img, 0, 0, 0, 0, $width, $height);
    canletrai($image, 37, 85, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt,90);
    if ($kieuchuyen==='macdinh') {
    canchinhphai($image, $thoigianchuyen, $fontPath.'vietinbank/SVN-Gilroy SemiBold.otf', 27, imagecolorallocate($image, 158,171,176), 440);
    canchinhphai($image, $magiaodich, $fontPath.'vietinbank/SVN-Gilroy SemiBold.otf', 27, imagecolorallocate($image, 158,171,176), 480);
    } else {
    canchinhbdsd($image, 31, 260, imagecolorallocate($image, 16,23,33), $fontPath.'common/Roboto/Roboto-Regular.ttf', "Vietinbank: ".date('d/m/Y H:i')."|TK:".$stk_nc."|GD:-".FormatNumber::TD($sotienchuyen,2)."VND"."|SDC:".FormatNumber::TD($soduchinh,2)."VND"."|ND:CTDI:".WsRandomString::Number(12)." ".$noidungchuyen.'; tại iPay');
    }
    canchinhphai($image, '********' . substr($stk_nc, -4), $fontPath.'vietinbank/SVN-Gilroy Medium.otf', 31, imagecolorallocate($image, 13, 42, 70), 855);
    canchinhphai($image, $tennguoichuyen, $fontPath.'vietinbank/SVN-Gilroy Medium.otf', 31, imagecolorallocate($image, 13, 42, 70), 905);
    canchinhphai($image, $stk, $fontPath.'vietinbank/SVN-Gilroy Bold.otf', 31, imagecolorallocate($image, 13, 42, 70), 1000);
    canchinhphai($image, $tennguoinhan, $fontPath.'vietinbank/SVN-Gilroy Bold.otf', 31, imagecolorallocate($image, 13, 42, 70), 1050);
    canchinhnganhang($image, $nganhangnhan, $fontPath.'vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($image, 13, 42, 70), 1156);
    canchinhphai($image, FormatNumber::TD($sotienchuyen,2).' VND', $fontPath.'vietinbank/SVN-Gilroy XBold.otf', 31, imagecolorallocate($image, 4, 88, 146), 1265);
    canchinhtien($image, convert_number_to_words($sotienchuyen,2), $fontPath.'vietinbank/SVN-Gilroy XBold.otf', 31, imagecolorallocate($image, 4, 88, 146), 1321);
    canchinhphai($image, $phigiaodich, $fontPath.'vietinbank/SVN-Gilroy Medium.otf', 31, imagecolorallocate($image, 13, 42, 70), 1452);
    canchinhnoidung($image, $noidungchuyen, $fontPath.'vietinbank/SVN-Gilroy Medium.otf', 31, imagecolorallocate($image, 13, 42, 70), 1565);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    imagedestroy($img);
    $namebill = ['Vietinbank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
