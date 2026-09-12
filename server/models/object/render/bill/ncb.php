<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'ncb') {
    $name_nhan = $_POST["name_nhan"];
    $name_gui = $_POST["name_gui"];
    $stkgui = $_POST["stkgui"];
    $stk_nhan = $_POST["stk_nhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $bank_nhan = $_POST["bank_nhan"];
    $time_bill = $_POST["time_bill"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];
    $code = $_POST["code"] ?? ''; 
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi/bill/ncb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/dark.php';
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image, 0.8, 15, 122, 400);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x)
    {
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }

    function cangiua($image, $fontsize, $y, $color, $font, $text)
    {
        $bbox = imagettfbbox($fontsize, 0, $font, $text);
        $width = $bbox[2] - $bbox[0];
        $x = (imagesx($image) - $width) / 2;
        imagettftext($image, $fontsize, 0, $x, $y, $color, $font, $text);
    }

    function drawBankIcon($image, $code, $ncb, $iconY)
    {
        $iconPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/' . $code . '.png';

        $icon = imagecreatefrompng($iconPath);
        $icon = imagescale($icon, 73, 73);
        $x = $ncb ? 450 - (73 + 25) / 2 - 30 : 215 - (73 + 25) / 2 - 30;
        imagecopy($image, $icon, (int)$x, $iconY, 0, 0, 73, 73);
    }

    $fontRegular = $fontPath . 'Be_Vietnam_Pro/BeVietnamPro-Regular.ttf';
    $fontBold = $fontPath . 'Be_Vietnam_Pro/BeVietnamPro-Bold.ttf';
    $fontTime = $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf';

    $textColor = imagecolorallocate($image, 39, 38, 100);
    $grayColor = imagecolorallocate($image, 100, 99, 107);
    $blueColor = imagecolorallocate($image, 73, 155, 231);
    
    $bankMap = [
    'TMCP CONG THHUONG VIET NAM' => ['code' => 'CTG', 'code1' => 'Vietinbank'],
    'NGOAI THUONG VIET NAM' => ['code' => 'VCB', 'code1' => 'Vietcombank'],
    'TMCP KY THUONG VIET NAM' => ['code' => 'TCB', 'code1' => 'Techcombank'],
    'TMCP DAU TU VA PHAT TRIEN' => ['code' => 'BIDV', 'code1' => 'BIDV'],
    'NONG NGHIEP VA PT NONG THON' => ['code' => 'VARB', 'code1' => 'Agribank'],
    'TMCP SAI GON THUONG TIN' => ['code' => 'STB', 'code1' => 'Sacombank'],
    'TMCP A CHAU' => ['code' => 'ACBBANK', 'code1' => 'ACB'],
    'TMCP QUAN DOI' => ['code' => 'MB', 'code1' => 'MBbank'],
    'TMCP TIEN PHONG' => ['code' => 'TPB', 'code1' => 'TPBank'],
    'TMCP QUOC TE VIET NAM' => ['code' => 'VIB', 'code1' => 'VIB'],
    'TMCP VIET NAM THINH VUONG' => ['code' => 'VPB', 'code1' => 'VPbank'],
    'TMCP SAI GON HA NOI' => ['code' => 'SHB', 'code1' => 'SHB'],
    'TMCP PHUONG DONG' => ['code' => 'OCB', 'code1' => 'ocb-bank'],
    'TMCP NAM A' => ['code' => 'NAB', 'code1' => 'NAB'],
    ];

    $bank_nhan = $_POST["bank_nhan"];
    $code = $bankMap[$bank_nhan]['code'] ?? '';
    $code1 = $bankMap[$bank_nhan]['code1'] ?? '';

    if (strlen($name_nhan) <= 24) {
        canletrai($image, 39, 1635, $textColor, $fontRegular, $name_nhan, 270);
    } else {
        $firstLine = substr($name_nhan, 0, strrpos(substr($name_nhan, 0, 24), ' '));
        $secondLine = trim(substr($name_nhan, strlen($firstLine)));
        canletrai($image, 39, 1635, $textColor, $fontRegular, $firstLine, 270);
        canletrai($image, 39, 1695, $textColor, $fontRegular, $secondLine, 270);
    }

    if (strlen($noidung) <= 36) {
        imagettftext($image, 38, 0, 115, 2070, $textColor, $fontRegular, $noidung);
    } else {
        $first = substr($noidung, 0, 36);
        $second = substr($noidung, 36);
        imagettftext($image, 38, 0, 115, 2070, $textColor, $fontRegular, $first);
        imagettftext($image, 37, 0, 103, 2135, $textColor, $fontRegular, $second);
    }

    canletrai($image, 34, 1740, $grayColor, $fontRegular, $stk_nhan, 270);
    canletrai($image, 34, 1805, $grayColor, $fontRegular, 'NH ' . $bank_nhan, 270);
    canletrai($image, 39, 1200, $textColor, $fontRegular, $name_gui, 270);
    canletrai($image, 34, 1280, $grayColor, $fontRegular, $stkgui, 270);
    canletrai($image, 38, 2338, $textColor, $fontRegular, 'Chuyển tiền nhanh Napas 24/7', 115);
    imagettftext($image, 38, 0, 70, 430, $grayColor, $fontRegular, $time_bill);

    cangiua($image, 64, 865, $blueColor, $fontBold, FormatNumber::TD($sotienchuyen, 2) . ' VND');

    imagettftext($image, 43, 0, 130, 110, imagecolorallocate($image, 0, 0, 0), $fontTime, $thoigiantrendt);

    $ncb = false;
    drawBankIcon($image, $code, $ncb, $ncb ? 805 : 1587);

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);

    $namebill = ['NCB', 'Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}
