<?php
header('Content-Type: application/json');
if (isset($_POST['action']) && $_POST['action'] === 'fake-cccd') {
    if ($SSC->check()) {
        exit(JSON_FORMATTER(["status" => -1, 'msg' => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    $loai = $_POST["loai"];
    if ($loai === 'cccd-mat-truoc') {
        $hovaten = strtoupper(strtolower($_POST["hovaten"]))?? null;
        $gioitinh = $_POST["gioitinh"]?? null;
        $ngaysinh = $_POST["ngaysinh"]?? null;
        $socccd = $_POST["socccd"]?? null;
        $quequan = $_POST["quequan"]?? null;
        $thuongtru = $_POST["thuongtru"]?? null;
        $ngayhethan = $_POST["ngayhethan"]?? null;
        $quoctich = $_POST["quoctich"]?? null;
        $anhthe = $_POST['anhthe'] ?? null;
        if (empty($hovaten)||empty($gioitinh)||empty($ngaysinh)||empty($socccd)||empty($quequan)||empty($thuongtru)||empty($ngayhethan)||empty($quoctich)) {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Không được bỏ trống mục nào!",
            ]));
        }
        if (!isDate($ngaysinh)) {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Ngày sinh không hợp lệ, định dạng phải là dd/mm/yyyy (ngày/tháng/năm)",
            ]));
        } elseif (!isDate($ngayhethan)) {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Ngày hết hạn không hợp lệ, định dạng phải là dd/mm/yyyy (ngày/tháng/năm).",
            ]));
        }
        if (isset($_POST['anhthe']) && !empty($_POST['anhthe'])) {
            $phoicccd = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/cccd/mat-truoc.jpg';
            if (preg_match('/^data:image\/(\w+);base64,/', $anhthe, $type)) {
                $data = substr($anhthe, strpos($anhthe, ',') + 1);
                $type = strtolower($type[1]);
                if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                    die(JSON_FORMATTER([
                        "status" => -1,
                        "msg" => "Ảnh thẻ chỉ hỗ trợ các định dạng JPG/PNG/JPEG.",
                    ]));
                }
                $data = base64_decode($data);
                $size = strlen($data);
                if (!WsCheckIMG::SizeLimit($size, 4)) { 
                    die(JSON_FORMATTER([
                        "status" => -1,
                        "msg" => "Kích thước của ảnh không được vượt quá giới hạn cho phép (4MB).",
                    ]));
                }
                if ($data === false) {
                    die(JSON_FORMATTER([
                        "status" => -1,
                        "msg" => "Lỗi giải mã dữ liệu ảnh thẻ.",
                    ]));
                }
                $phoicccd2 = imagecreatefromjpeg($phoicccd);
                $anhthe_img = imagecreatefromstring($data);
                //                                               Lên  Xuống       Rộng Dài
                imagecopyresampled($phoicccd2, $anhthe_img, 327, 1161, 0, 0, 376, 512, imagesx($anhthe_img), imagesy($anhthe_img));
                imagedestroy($anhthe_img);
                $image = $phoicccd2;

            } else {
                die(JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Vui lòng upload file ảnh thẻ.",
                ]));
            }
        } else {
            $phoicccd = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/cccd/mat-truoc-'.strtolower(VnTones($gioitinh)).'.jpg';
            $image = imagecreatefromjpeg($phoicccd);
        }

    } else {
        $dacdiemnhandang = $_POST["dacdiem-nhandang"];
        $ngaylamcccd = $_POST["ngaylam-cccd"];
        $tencuctruong = $_POST["tencuctruong"];
        $mrz = $_POST["mrz"];
        $socccd = $_POST["socccd"]?? null;
        if (!isDate($ngaylamcccd)) {
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Ngày làm cccd không hợp lệ, định dạng phải là dd/mm/yyyy (ngày/tháng/năm)",
            ]));
        }
        $phoicccd = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/cccd/mat-sau.jpg';
    }

    if ($loai === 'cccd-mat-truoc') {
        $qrcode = sprintf(
            'https://quickchart.io/qr?text=%s&light=0000&ecLevel=H&format=png&size=700',
            urlencode(
                sprintf('%s|%s|%s|%s|%s|%s|%s',
                    $socccd,
                    WsRandomString::Number(9),
                    $hovaten,
                    str_replace('/', '', $ngaysinh),
                    $gioitinh,
                    $thuongtru,
                    str_replace('/', '', $ngayhethan)
                )
            )
        );
        $qr_img = imagecreatefrompng($qrcode);
    } else {
        $phoicccd = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/giay-to/cccd/mat-sau.jpg';
    $image = imagecreatefromjpeg($phoicccd);
    }

    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/';

    function infocccd($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $customX !== null ? $customX : 753;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function noithuongchu($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $lineX = 753;
        $firstLineX = $customX !== null ? $customX : 753;
        $maxWidth = 8;
        $words = explode(' ', $text);
        $firstLine = '';
        $D2 = '';
        foreach ($words as $word) {
            $testLine = trim($firstLine.' '.$word);
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $testLine);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            if (mb_strlen($firstLine) < $maxWidth && $textWidth <= imagesx($image) - $firstLineX) {
                $firstLine = $testLine;
            } else {
                $D2 .= ($D2 ? ' ' : '').$word;
            }
        }
        $firstLineWithoutComma = str_replace(',', '', $firstLine);
        if (!empty($firstLineWithoutComma)) {
            imagettftext($image, $fontSize, 0, $firstLineX, $y, $textColor, $font, trim($firstLineWithoutComma));
        }

        if (!empty($D2)) {
            imagettftext($image, $fontSize, 0, $lineX, $y + ($fontSize + 12), $textColor, $font, trim($D2));
        }
    }
    function canlematsau($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $x = $customX !== null ? $customX : 753;
        $shadow = imagecolorallocate($image, 0, 0, 0);
        $maxChars = 28;
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';
        foreach ($words as $word) {
            if (mb_strlen($currentLine.' '.$word, 'UTF-8') <= $maxChars) {
                $currentLine .= ($currentLine === '' ? '' : ' ').$word;
            } else {
                $lines[] = $currentLine;
                $currentLine = $word;
            }
        }
        if (!empty($currentLine)) {
            $lines[] = $currentLine;
        }
        foreach ($lines as $line) {
            imagettftext($image, $fontSize, 0, $x, $y, $shadow, $font, $line);
            imagettftext($image, $fontSize, 0, round($x + 0.1), round($y + 0), $textColor, $font, $line);
            $y += $fontSize + 5;
        }
    }
    function canlecuctruong($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $customX !== null ? $customX : 723;
        if (mb_strlen($text) > 15) {
            $x -= 75;
        }
        imagettftext($image, $fontSize, 0, round($x), $y, $textColor, $font, $text);
    }
    function Rn($length)
    {
        return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
    }

    function MRZ()
    {
        global $socccd;
        $id = 'IDVNM'.Rn(10).$socccd.'<<'.Rn(1);
        $line2 = Rn(8).'M'.Rn(8).'VNM';
        $randomNumber = Rn(1);
        $line2 .= str_repeat('<', 30 - strlen($line2) - 1);
        $line2 .= $randomNumber;
        return [$id, $line2];
    }

    function canlemrz($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
    {
        $fontSize = $fontsize;
        $x = $customX !== null ? $customX : 370;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    if ($loai === 'cccd-mat-truoc') {
        imagecopyresampled($image, $qr_img, 1540, 890, 0, 0, 222, 222, imagesx($qr_img), imagesy($qr_img));
        infocccd($image, 50, 1290, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Bold.ttf', $socccd, 906);
        infocccd($image, 42, 1415, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $hovaten, 753);
        infocccd($image, 35, 1475, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $ngaysinh, 1187);
        infocccd($image, 37, 1527, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $gioitinh, 1027);
        infocccd($image, 37, 1522, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $quoctich, 1560);
        infocccd($image, 37, 1650, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $quequan, 753);
        infocccd($image, 31, 1737, imagecolorallocate($image, 32, 46, 39), $fontPath.'common/Arial/Arial Regular.ttf', $ngayhethan, 523);
        noithuongchu($image, 37, 1715, imagecolorallocate($image, 39, 39, 39), $fontPath.'common/Arial/Arial Regular.ttf', $thuongtru, 1335);
    } else {
        [$D1, $D2] = MRZ();
        $D3 = $mrz.str_repeat('<', 30 - strlen($mrz));
        canlematsau($image, 26, 950, imagecolorallocate($image, 40, 40, 28), $fontPath.'common/Arial/Arial Regular.ttf', $dacdiemnhandang, 356);
        canlecuctruong($image, 32, 1417, imagecolorallocate($image, 28, 32, 31), $fontPath.'common/Arial/Arial Regular.ttf', $tencuctruong, 723);
        canlematsau($image, 27, 1017, imagecolorallocate($image, 50, 43, 37), $fontPath.'common/Arial/Arial Regular.ttf', $ngaylamcccd, 886);
        canlemrz($image, 53, 1524, imagecolorallocate($image, 28, 32, 31), $fontPath.'common/Arial/OCR-B 10 BT.ttf', $D1, 370);
        canlemrz($image, 53, 1594, imagecolorallocate($image, 28, 32, 31), $fontPath.'common/Arial/OCR-B 10 BT.ttf', $D2, 370);
        canlemrz($image, 53, 1660, imagecolorallocate($image, 28, 32, 31), $fontPath.'common/Arial/OCR-B 10 BT.ttf', $D3, 370);
    }
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
   if (!isset($user['rank']) || !in_array($user['rank'], ['admin', 'leader'])) {
    $requiredVIP = intval(preg_replace('/\D/', '', $TD->Setting('giataogiayto') ?? ''));
    $currentVIP = intval(preg_replace('/\D/', '', $plans->TD('tengoi', $taikhoan) ?? ''));
        if ($requiredVIP > 0 && $currentVIP < $requiredVIP) {
            $action = ($currentVIP === 0) ? "mua" : "tối thiểu";
            die(JSON_FORMATTER([
                "status" => -1,
                "msg" => "Vui lòng $action gói " . strtoupper($TD->Setting('giataogiayto')) . " để sử dụng tính năng fake cccd!",
            ]));
        }
    }
    
    die(JSON_FORMATTER([
        "status" => 200,
        "msg" => "Tạo cccd thành công!",
        "img" => $base64,
        "info" => ['type' => [$loai], 'sex' => [$gioitinh ?? 'N/A']],
    ]));
}
