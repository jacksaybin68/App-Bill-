<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && $_POST['action'] === 'namabank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $stkgui = FormatNumber::PREG($_POST["stkgui"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $magiaodich = $_POST["magiaodich"];

    // Hàm ẩn số tài khoản
    function anBotSo($so, $soHienDau = 2, $soHienCuoi = 4, $kyTuAn = '*') {
        $doDai = strlen($so);
        if ($doDai <= ($soHienDau + $soHienCuoi)) return $so;
        $dau = substr($so, 0, $soHienDau);
        $cuoi = substr($so, -$soHienCuoi);
        $an = str_repeat($kyTuAn, $doDai - $soHienDau - $soHienCuoi);
        return $dau . $an . $cuoi;
    }

    $stk_an = anBotSo($stk);
    $stkgui_an = anBotSo($stkgui);

    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/namabank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);

    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';

    if (empty($iconPins) || !file_exists($iconPins)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Hãy chọn dung lượng pin ở cài đặt thông số."]));
    }

    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }

    // Hàm hỗ trợ canh chữ
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null) {
        $textBoundingBox = imagettfbbox($fontsize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($customX === null) ? ($imageWidth - $textWidth - 72) : $customX;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhphai2($image, $fontsize, $y, $textColor, $font, $text, $customX = 98) {
        $textBoundingBox = imagettfbbox($fontsize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontsize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
        imagettftext($image, $fontsize, 0, $x_tcb, $y, $textColor, $font, $text);
    }

    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen($text);
            if ($textLength > 27) {
                $maxCharsPerLine = 25; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 70;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
    // Tính toán tọa độ hiển thị tiền
    $textBox = imagettfbbox(46, 0, $fontPath.'acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen));
    $vndBox = imagettfbbox(26, 0, $fontPath.'acb/NivaSmallCaps-Light.ttf', 'VND');
    $textWidth = $textBox[2] - $textBox[0];
    $vndWidth = $vndBox[2] - $vndBox[0];
    $xAmount = round((imagesx($image) - $textWidth - $vndWidth - 15) / 2);
    $yAmount = 525;
    $xVND = round($xAmount + $textWidth + 15);
    $yVND = 495;
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
    // Vẽ các thành phần lên ảnh
    canchinhgiua($image, 39, 820, imagecolorallocate($image, 21, 96, 235), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $magiaodich);
    canchinhphai($image, 39, 1100, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $tennguoichuyen);
    canchinhphai($image, 39, 1740, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhphai($image, 39, 1383, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $tennguoinhan);
    // canchinhphai_nganhang($image, 39, 1550, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $nganhangnhan, 1.9);
    canchinhphai_noidung($image, 39, 1540, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $nganhangnhan, 1.9);
    canchinhphai($image, 39, 1455, imagecolorallocate($image, 57, 57, 58), $fontPath.'acb/UTM HelveBold.ttf', $stk);
    canchinhphai($image, 40, 1173, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $stkgui_an, 846);
    canchinhphai($image, 39, 965, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $thoigianchuyen);
    canletrai($image, 40, 100, imagecolorallocate($image, 0, 1, 2), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 120);
    canchinhphai($image, 39, 1940, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', $noidungchuyen);
    canchinhphai($image, 39, 2045, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', 'Nhanh NAPAS 247');
    canchinhphai($image, 39, 1845, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', '0 VND');
    canchinhphai($image, 39, 1240, imagecolorallocate($image, 57, 57, 58), $fontPath.'XM Vahid/XM Vahid Bold.ttf', 'Ngan hang TMCP Nam A');

    // Phần phụ trợ
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);

    $namebill = ['Namabank', 'Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
