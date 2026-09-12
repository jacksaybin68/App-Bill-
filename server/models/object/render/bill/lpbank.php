<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'lpbank') {
    $name_nhan = $_POST["name_nhan"];
    $stk_nhan = $_POST["stk_nhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $bank_nhan = $_POST["bank_nhan"];
    $time_bill = $_POST["time_bill"];
    $magiaodich = $_POST["magiaodich"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];
    $code = $_POST["code"] ?? ''; 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi/bill/lpbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    $image = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/light.php';
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if ($_POST["xem-truoc"] ?? '' === 'yes') {
        $image = Watermark::Render($image, 0.8, 15, 122, 400);
    }
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x) {
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }

    function canlephai($image, $fontsize, $y, $textColor, $font, $text) {
        $box = imagettfbbox($fontsize, 0, $font, $text);
        $textWidth = $box[2] - $box[0];
        $x = imagesx($image) - 85 - $textWidth;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }

    function cangiua($image, $fontsize, $y, $textColor, $font, $text) {
        $box = imagettfbbox($fontsize, 0, $font, $text);
        $textWidth = $box[2] - $box[0];
        $x = (imagesx($image) - $textWidth) / 2;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
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
    $amountText = convertCurrencyToWords($sotienchuyen);
    $words = explode(' ', $amountText);
    $colorGray = imagecolorallocate($image, 142, 152, 154);
    $fontRoboto = $fontPath . '/common/Roboto/Roboto-Regular.ttf';

    if (count($words) <= 12) {
        canletrai($image, 32, 1020, $colorGray, $fontRoboto, implode(' ', $words), 79);
    } else {
        $half = ceil(count($words) / 2);
        $part1 = implode(' ', array_slice($words, 0, $half));
        $part2 = implode(' ', array_slice($words, $half));
        canletrai($image, 32, 1020, $colorGray, $fontRoboto, $part1, 79);
        canletrai($image, 32, 1075, $colorGray, $fontRoboto, $part2, 79);
    }
    function drawBankIcon($image, $code, $lpbank, $iconY) {
        $iconPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/' . $code . '.png';
        $icon = imagecreatefrompng($iconPath);
        $icon = imagescale($icon, 73, 73);
        $x = $lpbank ? 455 - (73 + 25) / 2 - 30 : 189 - (73 + 25) / 2 - 30;
        imagecopy($image, $icon, (int)$x, $iconY, 0, 0, 73, 73);
    }

    $bankMap = [
        'Vietinbank' => ['code' => 'CTG', 'code1' => 'Vietinbank'],
        'Vietcombank' => ['code' => 'VCB', 'code1' => 'Vietcombank'],
        'Techcombank' => ['code' => 'TCB', 'code1' => 'Techcombank'],
        'BIDV' => ['code' => 'BIDV', 'code1' => 'BIDV'],
        'Agribank' => ['code' => 'VARB', 'code1' => 'Agribank'],
        'Sacombank' => ['code' => 'STB', 'code1' => 'Sacombank'],
        'ACB' => ['code' => 'ACBBANK', 'code1' => 'ACB'],
        'MBbank' => ['code' => 'MB', 'code1' => 'MBbank'],
        'TPBank' => ['code' => 'TPB', 'code1' => 'TPBank'],
        'VIB' => ['code' => 'VIB', 'code1' => 'VIB'],
        'VPbank' => ['code' => 'VPB', 'code1' => 'VPbank'],
        'SHB' => ['code' => 'SHB', 'code1' => 'SHB'],
        'OCB' => ['code' => 'OCB', 'code1' => 'ocb-bank'],
        'NAB' => ['code' => 'NAB', 'code1' => 'NAB'],
    ];

    $bank_nhan = $_POST["bank_nhan"];
    $code = $bankMap[$bank_nhan]['code'] ?? '';
    $code1 = $bankMap[$bank_nhan]['code1'] ?? '';

    $fontHeebo = $fontPath . '/heebo/Heebo-Bold.ttf';
    $sotienFormatted = FormatNumber::TD($sotienchuyen);
    canletrai($image, 82, 937, imagecolorallocate($image, 110, 54, 26), $fontHeebo, $sotienFormatted, 85);
    $vndImagePath = $_SERVER['DOCUMENT_ROOT'] . '/public/src/vtd/img/icon/bank/addon/lpbank/vnd.png';
    $vndImage = imagecreatefrompng($vndImagePath);
    $scaledVndImage = imagescale($vndImage, 140, 90);
    $amountFormatted = FormatNumber::TD($sotienchuyen);
    $bbox = imagettfbbox(82, 0, $fontHeebo, $amountFormatted);
    $textWidth = abs($bbox[2] - $bbox[0]);
    $vndX = 85 + $textWidth + 20;
    $vndY = 850;
    imagecopy($image, $scaledVndImage, $vndX, $vndY, 0, 0, 140, 90);
    imagedestroy($vndImage);
    imagedestroy($scaledVndImage);
    $fontRobotoMedium = $fontPath . '/common/Roboto/Roboto-Medium.ttf';
    $nameWords = explode(' ', $name_nhan);
    $lines = [];
    $current = '';
    foreach ($nameWords as $word) {
        if (strlen($current . ' ' . $word) <= 25) {
            $current .= (empty($current) ? '' : ' ') . $word;
        } else {
            $lines[] = $current;
            $current = $word;
        }
    }
    if (!empty($current)) $lines[] = $current;

    $yStart = 1300;
    foreach ($lines as $line) {
        canletrai($image, 40, $yStart, imagecolorallocate($image, 0, 0, 0), $fontRobotoMedium, $line, 250);
        $yStart += 50;
    }
    $yBank = $yStart + 20;
    $fontBank = $fontPath . '/common/San Francisco/SanFranciscoDisplay-Medium.otf';
    $x = 250;
    $color = imagecolorallocate($image, 142, 152, 154);
    imagettftext($image, 34, 0, $x, $yBank, $color, $fontBank, $bank_nhan);
    $bankBox = imagettfbbox(34, 0, $fontBank, $bank_nhan);
    $x += ($bankBox[2] - $bankBox[0]) + 10;
    imagettftext($image, 22, 0, $x, $yBank - 6, $color, $fontBank, '|');
    $x += 12;
    imagettftext($image, 34, 0, $x + 10, $yBank, $color, $fontBank, $stk_nhan);
    $ndColor = imagecolorallocate($image, 0, 0, 0);
    $fontND = $fontPath . '/common/Roboto/Roboto-Medium.ttf';
    $noidungWords = explode(' ', $noidung);
    if (count($noidungWords) <= 4) {
        canlephai($image, 39, 1835, $ndColor, $fontND, $noidung);
    } else {
        $half = ceil(count($noidungWords) / 2);
        canlephai($image, 39, 1828, $ndColor, $fontND, implode(' ', array_slice($noidungWords, 0, $half)));
        canlephai($image, 39, 1880, $ndColor, $fontND, implode(' ', array_slice($noidungWords, $half)));
    }

    canlephai($image, 39, 1735, $ndColor, $fontND, 'Chuyển nhanh');
    canlephai($image, 39, 1641, $ndColor, $fontND, $magiaodich);
    canlephai($image, 39, 1542, $ndColor, $fontND, $time_bill);
    drawBankIcon($image, $code, false, 1276);
    imagettftext($image, 40, 0, 110, 90, imagecolorallocate($image, 255, 255, 255), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $data = ob_get_clean();
    $base64 = base64_encode($data);
    imagedestroy($image);
    $namebill = ['LP Bank', 'Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}
