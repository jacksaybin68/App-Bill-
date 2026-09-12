<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-tpbank') {
    $ctk = $_POST["ctk"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/tpbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    } 
     CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    imagettftext($image, 22, 0, 162, 217, imagecolorallocate($image, 42, 31, 77), $fontPath . '/Inter/Inter-Regular.ttf', $ctk);
    imagettftext($image, 30, 0, 110, 80, imagecolorallocate($image, 255, 255, 255), $fontPath . '/Inter/Inter-SemiBold.ttf', $thoigiantrendt);
    $balance = $sodu;
    $vndFont = $fontPath . '/Inter/Inter-Bold.ttf'; 
    $vndFontForVND = $fontPath . '/Inter/Inter-Bold.ttf'; 
    $balanceSize = 37;
    $balanceBox = imagettfbbox($balanceSize, 0, $vndFont, number_format($balance));
    $balanceWidth = $balanceBox[2] - $balanceBox[0];
    $balanceX = 70;
    $balanceY = 448;
    imagettftext($image, $balanceSize, 0, $balanceX, $balanceY, imagecolorallocate($image, 42, 31, 77), $vndFont, number_format($balance));
    $spaceBetweenVND = 10; 
    $vndX = $balanceX + $balanceWidth + $spaceBetweenVND;
    imagettftext($image, $balanceSize, 0, $vndX, $balanceY, imagecolorallocate($image, 42, 31, 77), $vndFontForVND, 'VND');
    $smallImagePath = $_SERVER['DOCUMENT_ROOT'] . '/public/src/vtd/img/icon/bank/addon/mat.png';
    $smallImage = imagecreatefrompng($smallImagePath);
    $desiredWidth = 70; 
    $originalWidth = imagesx($smallImage);
    $originalHeight = imagesy($smallImage);
    $aspectRatio = $originalHeight / $originalWidth;
    $desiredHeight = $desiredWidth * $aspectRatio;
    $resizedSmallImage = imagescale($smallImage, $desiredWidth, $desiredHeight);
    if ($resizedSmallImage !== false) {
    $smallImageWidth = imagesx($resizedSmallImage);
    $smallImageHeight = imagesy($resizedSmallImage);
    $smallImageX = $vndX + 110; 
    $smallImageY = $balanceY - $smallImageHeight + 20;
    imagecopy($image, $resizedSmallImage, $smallImageX, $smallImageY, 0, 0, $smallImageWidth, $smallImageHeight);
    imagedestroy($resizedSmallImage);
    }
    $accountBalance = $stk; 
    $fontForBalance = $fontPath . '/Inter/Inter-Regular.ttf'; 
    $fontForVND = $fontPath . '/Inter/Inter-Regular.ttf'; 
    $fontSize = 24; 
    $balanceBoundingBox = imagettfbbox($fontSize, 0, $fontForBalance, $accountBalance);
    $balanceWidth = $balanceBoundingBox[2] - $balanceBoundingBox[0];
    $balanceXPosition = 115; 
    $balanceYPosition = 387; 
    imagettftext($image, $fontSize, 0, $balanceXPosition, $balanceYPosition, imagecolorallocate($image, 42, 31, 77), $fontForBalance, $accountBalance);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['TPbank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
