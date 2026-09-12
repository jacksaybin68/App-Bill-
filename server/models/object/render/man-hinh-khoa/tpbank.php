<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (!function_exists('validateAvatar')) {
    function validateAvatar($anhnen = null) {
        if ($anhnen === null) {
            return null;
        }
        if (preg_match('/^data:image\/(\w+);base64,/', $anhnen, $type)) {
            $data = substr($anhnen, strpos($anhnen, ',') + 1);
            $type = strtolower($type[1]);
            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                die(JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Ảnh thẻ chỉ hỗ trợ các định dạng JPG/PNG/JPEG.",
                ]));
            }
            $data = base64_decode($data);
            if ($data === false) {
                die(JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Lỗi giải mã dữ liệu ảnh nền điện thoại.",
                ]));
            }
            return ['data' => $data, 'type' => $type];
        } else {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Vui lòng upload file ảnh nền điện thoại.",
            ]));
        }
    }
}

if (!function_exists('cropImageToIPhoneSize')) {
    function cropImageToIPhoneSize($imageData, $imageType) {
        if ($imageType === 'png') {
            $image = imagecreatefromstring($imageData);
        } else {
            $image = imagecreatefromstring($imageData);
            if (!$image) {
                $image = imagecreatefromjpeg($imageData);
            }
        }

        if (!$image) {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Không thể tạo ảnh từ dữ liệu.",
            ]));
        }

        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        $targetWidth = 1170;
        $targetHeight = 2532;
        $targetRatio = $targetWidth / $targetHeight;
        $imageRatio = $origWidth / $origHeight;
        if ($imageRatio > $targetRatio) {
            $newWidth = $origHeight * $targetRatio;
            $newHeight = $origHeight;
            $srcX = ($origWidth - $newWidth) / 2;
            $srcY = 0;
        } else {
            $newWidth = $origWidth;
            $newHeight = $origWidth / $targetRatio;
            $srcX = 0;
            $srcY = ($origHeight - $newHeight) / 2;
        }
        $newWidth = intval($newWidth);
        $newHeight = intval($newHeight);
        $srcX = intval($srcX);
        $srcY = intval($srcY);
        $croppedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled(
            $croppedImage, $image,
            0, 0, 
            $srcX, $srcY,
            $targetWidth, $targetHeight,
            $newWidth, $newHeight 
        );
        imagedestroy($image);
        ob_start();
        imagejpeg($croppedImage, null, 95);
        $croppedData = ob_get_clean();
        $base64 = 'data:image/jpeg;base64,' . base64_encode($croppedData);
        imagedestroy($croppedImage);

        return $base64;
    }
}

function loadBackgroundImageTpbank($anhnen) {
    $image = imagecreatefromjpeg($anhnen);
    if (!$image) {
        die(JSON_FORMATTER([
            "status" => -1,
            "msg" => "Không thể tải ảnh nền.",
        ]));
    }
    return $image;
}

function applyWatermarkTpbank($image) {
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        return Watermark::Render($image, 1.2, 30);
    }
    return $image;
}

function canchinhbdsdTpbank($image, $fontsize, $y, $textColor, $font, $thoigianchuyen, $stk, $cachthuc, $sotien, $soduchinh) {
    $imageWidth = imagesx($image);
    $x = 213;
    $lineHeight = $fontsize + 30;
    $dt = DateTime::createFromFormat('d/m/Y H:i', $thoigianchuyen) ?: DateTime::createFromFormat('H:i - d/m/Y', $thoigianchuyen);
    $thoigianFormatted = $dt ? $dt->format('y/m/d;H:i') : $thoigianchuyen;
    $stkMasked = 'xxxx' . substr($stk, -4);
    $lines = [
        "(TPBank): $thoigianFormatted",
        "TK: $stkMasked",
        "PS: {$cachthuc}" . number_format($sotien, 0, ',', ',') . "VND",
        "SD: " . number_format($soduchinh, 0, ',', ',') . "VND..."
    ];
    foreach ($lines as $index => $line) {
        $lineDraw = $line;
        $boundingBox = imagettfbbox($fontsize, 0, $font, $lineDraw);
        $lineWidth = $boundingBox[2] - $boundingBox[0];
        $maxWidth = $imageWidth - 295;

        if ($lineWidth > $maxWidth) {
            while (imagettfbbox($fontsize, 0, $font, $lineDraw . '...')[2] - $boundingBox[0] > $maxWidth) {
                $lineDraw = mb_substr($lineDraw, 0, -1, 'UTF-8');
            }
            $lineDraw .= '...';
        }

        imagettftext($image, $fontsize, 0, $x, $y + ($index * $lineHeight), $textColor, $font, $lineDraw);
    }

    return ['lines' => $lines, 'lineCount' => 4];
}

