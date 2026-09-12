<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'abbank') {
    $sogiaodich = $_POST["sogiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stknhan = FormatNumber::PREG($_POST["stknhan"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/abbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }    
    function removeVietnameseTones($str) {
    $unicode = array(
        'a'=>'á|à|ạ|ả|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'e'=>'é|è|ẹ|ẻ|ẽ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ị|ỉ|ĩ',
        'o'=>'ó|ò|ọ|ỏ|õ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỵ|ỷ|ỹ',
        'd'=>'đ',
        'A'=>'Á|À|Ạ|Ả|Ã|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'E'=>'É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ị|Ỉ|Ĩ',
        'O'=>'Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỵ|Ỷ|Ỹ',
        'D'=>'Đ'
    );
    
    foreach ($unicode as $nonUnicode=>$uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    return $str;
    }
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($customX === null) ? ($imageWidth - $textWidth - 96) : $customX;
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
    function renderBankIcon($image, $iconBankPath, $x, $y, $width = 50, $height = 50) {
    if (!file_exists($iconBankPath)) {
        return $image;
    }

    $icon = @imagecreatefrompng($iconBankPath);
    if (!$icon) return $image;
    imagesavealpha($icon, true);
    imagealphablending($icon, true);
    $resizedIcon = imagecreatetruecolor($width, $height);
    imagealphablending($resizedIcon, false);
    imagesavealpha($resizedIcon, true);
    $transparent = imagecolorallocatealpha($resizedIcon, 0, 0, 0, 127);
    imagefilledrectangle($resizedIcon, 0, 0, $width, $height, $transparent);

    imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $width, $height, imagesx($icon), imagesy($icon));
    imagedestroy($icon);
    imagecopy($image, $resizedIcon, (int)$x, (int)$y, 0, 0, $width, $height);
    imagedestroy($resizedIcon);

    return $image;
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

    if (!function_exists('CanLeTrai1')) {
    function CanLeTrai1($image, $fontsize, $y, $textColor, $font, $text, $x) {
        $x = (int) $x;
        $y = (int) $y;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }
}
    function canchinhphai_nh($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 1)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 15) {
            $maxCharsPerLine = 20; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 98;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2;
    imagettftext($image, $fontSize, 0, (int)$x, (int)$y, $textColor, $font, $text);
    }
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 20)
    {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        if ($textLength > 24) {
            $maxCharsPerLine = 25; 
        } else {
            $maxCharsPerLine = $defaultMaxCharsPerLine;
        }
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 98;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }
    $textBox = imagettfbbox(46, 0, $fontPath.'acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen));
    $vndBox = imagettfbbox(26, 0, $fontPath.'acb/NivaSmallCaps-Light.ttf', 'VND');
    $textWidth = $textBox[2] - $textBox[0];
    $vndWidth = $vndBox[2] - $vndBox[0];
    $xAmount = round((imagesx($image) - $textWidth - $vndWidth - 15) / 2);
    $yAmount = 525;
    $xVND = round($xAmount + $textWidth + 15);
    $yVND = 495;
    function drawBankName($image, $text, $font, $size, $color, $x, $y) {
    $x = (int)round(floatval($x));
    $y = (int)round(floatval($y));

    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
    }
    $abbank = [
    'CTG' => 'TMCP Công Thương Việt Nam',
    'VCB' => 'Ngoại Thương Việt Nam',
    'TCB' => 'TMCP Kỹ Thương Việt Nam',
    'ACB' => 'TMCP Á Châu',
    'VARB' => 'TMCP Nông Nghiệp Và PT Nông Thôn',
    'BIDV' => 'TMCP Đầu Tư Và Phát Triển',
    'STB' => 'TMCP Sài Gòn Thương Tín',
    'MB' => 'Quân Đội',
    'NAB' => 'TMCP Nam Á',
    'DAB' => 'TMCP Đông Á',
    'OCB' => 'TMCP Phương Đông',
    'TPB' => 'TMCP Tiêm Phong',
    'VPB' => 'TMCP Việt Nam Thịnh Vượng',
    'SGB' => 'TMCP Sài Gòn Công Thương',
    'VIB' => 'TMCP Quốc Tế Việt Nam',
    'SEAB' => 'TMCP Đông Nam Á',
];
    $name_bank = isset($abbank[$nganhangnhan]) ? $abbank[$nganhangnhan] : ucfirst($nganhangnhan);
    // function alignRight($image, $text, $font, $size, $color, $y,$nhan=73)
    //     {
    //         $bbox = imagettfbbox($size, 0, $font, $text);
    //         $text_width = $bbox[2] - $bbox[0];
    //         $x = imagesx($image) - $text_width - $nhan; 
    //         imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
    //     }
   function alignRight($image, $text, $font, $size, $color, $y, $nhan=73)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = imagesx($image) - $text_width - $nhan; 
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
function renderNoiDungChuyen($image, $text, $font, $fontSize, $color, $yStart, $lineHeight = 1.5, $maxWidth = 500) {
    $words = explode(' ', $text);
    $lines = [];
    $currentLine = '';

    foreach ($words as $word) {
        $testLine = trim($currentLine . ' ' . $word);
        $box = imagettfbbox($fontSize, 0, $font, $testLine);
        $lineWidth = $box[2] - $box[0];

        if ($lineWidth > $maxWidth && $currentLine !== '') {
            $lines[] = $currentLine;
            $currentLine = $word;
        } else {
            $currentLine = $testLine;
        }
    }

    if (!empty($currentLine)) {
        $lines[] = $currentLine;
    }

    $imageWidth = imagesx($image);
    foreach ($lines as $i => $line) {
        $box = imagettfbbox($fontSize, 0, $font, $line);
        $textWidth = $box[2] - $box[0];
        $x = $imageWidth - $textWidth - 98; // canh phải 98px
        $y = $yStart + ($i * $fontSize * $lineHeight);
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $line);
    }
}
    cangiua($image, 63, 770, imagecolorallocate($image, 0, 0, 0),$fontPath.'/heebo/Heebo-Medium.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    cangiua($image,38, 660, imagecolorallocate($image, 0, 0, 0), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 'Tới ' . $tennguoinhan);
    $image = renderBankIcon($image, $iconBankPath, 108, 1025, 50, 50);
    $words2s = explode(' ', $tennguoinhan);
    if (count($words2s) <= 4) {
    } else {
    $middleIndex = ceil(count($words2s) / 2);
    $firstPart = implode(' ', array_slice($words2s, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words2s, $middleIndex));
      alignRight($image, $firstPart, $fontPath.'SVN-Gilroy/SVN- lroy Bold.woff', 30, imagecolorallocate($image, 13, 42, 70), 1100);
      alignRight($image, $secondPart, $fontPath.'SVN-Gilroy/SVN- lroy Bold.woff', 30, imagecolorallocate($image, 13, 42, 70), 1150);
    }
renderNoiDungChuyen(
    $image,
    $noidungchuyen,
    $fontPath.'heebo/Heebo-Medium.ttf',
    34,
    imagecolorallocate($image, 66, 66, 66),
    1315);
CanLeTrai1($image, 34, 1033, imagecolorallocate($image, 0, 0, 0), $fontPath.'heebo/Heebo-Medium.ttf', $stknhan . ' - ' . $nganhangnhan, 215);
        if (count($words2s) <= 30) {
drawBankName(
    $image,
    'Ngân hàng ' . $name_bank,                              
    $fontPath.'SVN-Gilroy/SVN-Gilroy Medium.woff',          
    28,                                                     
    imagecolorallocate($image, 0, 0, 0),                   
    215,                                                    
    1095                                                   
);

        } else {
            alignRight($image, 'Ngân hàng', $fontPath.'SVN-Gilroy/SVN-Gilroy Medium.woff', 30, imagecolorallocate($image, 13, 42, 70), 1200);
            alignRight($image, $nganhangnhan, $fontPath.'SVN-Gilroy/SVN-Gilroy Medium.woff', 30, imagecolorallocate($image, 13, 42, 70), 1250);
        }

    alignRight($image, $thoigianchuyen, $fontPath.'heebo/Heebo-Medium.ttf', 33, imagecolorallocate($image, 66, 66, 66), 1637);
    alignRight($image, $sogiaodich, $fontPath.'heebo/Heebo-Medium.ttf', 34, imagecolorallocate($image, 66, 66, 66), 1765);   
    imagettftext($image, 43, 0, 140, 106, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['ABBank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}