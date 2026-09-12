<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sodu-vpbank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi/bill/so-du/vpbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $image = imagecreatefrompng($phoiBank);
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/dark.php';
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    } 
     CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
    imagettftext($image, 30, 0, 104, 83, imagecolorallocate($image, 0, 0, 0), $fontPath . '/Inter/Inter-SemiBold.ttf', $thoigiantrendt);
    $balance = $sodu; 
    $vndFont = $fontPath . '/Inter/Inter-SemiBold.ttf'; 
    $balanceSize = 38;
    $formattedBalance = number_format($balance, 0, '', ' ');
    $balanceBox = imagettfbbox($balanceSize, 0, $vndFont, $formattedBalance);
    $balanceWidth = $balanceBox[2] - $balanceBox[0];
    $balanceX = 187; 
    $balanceY = 215; 
    imagettftext($image, $balanceSize, 0, $balanceX, $balanceY, imagecolorallocate($image, 255, 255, 255), $vndFont, $formattedBalance);
    $balanceX += $balanceWidth;
    $smallImagePath = $_SERVER['DOCUMENT_ROOT'] . '/public/src/vtd/img/icon/bank/addon/eye.png';
    $smallImage = imagecreatefrompng($smallImagePath);
    $desiredWidth = 135;  
    $originalWidth = imagesx($smallImage);
    $originalHeight = imagesy($smallImage);
    $aspectRatio = $originalHeight / $originalWidth;
    $desiredHeight = $desiredWidth * $aspectRatio;
    $resizedSmallImage = imagescale($smallImage, (int)$desiredWidth, (int)$desiredHeight);
    if ($resizedSmallImage !== false) {
    $smallImageWidth = imagesx($resizedSmallImage);
    $smallImageHeight = imagesy($resizedSmallImage);
    $smallImageX = $balanceX + 10; 
    $smallImageY = $balanceY - $smallImageHeight + 12;

    imagecopy($image, $resizedSmallImage, $smallImageX, $smallImageY, 0, 0, $smallImageWidth, $smallImageHeight);

    imagedestroy($resizedSmallImage);
    }
    imagedestroy($smallImage);
    $accountNumber = $stk;  
    $accountFont = $fontPath . '/Inter/Inter-Light.ttf'; 
    $prefixFont = $fontPath . '/Inter/Inter-Bold.ttf';  
    $accountSize = 22; 
    $prefixSize = 24;  
    $spacing = 5;  
    $accountX = 425;  
    $accountY = 145;  
    $prefixText = "";
    for ($i = 0; $i < strlen($prefixText); $i++) {
    $char = $prefixText[$i];
    imagettftext($image, $prefixSize, 0, $accountX, $accountY, imagecolorallocate($image, 0, 0, 0), $prefixFont, $char);
    $charBox = imagettfbbox($prefixSize, 0, $prefixFont, $char);
    $charWidth = $charBox[2] - $charBox[0];
    $accountX += $charWidth + $spacing;
    }
    for ($i = 0; $i < strlen($accountNumber); $i++) {
    $char = $accountNumber[$i];
    imagettftext($image, $accountSize, 0, $accountX, $accountY, imagecolorallocate($image, 255, 255, 255), $accountFont, $char);
    $charBox = imagettfbbox($accountSize, 0, $accountFont, $char);
    $charWidth = $charBox[2] - $charBox[0];
    $accountX += $charWidth + $spacing;
    }
    imagedestroy($smallImage);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['VPBank','Số Dư'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
    }