function createBlurredNotificationBackgroundTpbank($image, $notificationX, $notificationY, $notificationWidth, $notificationHeight) {
    $notificationBg = imagecreatetruecolor($notificationWidth, $notificationHeight);
    imagesavealpha($notificationBg, true); 
    imagecopy($notificationBg, $image, 0, 0, $notificationX, $notificationY, $notificationWidth, $notificationHeight);
    for ($i = 0; $i < 60; $i++) {
        imagefilter($notificationBg, IMG_FILTER_GAUSSIAN_BLUR);
    }
    imagefilter($notificationBg, IMG_FILTER_BRIGHTNESS, -28);
    return $notificationBg;
}

function createRoundedNotificationTpbank($notificationBg, $notificationWidth, $notificationHeight, $radius) {
    $roundedNotification = imagecreatetruecolor($notificationWidth, $notificationHeight);
    $transparent = imagecolorallocatealpha($roundedNotification, 0, 0, 0, 127);
    $opaque = imagecolorallocate($roundedNotification, 255, 255, 255);
    imagefill($roundedNotification, 0, 0, $transparent);
    imagefilledarc($roundedNotification, $radius, $radius, $radius * 2, $radius * 2, 180, 270, $opaque, IMG_ARC_PIE);
    imagefilledarc($roundedNotification, $notificationWidth - $radius, $radius, $radius * 2, $radius * 2, 270, 360, $opaque, IMG_ARC_PIE);
    imagefilledarc($roundedNotification, $radius, $notificationHeight - $radius, $radius * 2, $radius * 2, 90, 180, $opaque, IMG_ARC_PIE);
    imagefilledarc($roundedNotification, $notificationWidth - $radius, $notificationHeight - $radius, $radius * 2, $radius * 2, 0, 90, $opaque, IMG_ARC_PIE);
    imagefilledrectangle($roundedNotification, $radius, 0, $notificationWidth - $radius, $notificationHeight, $opaque);
    imagefilledrectangle($roundedNotification, 0, $radius, $notificationWidth, $notificationHeight - $radius, $opaque);
    for ($x = 0; $x < $notificationWidth; $x++) {
        for ($y = 0; $y < $notificationHeight; $y++) {
            $maskColor = imagecolorat($roundedNotification, $x, $y);
            if ($maskColor == $opaque) {
                $color = imagecolorat($notificationBg, $x, $y);
                imagesetpixel($roundedNotification, $x, $y, $color);
            }
        }
    }
    imagealphablending($roundedNotification, true);
    imagesavealpha($roundedNotification, true);
    return $roundedNotification;
}

function canchinhgiuaTpbank($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
    $imageWidth = imagesx($image);
    $x = (int) (($imageWidth - $textWidth) / 2);
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}

function canletraiTpbank($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
    $fontSize = $fontsize;
    imagettftext($image, $fontSize, 0, (int)$x_tcb, (int)$y, $textColor, $font, $text);
}

function canchinhphaiTpbank($image, $fontsize, $y, $textColor, $font, $text, $customX = null) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($customX === null) ? ($imageWidth - $textWidth - 96) : $customX;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}

