<?php
use LavenderFakebill\Models\Object\Render\Watermark;
if (isset($_POST['action']) && $_POST['action'] === 'sell-binance') {
    function standardize($number) {
        $number = str_replace('.', '', $number); 
        $number = str_replace(',', '.', $number); 
        return is_numeric($number) ? (float)$number : 0;
    }
    $sUSDT = isset($_POST["usdt"]) ? standardize($_POST["usdt"]) : 0;
    $sVND = isset($_POST["dolar"]) ? standardize($_POST["dolar"]) : 0;
    $gd = isset($_POST["gd"]) && in_array($_POST["gd"], ["dark", "light"]) ? $_POST["gd"] : "dark";
    $quydoiVND = $sUSDT * $sVND;
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/'.($gd === 'dark' ? 'sell-binance-dark.png' : 'sell-binance-light.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    $image = ($gd === "light") ? imagecreatefromjpeg($phoiBank) : imagecreatefrompng($phoiBank);
    if ($gd==='dark') {
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    }
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image,1.4);
    }    
    if (!preg_match('/^[0-9.,]+$/', $sVND)) {
        exit(json_encode(["status" => -1, "msg" => "Số tiền VNĐ chỉ được chứa số, dấu chấm hoặc dấu phẩy."]));
    }
    if (!preg_match('/^[0-9.,]+$/', $sUSDT)) {
        exit(json_encode(["status" => -1, "msg" => "Số tiền USDT chỉ được chứa số, dấu chấm hoặc dấu phẩy."]));
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
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = (int)$fontsize; 
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = (int)(($imageWidth - $textWidth) / 2); 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_tcb; 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function canchinhtien($image, $y, $sVND, $fontPath, $color,$fontSizeVND,$fontSizeSymbol,$d) {
            $bboxSymbol = imagettfbbox($fontSizeSymbol, 0, $fontPath.'/common/PFDinTextCondPro/PFDinTextCondPro-Medium.ttf', '₫');
            $symbolWidth = abs($bboxSymbol[2] - $bboxSymbol[0]);
            $symbolHeight = abs($bboxSymbol[7] - $bboxSymbol[1]);
            $bboxVND = imagettfbbox($fontSizeVND, 0, $fontPath.'/common/PFDinTextCondPro/PFDinTextCondPro-Medium.ttf', $sVND);
            $vndWidth = abs($bboxVND[2] - $bboxVND[0]);
            $vndHeight = abs($bboxVND[7] - $bboxVND[1]);
            $totalWidth = $symbolWidth + 10 + $vndWidth;
            $imageWidth = imagesx($image);
            $xStart = (int)(($imageWidth - $totalWidth) / 2);
            $ySymbol = (int)($y - ($vndHeight / 3) + ($symbolHeight / 4));
            imagettftext($image, $fontSizeSymbol, 0, $xStart, $ySymbol, $color, 
                $fontPath.'/common/San Francisco/SanFranciscoDisplay-Bold.otf', '₫');
            imagettftext($image, $fontSizeVND, 0, $xStart + $symbolWidth + $d, $y, $color, 
                $fontPath.'/common/PFDinTextCondPro/PFDinTextCondPro-Medium.ttf', $sVND);
        }
        if ($gd==='dark') {
        canchinhtien($image, 716, number_format($quydoiVND, 2), $fontPath, imagecolorallocate($image, 255, 255, 255),65,43,25);        
        canchinhgiua($image, 36, 810, imagecolorallocate($image, 212,219,223), $fontPath.'/common/Helvetica/Helvetica.ttf','Bán thành công '.number_format($sUSDT,2).' USDT');
        canletrai($image, 36, 110, imagecolorallocate($image, 255,255,255), $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf', $thoigiantrendt, 130);
        CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);
        } else {
            canchinhtien($image, 350, number_format($quydoiVND, ), $fontPath, imagecolorallocate($image, 31,31,41),33,20,15);        
            canchinhgiua($image, 16, 392, imagecolorallocate($image, 21,25,26), $fontPath.'/common/Helvetica/Helvetica.ttf','Bán thành công '.number_format($sUSDT,1).' USDT');
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        imagedestroy($image);
        $namebill = ['Binance','Bán Binance'];
        require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}