<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'kienlongbank') {
    $name_nhan = $_POST["name_nhan"];
    $name_gui = $_POST["name_gui"];
    $stk_nhan = $_POST["stk_nhan"];
    $stkgui = $_POST["stkgui"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $bank_nhan = $_POST["bank_nhan"];
    $time_bill = $_POST["time_bill"];
    $magiaodich = $_POST["magiaodich"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];
    $code = $_POST["code"] ?? ''; 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi/bill/kienlongbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/dark.php';
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if ($_POST["xem-truoc"] ?? '' === 'yes') {
        $image = Watermark::Render($image, 0.8, 15, 122, 400);
    }
    function CanLeTrai_KLB($image,$fontsize,$y,$textColor,$font,$text,$x_tcb){
    $fontSize = $fontsize;
    imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
    }
    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; 
    imagettftext($image, $fontSize, 0, (int)$x, (int)$y, $textColor, $font, $text);
    }
    function alignRight($image, $text, $font, $size, $color, $y,$nhan=95)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; 
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
        
    function convertCurrencyToWords($amount): string
    {
    if (!is_numeric($amount)) return 'Không xác định';
    $ch = curl_init('https://forum.vdevs.net/nossl/mtw.php?number=' . urlencode($amount));
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10]);
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $data = json_decode($res, true);
    return ($code === 200 && !empty($data['success']) && !empty($data['result']))
        ? htmlspecialchars($data['result'])
        : 'Không xác định';
    }
    function drawBankIcon($image, $code, $lpbank, $iconY) {
        $iconPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/' . $code . '.png';
        $icon = imagecreatefrompng($iconPath);
        $icon = imagescale($icon, 75, 75);
        $x = $lpbank ? 414 - (73 + 25) / 2 - 30 : 189 - (73 + 25) / 2 - 30;
        imagecopy($image, $icon, (int)$x, $iconY, 0, 0, 75, 75);
    }
    $bankMap = [
        'TMCP Công Thương Việt Nam' => ['code' => 'CTG', 'code1' => 'Vietinbank'],
        'Ngoại Thương Việt Nam' => ['code' => 'VCB', 'code1' => 'Vietcombank'],
        'TMCP Kỹ Thương Việt Nam' => ['code' => 'TCB', 'code1' => 'Techcombank'],
        'TMCP Đầu Tư Và Phát Triển' => ['code' => 'BIDV', 'code1' => 'BIDV'],
        'Nông Nghiệp Và PT Nông Thôn' => ['code' => 'VARB', 'code1' => 'Agribank'],
        'TMCP Sài Gòn Thương Tín' => ['code' => 'STB', 'code1' => 'Sacombank'],
        'TMCP Á Châu' => ['code' => 'ACBBANK', 'code1' => 'ACB'],
        'Quân Đội' => ['code' => 'MB', 'code1' => 'MBbank'],
        'TMCP Tiên Phong' => ['code' => 'TPB', 'code1' => 'TPBank'],
        'TMCP Quốc Tế Việt Nam' => ['code' => 'VIB', 'code1' => 'VIB'],
        'TMCP Việt Nam Thịnh Vượng' => ['code' => 'VPB', 'code1' => 'VPbank'],
        'TMCP Sài Gòn Hà Nội' => ['code' => 'SHB', 'code1' => 'SHB'],
        'TMCP Phương Đông' => ['code' => 'OCB', 'code1' => 'ocb-bank'],
        'TMCP Nam Á' => ['code' => 'NAB', 'code1' => 'NAB'],
    ];
    $bank_nhan = $_POST["bank_nhan"];
    $code = $bankMap[$bank_nhan]['code'] ?? '';
    $code1 = $bankMap[$bank_nhan]['code1'] ?? '';
    $words = explode(' ', $noidung);
    if (count($words) <= 0) {       
    } else {
    $middleIndex = ceil(count($words) / 2);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
      alignRight($image, $firstPart, $fontPath.'/Inter/Inter-Regular.ttf', 32, imagecolorallocate($image, 33, 34, 34), 1516);
       alignRight($image, $secondPart, $fontPath.'/Inter/Inter-Regular.ttf', 32, imagecolorallocate($image, 33, 34, 34), 1566);
    }        
    $words2s = explode(' ', $name_gui);
    if (count($words2s) <= 4) {
        CanLeTrai_KLB($image, 42, 780, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $name_gui, 247);
    } else {
    $middleIndex = ceil(count($words2s) / 2);
    $firstPart = implode(' ', array_slice($words2s, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words2s, $middleIndex));
      CanLeTrai_KLB($image, 40, 750, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $firstPart, 247);
      CanLeTrai_KLB($image, 40, 800, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $secondPart, 247);
    }
    CanLeTrai_KLB($image, 31, 860, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', '******' . substr($stkgui, -4), 252);
    $words2s = explode(' ', $name_nhan);
    if (count($words2s) <= 4) {
    CanLeTrai_KLB($image, 42, 1170, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $name_nhan, 247);
    } else {
    $middleIndex = ceil(count($words2s) / 2);
    $firstPart = implode(' ', array_slice($words2s, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words2s, $middleIndex));
      CanLeTrai_KLB($image, 40, 1140, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $firstPart, 247);
      CanLeTrai_KLB($image, 40, 1190, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $secondPart, 247);
    }
    $words = explode(' ', $noidung);
    if (count($words) <= 30) {
    } else {
    $middleIndex = ceil(count($words) / 2);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
      alignRight($image, $firstPart, $fontPath.'/Inter/Inter-Regular.ttf', 30, imagecolorallocate($image, 13, 42, 70), 1555);
       alignRight($image, $secondPart, $fontPath.'/Inter/Inter-Regular.ttf', 30, imagecolorallocate($image, 13, 42, 70), 1610);
    }
    CanLeTrai_KLB($image, 34, 1250, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', $stk_nhan, 247);
    cangiua($image, 55, 380, imagecolorallocate($image, 33, 34, 34), $fontPath.'/Inter/Inter-SemiBold.ttf', FormatNumber::TD($sotienchuyen, 2) . ' VND');
    CanLeTrai_KLB($image, 33, 1320, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', 'Ngân hàng ' . $bank_nhan, 252);
    CanLeTrai_KLB($image, 33, 940, imagecolorallocate($image, 33, 34, 34), $fontPath . '/Inter/Inter-Regular.ttf', 'Ngân hàng TMCP Kiên Long (KienLong Bank)', 252);
    $amount = $sotienchuyen; 
    $convertedText = convertCurrencyToWords($amount);
    cangiua($image, 35, 457, imagecolorallocate($image, 117, 117, 117), $fontPath.'/Inter/Inter-Regular.ttf', $convertedText);
    if (count($words) <= 30) {
    } else {
    $middleIndex = ceil(count($words) / 2);
    $firstPart = implode(' ', array_slice($words, 0, $middleIndex));
    $secondPart = implode(' ', array_slice($words, $middleIndex));
     alignRight($image, $firstPart, $fontPath.'/SVN-Gilroy/SVN-Gilroy Bold.woff', 30, imagecolorallocate($image, 4, 88, 146), 1350);
       alignRight($image, $secondPart, $fontPath.'/SVN-Gilroy/SVN-Gilroy Bold.woff', 30, imagecolorallocate($image, 4, 88, 146), 1400);
    }
    drawBankIcon($image, $code, false, 1060);
    $font = realpath($fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf');
    $color = imagecolorallocate($image, 0, 0, 0); 
    imagettftext($image, 43, 0, 130, 106, $color, $font, $thoigiantrendt);
     alignRight($image, $time_bill, $fontPath.'/Inter/Inter-Regular.ttf', 40, imagecolorallocate($image, 66, 66, 66), 1675);
cangiua($image, 36, 520, imagecolorallocate($image, 117, 117, 117), $fontPath.'/Inter/Inter-Regular.ttf', 'Mã giao dịch: ' . $magiaodich);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $data = ob_get_clean();
    $base64 = base64_encode($data);
    imagedestroy($image);
    $namebill = ['KienLongBank', 'Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}