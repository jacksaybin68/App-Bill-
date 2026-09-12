<?php
use LavenderFakebill\Models\Object\Render\Watermark;

if (isset($_POST['action']) && $_POST['action'] === 'sodu-cake') {
    $tendem = $_POST["tendem"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $gd = FormatNumber::PREG($_POST["gd"]);
    $convertGD = [
        1 => ['themeName' => 'cake-light', 'themeDisplay' => 'dark', 'colorMoney' => '12,28,46', 'colorContent' => '12,28,46'],
        2 => ['themeName' => 'cake-dark', 'themeDisplay' => 'dark', 'colorMoney' => '255,255,255', 'colorContent' => '255,255,255'],
    ];
    $gdData = $convertGD[$gd] ?? [
        'themeName' => 'cake-light',
        'themeDisplay' => 'dark',
        'colorMoney' => '37,231,255',
        'colorContent' => '255,255,255'
    ];

    $themeName = $gdData['themeName'];
    $themeDisplay = $gdData['themeDisplay'];
    list($rMoney, $gMoney, $bMoney) = explode(',', $gdData['colorMoney']);
   
    // Đường dẫn tới hình nền
    $phoiBank = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/bill/so-du/'.$themeName.'.jpeg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__ . '/';
    
    // Kiểm tra xem tệp hình ảnh có tồn tại không
    if (!file_exists($phoiBank)) {
        die("Tệp hình ảnh không tồn tại: " . $phoiBank);
    }
    
    // Tạo hình ảnh từ tệp JPEG
    $image = imagecreatefromjpeg($phoiBank);
    if (!$image) {
        die("Không thể tạo hình ảnh từ tệp: " . $phoiBank);
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/bill-settings/dark.php';

    // Áp dụng watermark nếu yêu cầu
    if (isset($_POST["xem-truoc"]) && $_POST["xem-truoc"] === 'yes') {
        $image = Watermark::Render($image);
    }

    // Gọi hàm để vẽ các icon, nếu có
    CaiDatPhuTro($image, $vachsong, $iconTinHieu, $iconPins, $_POST["tin-hieu"], $iconDynamicsIsland);
    
    // Khởi tạo hình ảnh đích
    $dest_img = imagecreatetruecolor(imagesx($image), imagesy($image));
    imagecopy($dest_img, $image, 0, 0, 0, 0, imagesx($image), imagesy($image)); // Sao chép nội dung vào hình ảnh đích

    // Định dạng văn bản
    $textBox = imagettfbbox(32, 0, $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', $tendem);
    $textWidth = $textBox[2] - $textBox[0];
    $textHeight = $textBox[7] - $textBox[1];
    
    // Vị trí của văn bản
    $circle_x = 80;
    $circle_y = 142;
    $textX = (int) ($circle_x - ($textWidth / 2));
    $textY = (int) ($circle_y + 14);
    
    // Vẽ tên ở vị trí xác định
    imagettftext($dest_img, 25, 0, $textX, $textY, imagecolorallocate($dest_img, 56, 71, 96), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', $tendem);

    // Vẽ số dư
    CanSoDu($dest_img, FormatNumber::TD($sodu), $fontPath . 'common/Roboto/Roboto-Regular.ttf', 28, imagecolorallocate($dest_img, $rMoney, $gMoney, $bMoney), $fontPath . 'common/Noto Sans/NotoSans-Regular.ttf', 27, imagecolorallocate($dest_img, 6, 25, 56), 1065, 60, ' đ');

    // Vẽ thời gian
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath . 'common/San Francisco/SanFranciscoText-Semibold.otf', 26, imagecolorallocate($dest_img, 0, 1, 2), 60);

    // Lưu hình ảnh vào bộ đệm và chuyển sang base64
    ob_start();
    imagepng($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    
    // Giải phóng bộ nhớ
    imagedestroy($dest_img);

    $namebill = ['Cake', 'Số Dư'];
    require $_SERVER['DOCUMENT_ROOT'] . '/server/models/object/global/checkRenderModel.php';
}

// Các hàm hỗ trợ vẽ văn bản
function CanLeTrai($image, $text, $font, $size, $color, $y)
{
    $fixed_left_position = 230;
    $image_width = imagesx($image);
    $text_bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $text_bbox[2] - $text_bbox[0];
    $text_left_margin = $fixed_left_position;

    if ($text_width + $fixed_left_position > $image_width) {
        $text_left_margin = $image_width - $text_width;
    }
    imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
}

function CanSoDu($image, $text, $font, $size, $color, $vnd_font, $vnd_size, $vnd_color, $y, $x, $name)
{
    $fixed_left_position = $x;
    $right_padding = 10;
    $image_width = imagesx($image);
    $formatted_text = $text;
    $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
    $text_width = $text_bbox[2] - $text_bbox[0];
    $text_left_margin = $fixed_left_position;
    if ($text_width + $fixed_left_position + $right_padding > $image_width) {
        $text_left_margin = $image_width - $text_width - $right_padding;
    }
    imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
    $text_width_vnd = $text_width + 5; 
    $vnd_left_margin = $text_left_margin + $text_width_vnd;
    imagettftext($image, $vnd_size, 0, $vnd_left_margin, $y, $vnd_color, $vnd_font, $name);
}

function CanThoiGian($image, $text, $font, $size, $color, $y)
{
    $fixed_left_position = 60;
    $image_width = imagesx($image);
    $text_bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $text_bbox[2] - $text_bbox[0];
    $text_left_margin = $fixed_left_position;

    if ($text_width + $fixed_left_position > $image_width) {
        $text_left_margin = $image_width - $text_width;
    }
    imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
}
?>
