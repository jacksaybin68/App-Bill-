<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'bdsd-techcombank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk_nc = $_POST["stk_nc"];
    $stk = $_POST["stk"];
    $sotiennhan = FormatNumber::PREG($_POST["sotiennhan"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $magiaodich = $_POST["magiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $bdsd = $_POST["bdsd"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/bdsd/'.($bdsd === 'nhantien' ? 'techcombank-bdsd-nhan-tien.jpg' : 'techcombank-bdsd-chuyen-tien.jpg');
    $addonTcb = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/addons-tcb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.6,13,180,300);
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
    function canletraibdsdtech($image, $fontsize, $y, $textColor, $font, $text, $x_tcb, $imageWidth, $marginRight)
    {
        $fontSize = $fontsize;
        $words = explode(' ', $text);
        $lineHeight = $fontsize * 1.5;
        $currentLine = '';
        $lines = [];
        $maxWidth = $imageWidth - $x_tcb - $marginRight;
        foreach ($words as $word) {
            $testLine = $currentLine . ' ' . $word;
            $textBox = imagettfbbox($fontSize, 0, $font, $testLine);
            $textWidth = $textBox[2] - $textBox[0];

            if ($textWidth > $maxWidth) {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }
        $lines[] = trim($currentLine);

        foreach ($lines as $i => $line) {
            $yOffset = $y + ($i * $lineHeight);
            imagettftext($image, intval($fontSize), 0, intval($x_tcb), intval($yOffset), $textColor, $font, $line);
        }
    }
    $tcb = [
        "vietinbank" => "NGAN HANG TMCP CONG THUONG VIET NAM",
        "vietcombank" => "NGAN HANG TMCP NGOAI THUONG VIET NAM",
        "bidv" => "NGAN HANG TMCP DAU TU VA PHAT TRIEN VIET NAM",
        "seabank" => "NGAN HANG TMCP DONG A",
        "techcombank" => "NGAN HANG TMCP KY THUONG VIET NAM",
        "agribank" => "NGAN HANG NONG NGHIEP VA PHAT TRIEN NONG THON VIET NAM",
        "ocb" => "NGAN HANG TMCP PHUONG DONG",
        "mb" => "NGAN HANG TMCP QUAN DOI",
        "acb" => "NGAN HANG TMCP A CHAU",
        "vpbank" => "NGAN HANG TMCP VIET NAM THINH VUONG",
        "tpbank" => "NGAN HANG TMCP TIEN PHONG",
        "sacombank" => "NGAN HANG TMCP SAI GON THUONG TIN",
        "shb" => "NGAN HANG TMCP SAI GON-HA NOI",
        "sgb" => "NGAN HANG TMCP SAI GON CONG THUONG",
        "oceanbank" => "NGAN HANG TMCP DAI DUONG",
        "vietabank" => "NGAN HANG TMCP VIET A",
        "namabank" => "NGAN HANG TMCP NAM A",
        "dongabank" => "NGAN HANG TMCP DONG A",
        "vietbank" => "NGAN HANG TMCP VIET NAM THUONG TIN",
        "scb" => "NGAN HANG SAI GON CONG THUONG",
        "vib" => "NGAN HANG TMCP QUOC TE VIET NAM",
        "msb" => "NGAN HANG TMCP HANG HAI VIET NAM",
        "lpb" => "NGAN HANG LIEN VIET POST BANK",
        "abbank" => "NGAN HANG TMCP AN BINH",
        "ncb" => "NGAN HANG TMCP QUOC DAN",
        "pgb" => "NGAN HANG TMCP THINH VUONG VA PHAT TRIEN"
    ];
    
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize)
    {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    if ($bdsd === 'nhantien') {
        canletraibdsdtech($image, 18, 526, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoichuyen, 36, imagesx($image), 10);
        canletraibdsdtech($image, 25, 400, imagecolorallocate($image, 95, 94, 90), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'VND', 34, imagesx($image), 10);
        canletraibdsdtech($image, 30, 400, imagecolorallocate($image, 59, 196, 95), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', '' . FormatNumber::TD($sotiennhan, 2), 105, imagesx($image), 10);
        canletraibdsdtech($image, 18, 684, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan, 36, imagesx($image), 10);
        canletraibdsdtech($image, 16, 718, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', $nganhangnhan, 35, imagesx($image), 10);
        canletraibdsdtech($image, 17, 743, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', $stk, 35, imagesx($image), 10);
        canletraibdsdtech($image, 17, 560, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', 'Techcombank', 35, imagesx($image), 10);
        canletraibdsdtech($image, 17, 585, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', $stk_nc, 35, imagesx($image), 10);
        canletraibdsdtech($image, 16, 839, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', VnTones($noidungchuyen), 35, imagesx($image), 120);
        canletraibdsdtech($image, 13, 900, imagecolorallocate($image, 10, 9, 8), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'Mã giao dịch: ' . $magiaodich.'/BNK', 36, imagesx($image), 10);
    } elseif ($bdsd === 'chuyentien') {
        canletraibdsdtech($image, 18, 526, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoichuyen, 36, imagesx($image), 10);
        canletraibdsdtech($image, 25, 395, imagecolorallocate($image, 95, 94, 90), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'VND', 55, imagesx($image), 10);
        canletraibdsdtech($image, 30, 395, imagecolorallocate($image, 1, 1, 1), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', '' . FormatNumber::TD($sotiennhan, 2), 127, imagesx($image), 10);
        canletraibdsdtech($image, 19, 684, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan, 36, imagesx($image), 10);
        canletraibdsdtech($image, 16, 716, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', strtoupper($tcb[strtolower($nganhangnhan)]).' ('.strtoupper($nganhangnhan).')', 35, imagesx($image), 120);
        $y_stk = (mb_strlen($tcb[strtolower($nganhangnhan)], 'UTF-8') > 30) ? 764 : 743;
        canletraibdsdtech($image, 17, $y_stk, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', $stk, 34, imagesx($image), 10);
        canletraibdsdtech($image, 17, 560, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', 'Techcombank', 35, imagesx($image), 10);
        canletraibdsdtech($image, 17, 585, imagecolorallocate($image, 28, 27, 24), $fontPath . 'common/Roboto/Roboto-Regular.ttf', $stk_nc, 35, imagesx($image), 10);
        canletraibdsdtech($image, 16, 866, imagecolorallocate($image, 20, 20, 17), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', VnTones($noidungchuyen), 35, imagesx($image), 120);
        canletraibdsdtech($image, 13, 930, imagecolorallocate($image, 10, 9, 8), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'Mã giao dịch: ' . $magiaodich, 36, imagesx($image), 10);
    } else {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Method bill has been blocked."]));
    }
    canletraibdsdtech($image, 16, 429, imagecolorallocate($image, 75, 75, 65), $fontPath . '/common/Roboto/Roboto-Regular.ttf', $thoigianchuyen, 35, imagesx($image), 10);
    canbentren($image, 52, 40, imagecolorallocate($image, 250, 250, 250), $fontPath . '/common/San Francisco/SanFranciscoDisplay-Bold.otf', $thoigiantrendt, 18);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Techcombank','Biến Động'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}
