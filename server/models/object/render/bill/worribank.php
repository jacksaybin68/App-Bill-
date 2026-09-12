<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && $_POST['action'] === 'worri') {

    // Kiểm tra sự tồn tại và tính hợp lệ của các giá trị trong POST
    if (!isset($_POST["name_nhan"], $_POST["stknhan"], $_POST["stkgui"], $_POST["nganhangnhan"], $_POST["sotienchuyen"], $_POST["time_bill"], $_POST["thoigiantrendt"], $_POST["noidung"])) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Thiếu tham số yêu cầu."]));
    }

    // Lấy dữ liệu từ POST
    $name_nhan = $_POST["name_nhan"];
    $stknhan = $_POST["stknhan"];
    $stkgui = $_POST["stkgui"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $time_bill = $_POST["time_bill"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidung = $_POST["noidung"];

    // Kiểm tra giá trị của 'nganhangnhan'
    if ($nganhangnhan === 'vtd') {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Vui lòng chọn một ngân hàng nhận."]));
    }

    // Kiểm tra số tiền chuyển
    if (!is_numeric($sotienchuyen)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Số tiền chuyển phải là một con số."]));
    }

    // Tải ảnh mẫu và font
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/worri.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/'.__FONTS__.'/' ;

    if (!file_exists($phoiBank)) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Không tìm thấy tệp ảnh mẫu."]));
    }

    // Load ảnh từ tệp PNG
    $image = imagecreatefrompng($phoiBank);
    $themeDisplay ='light';
    if (!$image) {
        exit(JSON_FORMATTER(["status" => -1, "msg" => "Không thể tải ảnh."]));
    }

    require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/light.php';

    // Xử lý Watermark nếu cần
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }

    // Các hàm xử lý văn bản trên ảnh
    function canchinhphai2($image, $fontsize, $y, $textColor, $font, $text, $customX = 98) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - $customX;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontSize, $y, $color, $font, $text, $x = 105) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = (int) $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = (int) (($imageWidth - $textWidth) / 2);
        $y = (int) $y;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2, $defaultMaxCharsPerLine = 15) {
        $imageWidth = imagesx($image);
        $textLength = strlen($text);
        $maxCharsPerLine = ($textLength > 20) ? 25 : $defaultMaxCharsPerLine;
        $lines = explode("\n", wordwrap($text, $maxCharsPerLine, "\n"));
        for ($index = 0; $index < min(2, count($lines)); $index++) {
            $line = $lines[$index];
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = $imageWidth - $textWidth - 110;
            imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
        }
    }

    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        // Tính toán kích thước hộp bao quanh văn bản để căn chỉnh chính xác
        $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];  // Tính chiều rộng của văn bản
        $textHeight = $textBoundingBox[7] - $textBoundingBox[1]; // Tính chiều cao của văn bản

        // Điều chỉnh vị trí x để căn giữa văn bản
        $imageWidth = imagesx($image);  // Lấy chiều rộng của ảnh
        $x = intval($x - ($textWidth / 2));  // Chuyển đổi thẳng sang int

        // Điều chỉnh y để căn lên chính xác
        $y = intval($y + ($textHeight / 2)); // Chuyển đổi thẳng sang int

        // Vẽ văn bản lên ảnh
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }

    // Căn giữa "VND" và số tiền trong một dòng duy nhất, với hai cỡ chữ khác nhau
    function canchinhgiua_nhungnoi($image, $y, $font1, $fontSize1, $text1, $font2, $fontSize2, $text2) {
    // Tính toán vị trí x cho "VND"
    $textBoundingBox1 = imagettfbbox($fontSize1, 0, $font1, $text1);
    $textWidth1 = $textBoundingBox1[2] - $textBoundingBox1[0];

    // Tính toán vị trí x cho số tiền
    $textBoundingBox2 = imagettfbbox($fontSize2, 0, $font2, $text2);
    $textWidth2 = $textBoundingBox2[2] - $textBoundingBox2[0];

    // Tính tổng chiều rộng của cả hai phần văn bản
    $totalWidth = $textWidth1 + $textWidth2;

    // Vị trí x để căn giữa
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $totalWidth) / 2;

    // Vẽ "VND"
    // Cần phải chắc chắn rằng $textWidth1 đã được tính toán
    imagettftext($image, $fontSize1, 0, round($x), round($y), imagecolorallocate($image, 255, 255, 255), $font1, $text1);

    // Vẽ số tiền
    // Cần phải chắc chắn rằng $textWidth2 đã được tính toán
    imagettftext($image, $fontSize2, 0, round($x + $textWidth1), round($y), imagecolorallocate($image, 255, 255, 255), $font2, $text2);
}


    // Sử dụng các hàm để chèn văn bản vào ảnh
    canletrai($image, 25, 983, imagecolorallocate($image, 0, 122, 255), $fontPath.'Inter/Inter-Bold.ttf', $name_nhan, 100);
    canletrai($image, 23, 1040, imagecolorallocate($image, 136, 136, 136), $fontPath.'Inter/Inter-Bold.ttf', $nganhangnhan, 100);
    // Căn chỉnh số tiền và VND
    canchinhgiua_nhungnoi($image, 
        686, // Vị trí y
        $fontPath.'Inter/Inter-SemiBold.ttf', 26, 'VND ', // "VND" với font và cỡ chữ
        $fontPath.'common/San Francisco/SFCompactDisplay-Bold.ttf', 40, FormatNumber::TD($sotienchuyen, 2) // Số tiền với font và cỡ chữ
    );

    canchinhgiua($image, 21, 800, imagecolorallocate($image, 136, 136, 136), $fontPath.'Inter/Inter-Medium.ttf', $time_bill, 111);
    canchinhphai2($image, 23, 1384, imagecolorallocate($image, 130, 130, 130), $fontPath.'Inter/Inter-Medium.ttf', $stkgui, 210);
    canchinhphai2($image, 23, 1040, imagecolorallocate($image, 136, 136, 136), $fontPath.'Inter/Inter-Medium.ttf', $stknhan, 111);
    canchinhphai_noidung($image, 22, 1166, imagecolorallocate($image, 69, 72, 79), $fontPath.'Inter/Inter-Medium.ttf', $noidung, 111);
    // canbentren($image, 21, 740, imagecolorallocate($image, 255, 255, 255), $fontPath.'common/San Francisco/SanFranciscoText-Semibold_Fix.otf', $thoigiantrendt, 58);
    imagettftext($image, 25, 0, 75, 65, imagecolorallocate($image, 255, 255, 255), $fontPath . 'common/San Francisco/SanFranciscoText-Semibold_Fix.otf', $thoigiantrendt);
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"],$iconDynamicsIsland);

    // Chuyển ảnh thành base64 và gửi về kết quả
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);

    // Đảm bảo tệp hóa đơn đã được tạo
    $namebill = ['Worri', 'Chuyển Khoản'];
    require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/checkRenderModel.php');
}
?>
