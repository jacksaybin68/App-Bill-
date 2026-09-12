<?php
function CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $tinHieuText, $iconDynamicsIsland) 
{
            extract($GLOBALS);
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $colorTinHieu = (isset($themeDisplay) ? strtolower($themeDisplay) : 'dark') === 'dark' ? [0, 0, 0] : [255, 255, 255];
            $xPin = $imageWidth;
            $iconPin = imagecreatefrompng($iconPins);
            if ($iconPin) {
                $iconWidth = imagesx($iconPin);
                $iconHeight = imagesy($iconPin);
                $resizedIcon = imagecreatetruecolor($sizePin[0], $sizePin[1]);
                imagealphablending($resizedIcon, false);
                imagesavealpha($resizedIcon, true);
                imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $sizePin[0], $sizePin[1], $iconWidth, $iconHeight);
                $xPin = $imageWidth - $sizePin[0] - $marginRightOption;
                $yPin = $marginTopOption + $yOffsetPin;
                imagealphablending($image, true);
                imagesavealpha($image, true);
                imagecopy($image, $resizedIcon, $xPin, $yPin, 0, 0, $sizePin[0], $sizePin[1]);
                imagedestroy($iconPin);
                imagedestroy($resizedIcon);
            }
            $xWifi = $xPin;
            if (stripos($tinHieuText, 'wifi') !== false) {
                $iconWifi = @getimagesize($iconTinHieu) ? imagecreatefrompng($iconTinHieu) : false;
                if ($iconWifi !== false) {
                    $iconWidth = imagesx($iconWifi);
                    $iconHeight = imagesy($iconWifi);
                    $resizedIcon = imagecreatetruecolor($sizeWifi[0], $sizeWifi[1]);
                    imagealphablending($resizedIcon, false);
                    imagesavealpha($resizedIcon, true);
                    imagecopyresampled($resizedIcon, $iconWifi, 0, 0, 0, 0, $sizeWifi[0], $sizeWifi[1], $iconWidth, $iconHeight);
                    $xWifi = $xPin - $sizeWifi[0] - $spacingCombo;
                    $yWifi = $marginTopOption + $yOffsetWifi;
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    imagecopy($image, $resizedIcon, (int)$xWifi, (int)$yWifi, 0, 0, $sizeWifi[0], $sizeWifi[1]);
                    imagedestroy($iconWifi);
                    imagedestroy($resizedIcon);
                } else {
                    $xWifi = $xPin - 30 - $spacingCombo;
                }
            } else {
                $font = $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf';
                $textColor = imagecolorallocate($image, $colorTinHieu[0], $colorTinHieu[1], $colorTinHieu[2]);
                if (strcasecmp($tinHieuText, 'lte') === 0) {
                    $fontSizeTinHieu -= 4;
                }
                $textBox = imagettfbbox($fontSizeTinHieu, 0, $font, strtoupper($tinHieuText));
                $textWidth = $textBox[2] - $textBox[0];
                $textHeight = $textBox[1] - $textBox[7];
                $xWifi = $xPin - $textWidth - $spacingCombo; 
                $yWifi = $marginTopOption + $yOffsetMangText + $textHeight / 2;
                imagettftext($image, $fontSizeTinHieu, 0, (int)$xWifi, (int)$yWifi, $textColor, $font, strtoupper($tinHieuText));
            }
            $iconSignal = @getimagesize($vachsong) ? imagecreatefrompng($vachsong) : false;
            if ($iconSignal !== false) {
                $iconWidth = imagesx($iconSignal);
                $iconHeight = imagesy($iconSignal);
                $resizedIcon = imagecreatetruecolor($sizeSignal[0], $sizeSignal[1]);
                imagealphablending($resizedIcon, false);
                imagesavealpha($resizedIcon, true);
                imagecopyresampled($resizedIcon, $iconSignal, 0, 0, 0, 0, $sizeSignal[0], $sizeSignal[1], $iconWidth, $iconHeight);
                $xSignal = $xWifi - $sizeSignal[0] - $spacingCombo; 
                $ySignal = $marginTopOption + $yOffsetSignal;
                imagealphablending($image, true);
                imagesavealpha($image, true);
                imagecopy($image, $resizedIcon, $xSignal, $ySignal, 0, 0, $sizeSignal[0], $sizeSignal[1]);
                imagedestroy($iconSignal);
                imagedestroy($resizedIcon);
            }
            if (!empty($DynamicsIsland)) {
                if (!isset($DynamicsIsland) || !in_array($DynamicsIsland, [1, 2, 3, 4])) {
                    die(JSON_FORMATTER([
                        "status" => -1,
                        "msg" => "Tai Thỏ / Dynamics Island không hợp lệ.",
                    ]));
                }        
                if (file_exists($iconDynamicsIsland)) {
                    $iconDynamics = @imagecreatefrompng($iconDynamicsIsland);
                    if ($iconDynamics) {
                        $iconWidth = imagesx($iconDynamics);
                        $iconHeight = imagesy($iconDynamics);
                        $sizeDynamics = !empty($sizeDynamics) ? $sizeDynamics : [$iconWidth, $iconHeight];
                        $resizedIcon = imagecreatetruecolor($sizeDynamics[0], $sizeDynamics[1]);
                        imagealphablending($resizedIcon, false);
                        imagesavealpha($resizedIcon, true);
                        imagecopyresampled($resizedIcon, $iconDynamics, 0, 0, 0, 0, $sizeDynamics[0], $sizeDynamics[1], $iconWidth, $iconHeight);
                        
                        $xDynamics = ($imageWidth - $sizeDynamics[0]) / 2;
                        $yDynamics = 20;
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                        imagecopy($image, $resizedIcon, (int)$xDynamics, (int)$yDynamics, 0, 0, $sizeDynamics[0], $sizeDynamics[1]);
                
                        imagedestroy($iconDynamics);
                        imagedestroy($resizedIcon);
                    }
                }
                
            }
            
}
function billsettings_check($name, $min, $max, $msg) {
    if (!isset($_POST[$name]) || !filter_var($_POST[$name], FILTER_VALIDATE_INT, [
        "options" => ["min_range" => $min, "max_range" => $max]
    ])) {
        die(JSON_FORMATTER([
            "status" => -1,
            "msg" => $msg,
        ]));
    }
}
if (empty($_POST['vachsong'])) {
    die(JSON_FORMATTER([
        "status" => -1,
        "msg" => "Vui lòng chọn 1 cột sóng.",
    ]));
} elseif (empty($_POST['tin-hieu'])) {
    die(JSON_FORMATTER([
        "status" => -1,
        "msg" => "Vui lòng chọn 1 tín hiệu.",
    ]));
}
billsettings_check('pin', 1, 100, 'Dung lượng pin chỉ được phép nhập từ 1 ~ 100.');
billsettings_check('vachsong', 1, 4, 'Vạch sóng chỉ được phép nhập từ 1 ~ 4.');
include_once($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/func.php');