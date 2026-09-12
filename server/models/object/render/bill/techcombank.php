<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'techcombank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = $_POST["stk"];
    $stkchinh = FormatNumber::PREG($_POST["stkchinh"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $kieuchuyen = $_POST["kieuchuyen"];
    $mathamchieu = $_POST["mathamchieu"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($kieuchuyen === 'macdinh' ? 'tech.png' : 'tech-bdsd.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefrompng($phoiBank);
    if ($nganhangnhan === 'vtd') {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,15,122,400,);
    }    
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
        $fontSize = $fontsize;
        $lines = explode('<br>', $text);
        $lineHeight = $fontsize * 1.7;
        foreach ($lines as $i => $line) {
            $yOffset = $y + ($i * $lineHeight);
            imagettftext($image, (int)round($fontSize), 0, (int)round($x_tcb), (int)round($yOffset), $textColor, $font, $line);
        }
    }
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    function canchinhbdsd($image, $startY, $textColor, $lines) { 
        $currentY = $startY; 
        foreach ($lines as $index => $line) {
            $x = 170;
            $fontsize = $line['fontsize']; 
            $font = $line['font']; 
            $text = $line['text'];
            if ($index > 0) {
                if ($index == 1) {
                    $currentY += 40;
                } else {
                    $currentY += 24; 
                }
            }
            imagettftext($image, (int)round($fontsize), 0, (int)round($x), (int)round($currentY), $textColor, $font, $text);
            $currentY += $fontsize;
        }
    }
    if ($kieuchuyen !== 'macdinh') {
        $lines = [
            ['text' => "- VND ".FormatNumber::TD($sotienchuyen, 2), 'font' => $fontPath.'/common/San Francisco/SanFranciscoText-Medium.otf', 'fontsize' => 28], 
            ['text' => "Tài khoản: ".$stkchinh, 'font' => $fontPath.'/common/Inter/Inter-Regular.otf', 'fontsize' => 21],
            ['text' => "Số dư: VND".str_repeat(" ",2).FormatNumber::TD($soduchinh, 2), 'font' => $fontPath.'/common/Inter/Inter-Regular.otf', 'fontsize' => 21],
            ['text' => $noidungchuyen.'.', 'font' => $fontPath.'/common/Inter/Inter-Regular.otf', 'fontsize' => 21],
            ['text' => "Ma tham chieu ".$mathamchieu, 'font' => $fontPath.'/common/Inter/Inter-Regular.otf', 'fontsize' => 21],
        ];
        canchinhbdsd(
            $image,
            173, 
            imagecolorallocate($image, 5,5,5),
            $lines
        );

    }
    canletrai($image, 43, 550, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'Chuyển thành công<br>VND '.FormatNumber::TD($sotienchuyen, 2), 45);
    canletrai($image, 22, 774, imagecolorallocate($image, 10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan, 48);
    canletrai($image, 22, 808, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stk, 48);
    canletrai($image, 22, 905, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $nganhangnhan, 48);
    canletrai($image, 22, 1002, imagecolorallocate($image, 10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $noidungchuyen, 48);
    canletrai($image, 22, 1100, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigianchuyen, 48);
    canletrai($image, 22, 1199, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $magiaodich, 48);
    canletrai($image, 22, 1295, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $mathamchieu, 48);
    canbentren($image, 65, 65, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 26);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Techcombank','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
