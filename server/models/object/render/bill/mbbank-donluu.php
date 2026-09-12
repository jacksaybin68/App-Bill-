<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'mbbank-don-luu') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $gd = FormatNumber::PREG($_POST["gd"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $convertGD = [
        1 => ['themeName' => 'mb-tutinketnoi', 'colorTime' => '198,218,255', 'themeDisplay' => 'light', 'colorMoney' => '137,231,255', 'colorContent' => '255,255,255'],
        2 => ['themeName' => 'mb-tuhaovietnam', 'colorTime' => '255,255,255', 'themeDisplay' => 'light', 'colorMoney' => '253,185,55', 'colorContent' => '255,255,255'],
        3 => ['themeName' => 'mb-sweetlove', 'colorTime' => '97,96,101', 'themeDisplay' => 'dark', 'colorMoney' => '95,20,204', 'colorContent' => '29,43,53'],
        4 => ['themeName' => 'mb-mondaymood', 'colorTime' => '146,136,149', 'themeDisplay' => 'dark', 'colorMoney' => '206,22,49', 'colorContent' => '9,81,118'],
        5 => ['themeName' => 'mb-pholang', 'colorTime' => '206,215,251', 'themeDisplay' => 'dark', 'colorMoney' => '153,235,238', 'colorContent' => '254,250,242'],
        6 => ['themeName' => 'mb-meothantai', 'colorTime' => '180,149,121', 'themeDisplay' => 'light', 'colorMoney' => '199,60,33', 'colorContent' => '30,30,30'],
        7 => ['themeName' => 'mb-khatvongvuoncao', 'colorTime' => '101,104,109', 'themeDisplay' => 'light', 'colorMoney' => '109,70,251', 'colorContent' => '31,43,54'],
        8 => ['themeName' => 'mb-chinhphucdinhcao', 'colorTime' => '174,207,219', 'themeDisplay' => 'light', 'colorMoney' => '242,146,108', 'colorContent' => '254,253,254'],
         9 => ['themeName' => 'mb-binhan', 'colorTime' => '97,96,101', 'themeDisplay' => 'light', 'colorMoney' => '98,145,1', 'colorContent' => '29,43,53'],
         10 => ['themeName' => 'mb-pickleball', 'colorTime' => '97,96,101', 'themeDisplay' => 'light', 'colorMoney' => '44,106,213', 'colorContent' => '26,46,57'],
         11 => ['themeName' => 'mb-bethesky', 'colorTime' => '97,96,101', 'themeDisplay' => 'light', 'colorMoney' => '57,91,147', 'colorContent' => '26,46,57'],
         12 => ['themeName' => 'mb-khampha', 'colorTime' => '97,96,101', 'themeDisplay' => 'light', 'colorMoney' => '91,122,216', 'colorContent' => '26,46,57'],
         13 => ['themeName' => 'mb-canhenmuaxuan', 'colorTime' => '203,214,241', 'themeDisplay' => 'light', 'colorMoney' => '166,222,239', 'colorContent' => '249,251,247'],
         14 => ['themeName' => 'mb-diudang', 'colorTime' => '188,128,146', 'themeDisplay' => 'light', 'colorMoney' => '225,75,123', 'colorContent' => '26,46,57'],
        15 => ['themeName' => 'mb-dreambig', 'colorTime' => '230,206,240', 'themeDisplay' => 'dark', 'colorMoney' => '252,160,225', 'colorContent' => '251,253,251'],
        16 => ['themeName' => 'mb-nammoirucro', 'colorTime' => '230,206,240', 'themeDisplay' => 'dark', 'colorMoney' => '254,170,223', 'colorContent' => '251,253,251'],
        17 => ['themeName' => 'mb-higreen', 'colorTime' => '112,115,116', 'themeDisplay' => 'dark', 'colorMoney' => '4,166,117', 'colorContent' => '26,44,54'],
        18 => ['themeName' => 'mb-nhipdapsanco', 'colorTime' => '189,197,218', 'themeDisplay' => 'dark', 'colorMoney' => '53,250,190', 'colorContent' => '250,252,253'],
        19 => ['themeName' => 'mb-tienbuocvungvang', 'colorTime' => '178,178,205', 'themeDisplay' => 'dark', 'colorMoney' => '124,230,254', 'colorContent' => '251,249,250'],
        20 => ['themeName' => 'mb-tretrung', 'colorTime' => '101,105,108', 'themeDisplay' => 'dark', 'colorMoney' => '21,31,216', 'colorContent' => '34,52,64'],
        21 => ['themeName' => 'mb-truongsaxanh', 'colorTime' => '101,105,108', 'themeDisplay' => 'dark', 'colorMoney' => '40,116,55', 'colorContent' => '34,52,64'],
    ];
    $gdData = $convertGD[$gd] ?? [
        'themeName' => 'mb-tutinketnoi',
        'colorTime' => '255,255,255',
        'themeDisplay' => 'light',
        'colorMoney' => '37,231,255',
        'colorContent' => '255,255,255'
    ];
    $themeName = $gdData['themeName'];
    $themeDisplay = $gdData['themeDisplay'];
    list($rTime, $gTime, $bTime) = explode(',', $gdData['colorTime']);
    list($rMoney, $gMoney, $bMoney) = explode(',', $gdData['colorMoney']);
    list($rContent, $gContent, $bContent) = explode(',', $gdData['colorContent']);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/don-luu/'.$themeName.'.jpeg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefromjpeg($phoiBank);
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1,30,100);
    }    
    // CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
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
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
        $imageWidth = imagesx($image);
        $x = (int) (($imageWidth - $textWidth) / 2);
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
    {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
    }

    function cangiua_nganhang($image, $y, $textColor, $font, $iconBank, $name_bank, $fontSize, $iconOffsetY = 5)
    {
        $icon = imagecreatefrompng($iconBank);
        list($iconWidth, $iconHeight) = ($name_bank === 'ACB') ? [64, 64] : [49, 49];
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
        imagettftext($image, $fontSize, 0, round($x + $iconWidth + 18), round($y), $textColor, $font, $name_bank);
        imagedestroy($icon);
        imagedestroy($resizedIcon);
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
    $name_bank = $mbbank[$nganhangnhan];
    function CanThoiGian($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 78; 
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
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
    $width = imagesx($image);
    $height = imagesy($image);
    $dest_img = imagecreatetruecolor($width, $height);
    // $lenxuongSodu = ($themeName === 'mb-macdinh') ? 616 : (($themeName === 'mb-higreen') ? 620 : 593);
    // $traiphaiSodu = ($themeName === 'mb-macdinh') ? 460 : (($themeName === 'mb-higreen') ? 460 : 442);
    imagecopy($dest_img, $image, 0, 0, 0, 0, $width, $height);
    canchinhgiua($dest_img, 47, 745, imagecolorallocate($image, $rMoney, $gMoney, $bMoney), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhgiua($dest_img, 22, 805, imagecolorallocate($image, $rTime, $gTime, $bTime), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $thoigianchuyen);
    canchinhgiua($dest_img, 29, 952, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Semibold.otf', $tennguoinhan);
    cangiua_nganhang($dest_img, 1012, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $iconBank, $name_bank, 25,$name_bank === 'ACB' ? 18 : 12);
    canchinhgiua($dest_img, 25, 1070, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $stk);
    canchinhgiua($dest_img, 25, 1130, imagecolorallocate($image, $rContent, $gContent, $bContent), $fontPath.'common/AvertaStd/AvertaStd-Regular.otf', $noidungchuyen);
    // CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', 26, imagecolorallocate($dest_img, ...(($themeDisplay === 'dark') ? [0, 0, 0] : [255, 255, 255])), 65);    
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($dest_img);
    $namebill = ['MB Bank','Đơn Lưu'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}