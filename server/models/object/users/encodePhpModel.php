<?php
if (!class_exists('DatabaseConnection')) 
{
    header('Location: /');
    exit;
}
header('Content-Type: text/plain');
if (isset($_POST['action']) && $_POST['action'] === 'thanhdieu-obfuscate-php') 
{
    $code = $_POST['code'];
    $type = $_POST['type'];
    $display = $_POST['display'] ?? 'raw';
    $halt_mode = isset($_POST['halt_mode']) ? true : false;
    $hide_errors = isset($_POST['hide_errors']) ? true : false;
    $global_cache = isset($_POST['global_cache']) ? true : false;
    $hide_eval = isset($_POST['hide_eval']) ? true : false;
    $antihooking = isset($_POST['antihooking']) ? true : false;
    $antidebugger = isset($_POST['antidebugger']) ? true : false;
    if (!preg_match('/<\?php/', $code)) {
        exit('ERROR: Code phải chứa thẻ <?php ?>!');
    }
    if ($type === 'str') 
    {
        if (strlen($code) > 20000) 
        {
            exit('ERROR: String Encode không hỗ trợ dữ liệu code quá lớn!');
        }
        include($_SERVER['DOCUMENT_ROOT'].'/function/obf-php/str/enc.php');
        exit(encode_str($code));
    } elseif ($type === 'alom') 
    {
        include($_SERVER['DOCUMENT_ROOT'].'/function/obf-php/alom/alomtools.php');
        $settings = 
        [
            'rounds' => 
            [
                'main' => 
                [
                    'depth' => 1.5,
                    'depth_type' => 'constant',
                    'base64rand_round' => false,
                    'deflate_round' => true,
                    'iterate_base64' => 0,
                ],
                'antidebugger' => 
                [
                    'enable' => $antidebugger,
                ],
                'antihooking' => 
                [
                    'enable' => $antihooking,
                    'deep' => false,
                ],
            ],
            'style' => 
            [
                'display' => $display,
                'halt_mode' => $halt_mode,
                'hide_errors' => $hide_errors,
                'global_cache' => $global_cache,
                'hide_eval' => $hide_eval
            ],
            'license' => 
            [
                'type' => 'remove',
            ],
        ];

        function generate_file($dir = '/function/obf-php/alom/download/') 
        {
            return $_SERVER['DOCUMENT_ROOT'].$dir.uniqid('obfuscated-', true).'-'.time().'.php';
        }
        function create_zip($file, $dir = '/function/obf-php/alom/download/') 
        {
            $zip = new ZipArchive();
            $zip_file = $_SERVER['DOCUMENT_ROOT'].$dir.uniqid('obfuscated-', true).'.zip';
            if ($zip->open($zip_file, ZipArchive::CREATE) === TRUE) 
            {
                $zip->addFile($file, 'obfuscated.php');
                $zip->close();
                if (is_file($file)) 
                {
                    unlink($file);
                }
                return $zip_file;
            } else {
                return false;
            }
        }
        function handle_alom_obfuscate($code, $settings = [], $display = 'raw') 
        {
            global $domain;
            $temp = generate_file(); 
            if (alom_obfuscate_into($code, $temp, $settings)) 
            {
                if ($display === 'raw') {
                    $zip_file = create_zip($temp);
                    if ($zip_file) {                        
                        $download_url = 'https://'.$domain.'/obf-alom/download/'.str_replace($_SERVER['DOCUMENT_ROOT'].'/function/obf-php/alom/download/', '', $zip_file);
                        return "Tải xuống: $download_url";
                    } else {
                        return 'ERROR: Xảy ra lỗi khi tạo tệp ZIP.';
                    }
                } else {
                    $obfuscated = file_get_contents($temp); 
                    if (is_file($temp)) {
                        unlink($temp);
                    }
                    
                    return $obfuscated;
                }
            } else {
                return 'ERROR: Xảy ra lỗi khi mã hóa.';
            }
        }
        exit(handle_alom_obfuscate($code, $settings, $display));
    } else {
        exit('ERROR: Kiểu mã hoá không hợp lệ!');
    }
}
