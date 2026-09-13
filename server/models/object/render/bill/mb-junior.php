<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && ($_POST['action'] === 'mb-junior' || $_POST['action'] === 'mbjunior')) {
    $tennguoinhan = $_POST["tennguoinhan"] ?? '';
    $stk = $_POST["stk"] ?? '';
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"] ?? 0);
    $nganhangnhan = $_POST["nganhangnhan"] ?? 'vietinbank';
    $thoigianchuyen = $_POST["thoigianchuyen"] ?? date('H:i - d/m/Y');
    $thoigiantrendt = $_POST["thoigiantrendt"] ?? date('H:i');
    $noidungchuyen = $_POST["noidungchuyen"] ?? '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/mb-junior.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';

    $image = imagecreatefromstring(file_get_contents($phoiBank));
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image, 1, 30);
    }    

    if (!file_exists($iconBank)) {
        $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/vietinbank.png';
    }

    if (!function_exists('canchinhphai')) {
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = $imageWidth - $textWidth - $customX;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
    }
    if (!function_exists('canchinhgiua')) {
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
            $imageWidth = imagesx($image);
            $x = (int) (($imageWidth - $textWidth) / 2);
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
    }
    if (!function_exists('canletrai')) {
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
        }
    }
    if (!function_exists('cangiua_nganhang_junior')) {
        function cangiua_nganhang_junior($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 8)
        {
            $icon = imagecreatefrompng($iconBank);
            list($iconWidth, $iconHeight) = ($name_bank === 'ACB') ? [89, 89] : [73, 73];
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));

            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $name_bank);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $iconWidth + 20 + $textWidth;
            $x = ($imageWidth - $totalWidth) / 2;
            $iconY = $y - $iconHeight + $iconOffsetY;
            imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
            imagettftext($image, $fontSize, 0, round($x + $iconWidth + 25), round($y), $textColor, $font, $name_bank);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
    }

    $mbbank = [
        'vietinbank' => 'Vietinbank (CTG)',
        'vietcombank' => 'Vietcombank (VCB)',
        'techcombank' => 'Techcombank (TCB)',
        'acbbank' => 'ACB',
        'agribank' => 'Agribank (ARB)',
        'bidv' => 'BIDV (BIDV)',
        'sacombank' => 'Sacombank (STB)',
        'mbbank' => 'MBBank (MB)',
        'namabank' => 'NamABank',
        'dongabank' => 'DongABank',
        'ocb' => 'OCB',
        'tpbank' => 'TP Bank (TPB)',
        'vpbank' => 'VP Bank (VPB)',
        'sgb' => 'Saigonbank (SGB)',
        'vib' => 'VIB',
        'seabank' => 'SeAbank',
    ];
    $name_bank = isset($mbbank[$nganhangnhan]) ? $mbbank[$nganhangnhan] : ucfirst($nganhangnhan);

    canletrai($image, 42, 105, imagecolorallocate($image, 0, 1, 2), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 136);
    canchinhgiua($image, 66, 830, imagecolorallocate($image, 33, 33, 200), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhgiua($image, 31, 920, imagecolorallocate($image, 102, 102, 102), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $thoigianchuyen);
    canchinhgiua($image, 46, 1210, imagecolorallocate($image, 37, 45, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan);
    cangiua_nganhang_junior($image, 1305, imagecolorallocate($image, 49, 55, 58), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $iconBank, $name_bank, 35, $name_bank === 'ACB' ? 25 : 17);
    canchinhgiua($image, 35, 1392, imagecolorallocate($image, 49, 55, 58), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $stk);
    canchinhgiua($image, 35, 1485, imagecolorallocate($image, 49, 55, 58), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $noidungchuyen);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"] ?? 'wifi', $iconDynamicsIsland ?? 'none');

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['MB Junior', 'Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
