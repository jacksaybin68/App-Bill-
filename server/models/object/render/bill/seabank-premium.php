<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'seabank-premium') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $stkgui = $_POST["stkgui"];
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $stknhan = $_POST["stknhan"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $tongtien = FormatNumber::PREG($_POST["tongtien"]);
    $noidungchuyen = $_POST["noidungchuyen"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/seabank-premium.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    $image = imagecreatefromjpeg($phoiBank);
    if ($nganhangnhan === 'vtd') {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,0.8,15,122,400,);
    }    
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($customX === null) ? ($imageWidth - $textWidth - 50) : $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15)
        {
            $imageWidth = imagesx($image);
            $textLength = strlen($text);
            if ($textLength > 20) {
                $maxCharsPerLine = 28; 
            } else {
                $maxCharsPerLine = $defaultMaxCharsPerLine;
            }
            $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 52;
                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
   // function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = 98)
    //{
       // $fontSize = $fontsize;
    //    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
       // $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
     //   $imageWidth = imagesx($image);
     //   $x = $imageWidth - $textWidth - $customX;
      //  imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
   // }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    canbentren($image, 150, 105, imagecolorallocate($image,0,0,0), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 40);
    canchinhphai($image, 35, 760, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $magiaodich);
    canchinhphai($image, 35, 887, imagecolorallocate($image,20,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $stkgui);
    canchinhphai($image, 35, 1020, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $tennguoichuyen);
    canchinhphai($image, 35, 1144, imagecolorallocate($image,0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $nganhangnhan);
    canchinhphai($image, 35, 1330, imagecolorallocate($image,0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $stknhan);
    canchinhphai($image, 35, 1460, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $tennguoinhan);
    canchinhphai($image, 35, 1644, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', FormatNumber::TD($sotienchuyen, 2).' VND');
    canchinhphai($image, 35, 1959, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', FormatNumber::TD($tongtien, 2).' VND');
    canchinhphai_noidung($image, 35, 2090, imagecolorallocate($image, 0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $noidungchuyen, 1.9);
    canchinhphai($image, 35, 2218, imagecolorallocate($image,0,0,0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
    canchinhphai($image, 35, 1774, imagecolorallocate($image, 0, 0, 0), $fontPath.'common/San Francisco/SanFranciscoText-Semibold.otf', '0 VND');
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Seabank Premium','Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
