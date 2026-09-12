<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && $_POST['action'] === 'ocb') {
    
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];

    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/ocb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';

    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    
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
        list($iconWidth, $iconHeight) = ($bankCode === 'ACB') ? [89, 89] : [89, 89];

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

    $mbbank = [
        'vietinbank' => 'Ngân hàng TMCP Công Thương Việt Nam',
        'vietcombank' => 'Ngân hàng Ngoại Thương Việt Nam',
        'techcombank' => 'Ngân hàng TMCP Kỹ Thương Việt Nam',
        'acbbank' => 'Ngân hàng TMCP Á Châu',
        'agribank' => 'Ngân hàng Nông Nghiệp Và PT Nông Thôn',
        'bidv' => 'Ngân hàng TMCP Đầu Tư Và Phát Triển',
        'sacombank' => 'Ngân hàng TMCP Sài Gòn Thương Tín',
        'mbbank' => 'Ngân hàng Quân Đội',
        'namabank' => 'Ngân hàng TMCP Nam Á',
        'dongabank' => 'Ngân hàng TMCP Đông Á',
        'ocb' => 'Ngân hàng TMCP Phương Đông',
        'tpbank' => 'Ngân hàng TMCP Tiên Phong',
        'vpbank' => 'Ngân hàng TMCP Việt Nam Thịnh Vượng',
        'sgb' => 'Ngân hàng TMCP Sài Gòn Công Thương',
        'vib' => 'Ngân hàng TMCP Quốc Tế Việt Nam',
        'seabank' => 'Ngân hàng TMCP Đông Nam Á',
    ];
    $name_bank = isset($mbbank[$nganhangnhan]) ? $mbbank[$nganhangnhan] : ucfirst($nganhangnhan);


    imagettftext($image, 38, 0, 130, 90, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt);
                
    cangiua($image, 71, 720, imagecolorallocate($image, 0, 128, 75), $fontPath.'vietcombank/Manrope-Bold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');

    cangiua($image, 27, 560, imagecolorallocate($image, 100, 99, 107), $fontPath.'Inter/Inter-Regular.ttf', $thoigianchuyen);

    canletrai($image, 38, 1480, imagecolorallocate($image, 0, 0, 0), $fontPath.'Inter/Inter-SemiBold.ttf', $tennguoinhan, 275);

    drawBankIcon($image, $iconBank, 135, 1470 - 60 + 30, $name_bank);

    drawBankName($image, $name_bank, $fontPath.'Inter/Inter-Regular.ttf', 33, imagecolorallocate($image, 100, 99, 107), 135 + 89 + 52, 1555);

    canletrai($image, 34, 1630 , imagecolorallocate($image, 100, 99, 107), $fontPath . 'Inter/Inter-Regular.ttf', $stk, 275);

    cangiua($image, 39, 810, imagecolorallocate($image, 0, 0, 0), $fontPath.'vietcombank/Manrope-Medium.ttf', $noidungchuyen);

    // cangiua($image, 42, 1930, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stkgui);

    // cangiua($image, 42, 2080, imagecolorallocate($image, 66, 66, 66), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $magiaodich);

    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);

    // Gọi render model
    $namebill = ['OCB','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
?>
