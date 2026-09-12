<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sacombank') {
    $magiaodich = $_POST["magiaodich"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $name_nhan = $_POST["name_nhan"];
    $stk_nhan = FormatNumber::PREG($_POST["stk_nhan"]);
    $stkgui = FormatNumber::PREG($_POST["stkgui"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $bank_nhan = $_POST["bank_nhan"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/sacombank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1.4);
    }    
    function alignRight($image, $text, $font, $size, $color, $y, $nhan = 50) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = imagesx($image) - $text_width - $nhan;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
{


    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;


    imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
}
function canlephai($image, $fontsize, $y, $textColor, $font, $text)
{


    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;


    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 315 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}
function cangiua($image, $fontsize, $y, $textColor, $font, $text)
{
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
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

    alignRight($image, $stkgui, $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1200);
    alignRight($image, $stk_nhan, $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1290);
    alignRight($image, $bank_nhan, $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1380);
    alignRight($image, FormatNumber::TD($sotienchuyen, 2), $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1570);
    alignRight($image, $sotienchuyen, $fontPath.'common/Mulish/Mulish-Bold.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1750);
    canchinhgiua($image, 32, 770, imagecolorallocate($image, 16, 46, 109), $fontPath . 'common/Mulish/Mulish-Bold.ttf', '-' . FormatNumber::TD($sotienchuyen) . "đ");
          alignRight($image, $magiaodich, $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 965);
    alignRight($image, $noidungchuyen, $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1478);
alignRight($image, "Chuyển tiền từ TK Sacombank", $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1055);
alignRight($image, "đến TK NH nội địa", $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1110);
alignRight($image, "0", $fontPath.'common/Mulish/Mulish-Regular.ttf', 30, imagecolorallocate($image, 3, 11, 19), 1660);
    imagettftext($image, 28, 0, 70, 65, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', $thoigiantrendt,);
    canchinhgiua($image, 32, 710, imagecolorallocate($image, 0, 0, 0), $fontPath . 'common/Mulish/Mulish-Regular.ttf', $stk_nhan . ' (' . $name_nhan . ')');
    canchinhgiua($image, 30, 835, imagecolorallocate($image, 142, 142, 142), $fontPath . 'common/Mulish/Mulish-Regular.ttf', $thoigianchuyen, 280);
    
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['Sacombank','Chuyển Khoản'];
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php';
}
