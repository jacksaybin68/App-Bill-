<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'bdsd-mbbank') {
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotiengd = FormatNumber::PREG($_POST["sotiengd"]);
    $soduchinh = $_POST["soduchinh"];
    $phuongthuc = $_POST["phuongthuc"];
    $ctknhan = trim($_POST["ctk-nhan"]);
    $stknhan = trim($_POST["stk-nhan"]);
    $magiaodich = $_POST["magiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/bdsd/mb-bdsd.jpeg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,20,120);
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
    function canletraibdsdmb($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
        $fontSize = $fontsize;
        $lines = explode('<br>', $text);
        $lineHeight = $fontsize * 1.5;
        foreach ($lines as $i => $line) {
            $yOffset = $y + ($i * $lineHeight);
            imagettftext($image, $fontSize, 0, $x_tcb, $yOffset, $textColor, $font, $line);
        }
    }

    if ($phuongthuc === 'chuyentien') {
        if (empty($ctknhan) || empty($stknhan)) {
            exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng điền đầy đủ thông tin!"]));
        }
        $hk_bdsd = "TK ".FormatStk($stk)."|GD: -".FormatNumber::TD($sotiengd,2)."VND ". $thoigianchuyen." |SD: ".$soduchinh."VND|DEN: $ctknhan - $stknhan|ND: $noidungchuyen - Ma GD ACSP/ $magiaodich";
    } else if ($phuongthuc === 'nhantien') {
        $hk_bdsd = "TK ".FormatStk($stk)."|GD: +".FormatNumber::TD($sotiengd,2)."VND ". $thoigianchuyen." |SD: ".$soduchinh."VND|ND: $noidungchuyen";
    } else {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Method bill has been blocked."]));
    }
    function BDSD($image, $text, $x, $y, $fontSize, $fontFile, $color, $margin) {
        $imageWidth = imagesx($image);
        $maxLineWidth = $imageWidth - 2 * $margin;
        $lines = [];
        $currentLine = '';
        $words = explode(' ', $text);
        foreach ($words as $word) {
            $testLine = $currentLine.' '.$word;
            $textBox = imagettfbbox($fontSize, 0, $fontFile, $testLine);
            $textWidth = $textBox[2] - $textBox[0];
            if ($textWidth > $maxLineWidth) {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }
        $lines[] = trim($currentLine);
        foreach ($lines as $line) {
            imagettftext($image, $fontSize, 0, intval($x), intval($y), $color, $fontFile, $line);
            $y += intval($fontSize * 1.7);
        }
    }
    BDSD($image, $hk_bdsd, 84, 490, 27, $fontPath.'Inter-Regular.ttf', imagecolorallocate($image, 5,5,5), 90);    
    canletraibdsdmb($image, 31, 73, imagecolorallocate($image, 10,9,8), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 90);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['MB Bank','Biến Động'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