function HomeBarsTpbank($image) {
    $homebarIcon = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/addon/home-bar.png';
    $homebar1 = imagecreatefrompng($homebarIcon);
    if ($homebar1) {
        $homebarWidth = imagesx($homebar1);
        $homebarHeight = imagesy($homebar1);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $xBottom = ($imageWidth - $homebarWidth) / 2;
        $yBottom = $imageHeight - $homebarHeight - 5;
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagecopy($image, $homebar1, $xBottom, $yBottom, 0, 0, $homebarWidth, $homebarHeight);
        imagedestroy($homebar1);
    }
    $homebar2 = imagecreatefrompng($homebarIcon);
    if ($homebar2) {
        $homebarWidth = imagesx($homebar2);
        $homebarHeight = imagesy($homebar2);
        $imageWidth = imagesx($image);
        $scale = 0.4;
        $newHomebarWidth = intval($homebarWidth * 0.3);
        $newHomebarHeight = intval($homebarHeight * $scale);
        $resizedHomebar = imagecreatetruecolor($newHomebarWidth, $newHomebarHeight);
        imagealphablending($resizedHomebar, false);
        imagesavealpha($resizedHomebar, true);
        imagecopyresampled($resizedHomebar, $homebar2, 0, 0, 0, 0, $newHomebarWidth, $newHomebarHeight, $homebarWidth, $homebarHeight);
        imagefilter($resizedHomebar, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($resizedHomebar, IMG_FILTER_COLORIZE, 0, 0, 0, 78);
        $xOffset = 430;
        $xTop = intval(($imageWidth - $newHomebarWidth) / 2 + $xOffset);
        $yTop = 90;
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagecopy($image, $resizedHomebar, $xTop, $yTop, 0, 0, $newHomebarWidth, $newHomebarHeight);
        imagedestroy($homebar2);
        imagedestroy($resizedHomebar);
    }
}

function LockScreenIconsTpbank($image) {
    $scale = 1.92;
    $flashlight = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/addon/flashlight-ios.png');
    if ($flashlight) {
        $flashlightWidth = imagesx($flashlight);
        $flashlightHeight = imagesy($flashlight);
        $newFlashlightWidth = intval($flashlightWidth * $scale);  
        $newFlashlightHeight = intval($flashlightHeight * $scale);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $resizedFlashlight = imagecreatetruecolor($newFlashlightWidth, $newFlashlightHeight);
        imagealphablending($resizedFlashlight, false);
        imagesavealpha($resizedFlashlight, true);
        imagecopyresampled($resizedFlashlight, $flashlight, 0, 0, 0, 0, $newFlashlightWidth, $newFlashlightHeight, $flashlightWidth, $flashlightHeight);
        $flashlightX = 160;
        $flashlightY = intval($imageHeight - $newFlashlightHeight - 167);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagecopy($image, $resizedFlashlight, $flashlightX, $flashlightY, 0, 0, $newFlashlightWidth, $newFlashlightHeight);
        imagedestroy($flashlight);
        imagedestroy($resizedFlashlight);
    }
    $camera = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/addon/camera-ios.png');
    if ($camera) {
        $cameraWidth = imagesx($camera);
        $cameraHeight = imagesy($camera);
        $newCameraWidth = intval($cameraWidth * $scale);
        $newCameraHeight = intval($cameraHeight * $scale);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $resizedCamera = imagecreatetruecolor($newCameraWidth, $newCameraHeight);
        imagealphablending($resizedCamera, false);
        imagesavealpha($resizedCamera, true);
        imagecopyresampled($resizedCamera, $camera, 0, 0, 0, 0, $newCameraWidth, $newCameraHeight, $cameraWidth, $cameraHeight);
        $cameraX = intval($imageWidth - $newCameraWidth - 160); 
        $cameraY = intval($imageHeight - $newCameraHeight - 167);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagecopy($image, $resizedCamera, $cameraX, $cameraY, 0, 0, $newCameraWidth, $newCameraHeight);
        imagedestroy($camera);
        imagedestroy($resizedCamera);
    }
}

function NotificationContentTpbank($image, $notificationX, $notificationY, $notificationHeight, $fontPath, $soduchinh, $stk, $sotien, $noidung, $thoigianchuyen, $logoPath, $thoigianthongbao, $cachthuc, $thoigiantrendt, $thoigiantrenmanhinh, $nhamang) {
    $logo = imagecreatefrompng($logoPath);
    if ($logo) {
        $origLogoWidth = imagesx($logo);
        $origLogoHeight = imagesy($logo);
        $targetWidth = 105; 
        $ratio = $origLogoWidth / $origLogoHeight;
        $targetHeight = intval($targetWidth / $ratio);
        $resizedLogo = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($resizedLogo, false);
        imagesavealpha($resizedLogo, true);
        imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $targetWidth, $targetHeight, $origLogoWidth, $origLogoHeight);
        $logoX = $notificationX + 45; 
        $logoY = $notificationY + 130;
        imagecopy($image, $resizedLogo, $logoX, $logoY, 0, 0, $targetWidth, $targetHeight);
        imagedestroy($logo);
        imagedestroy($resizedLogo);
    }
    $fontFile = realpath($fontPath . 'Inter-Regular.ttf') ?: ($fontPath . 'Inter-Regular.ttf');
    $bdsdRender = canchinhbdsdTpbank(
        $image, 30, $notificationY + 130,
        imagecolorallocate($image, 255, 255, 255), 
        $fontFile,
        $thoigianchuyen,
        $stk,
        $cachthuc,
        $sotien,
        $soduchinh,
        $noidung
    );
    canletraiTpbank($image,34,$notificationY + 72,imagecolorallocate($image, 255, 255, 255),$fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'TPBank Mobile',213);
    canchinhgiuaTpbank($image, 235, 600, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt);
    canchinhgiuaTpbank($image, 47, 334, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrenmanhinh);
    canchinhphaiTpbank($image, 27, $notificationY + 70, imagecolorallocate($image, 228, 220, 204), $fontPath . 'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigianthongbao);
    canletraiTpbank($image, 30, $notificationY - 1730, imagecolorallocate($image, 255, 255, 255), $fontPath.'common/San Francisco/SanFranciscoDisplay-Semibold.otf', $nhamang, 113);

    return $bdsdRender['lineCount']; 
}

if (isset($_POST['action']) && $_POST['action'] === 'tpbank-man-hinh-khoa') {
    $stk = $_POST["stk"];
    $noidung = !empty($_POST["noidung"]) ? $_POST["noidung"] : 'fake bill tại '.$domain;
    $sotien = FormatNumber::PREG($_POST["sotien"]);
    $soduchinh = FormatNumber::PREG($_POST["soduchinh"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $thoigiantrenmanhinh = $_POST["thoigiantrenmanhinh"];
    $nhamang = $_POST["nhamang"];
    $thoigianthongbao = $_POST["thoigianthongbao"];
    $cachthuc = $_POST['cachthuc'] ?? '+';
    if ($cachthuc !== '+' && $cachthuc !== '-') {
        $cachthuc = '+';
    }
    $logoTpbank = 'tpbank.png';
    $iconBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/bank/2/'.$logoTpbank;
    $anhnen = $_POST['avatar'] ?? '';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';
    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';
    $themeDisplay = 'light';
    //====== SETTING PHỤ TRỢ ======//
    $marginRightOption = 64; // Trái Phải
    $marginTopOption = 45; // Lên Xuống
    $sizeSignal = [55, 35]; // Vạch sóng
    $sizeWifi = [50, 35];   // Wi-Fi
    $sizePin = [75, 35];    // Pin
    $fontSizeTinHieu = 31;  // Tín hiệu
    $displayTinHieu = 'dark';  // Light - Dark Tín Hiệu
    $sizeDynamics = [505, 170]; // Dynamics
    //=============================//
    // Điều chỉnh lên/xuống riêng (0 là mặc định)
    $yOffsetSignal = 0; // Lên Xuống
    $yOffsetWifi = 0; // Lên Xuống
    $yOffsetMangText = 22; // Lên Xuống
    $yOffsetMang = 17; // Lên Xuống
    $yOffsetPin = 0; // Lên Xuống
    //============KHOẢNG CÁCH=======//
    $spacingCombo = 14;
    //=============================//
    $avatarData = validateAvatar($anhnen); 
    if ($avatarData) {
        $anhnen = cropImageToIPhoneSize($avatarData['data'], $avatarData['type']);
    } else {
        $DFImage = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/lock-screen-ip.jpg');
        if ($DFImage !== false) {
            $anhnen = cropImageToIPhoneSize($DFImage, 'jpg');
        } else {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Lỗi khi sử dụng nền mặc định.",
            ]));
        }
    }
    $image = loadBackgroundImageTpbank($anhnen);
    $white = imagecolorallocate($image, 150, 150, 150);
    $gray = imagecolorallocate($image, 80, 80, 80);
    $notificationX = 26;
    $notificationWidth = imagesx($image) - 58;
    $baseHeight = 186;
    $lineSpacing = 57;
    $notificationY = imagesy($image) - $baseHeight - 360;
    $tempImage = imagecreatetruecolor(imagesx($image), imagesy($image));
    $lineCount = NotificationContentTpbank($tempImage, $notificationX, $notificationY, $baseHeight, $fontPath, $soduchinh, $stk, $sotien, $noidung, $thoigianchuyen, $iconBank, $thoigianthongbao, $cachthuc, $thoigiantrendt, $thoigiantrenmanhinh, $nhamang);
    imagedestroy($tempImage);
    $notificationHeight = $baseHeight + ($lineCount - 1) * $lineSpacing;
    $notificationY = imagesy($image) - $notificationHeight - 360;
    $radius = 60;
    $notificationBg = createBlurredNotificationBackgroundTpbank($image, $notificationX, $notificationY, $notificationWidth, $notificationHeight);
    $roundedNotification = createRoundedNotificationTpbank($notificationBg, $notificationWidth, $notificationHeight, $radius);
    imagecopy($image, $roundedNotification, $notificationX, $notificationY, 0, 0, $notificationWidth, $notificationHeight);
    imagedestroy($notificationBg);
    imagedestroy($roundedNotification);
    NotificationContentTpbank($image, $notificationX, $notificationY, $notificationHeight, $fontPath, $soduchinh, $stk, $sotien, $noidung, $thoigianchuyen, $iconBank, $thoigianthongbao, $cachthuc, $thoigiantrendt, $thoigiantrenmanhinh, $nhamang);
    HomeBarsTpbank($image);
    LockScreenIconsTpbank($image);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);
    $image = applyWatermarkTpbank($image);
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    $namebill = ['TPBank', 'Màn Hình Khoá'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}