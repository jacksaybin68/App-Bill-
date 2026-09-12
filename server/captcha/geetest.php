<?php
namespace CaptchaValidator;
class Geetest 
{
    private $captcha_id;
    private $captcha_key;
    private $api_captcha;

    public function __construct($captcha_id, $captcha_key, $api_captcha) 
    {
        $this->captcha_id = $captcha_id;
        $this->captcha_key = $captcha_key;
        $this->api_captcha = $api_captcha;
    }
    public function verify($lot_number, $captcha_output, $pass_token, $gen_time) 
    {
        if (empty($lot_number) || empty($captcha_output) || empty($pass_token) || empty($gen_time)) 
        {
            return json_encode(['status' => 'fail', 'reason' => 'Thiếu thông tin xác thực captcha.']);
        }        
        // 3.generate signature
        // use standard hmac algorithms to generate signatures, and take the user's current verification serial number lot_number as the original message, and the client's verification private key as the key
        // use sha256 hash algorithm to hash message and key in one direction to generate the final signature
        $sign_token = hash_hmac('sha256', $lot_number, $this->captcha_key);
        // 4.upload verification parameters to the secondary verification interface of GeeTest to validate the user verification status
        // geetest recommends to put captcha_id parameter after url, so that when a request exception occurs, it can be quickly located in the log according to the id
        $query = [
            "lot_number" => $lot_number,
            "captcha_output" => $captcha_output,
            "pass_token" => $pass_token,
            "gen_time" => $gen_time,
            "captcha_id" => $this->captcha_id, 
            "sign_token" => $sign_token
        ];
        $url = $this->api_captcha."/validate?captcha_id=".$this->captcha_id;
        $res = $this->post($url, $query);
        $obj = json_decode($res, true);
        if (!isset($obj['result'])) {
            return json_encode(['status' => 'fail', 'reason' => 'Captcha not active.']);
        }
        // 5. taking the user authentication status returned from geetest into consideration, the website owner follows his own business logic
        return json_encode(['status' => $obj['result'], 'reason' => $obj['reason']]);
        }
        public static function Error($reason) 
        {
            $errors = 
            [
                'lot_number error' => 'Lỗi thiếu tham số lot_number',
                'captcha_output error' => 'Lỗi thiếu tham số captcha_output',
                'pass_token error' => 'Lỗi thiếu tham số pass_token',
                'gen_time error' => 'Lỗi thiếu tham số gen_time',
                'captcha_id error' => 'Lỗi thiếu tham số captcha_id',
                'sign_token error' => 'Lỗi thiếu tham số sign_token',
            ];
            return isset($errors[$reason]) ? $errors[$reason] : null;
        }
        // pay attention to interface exceptions, and make corresponding exception handling when requesting GeeTest secondary verification interface exceptions or response status is not 200
        // website's business will not be interrupted due to interface request timeout or server not-responding
        private function post($url, $postdata) 
        {
            $data = http_build_query($postdata);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/x-www-form-urlencoded"
            ]);
            $res = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($http_code != 200) 
            {
                return json_encode([
                    "status" => "fail",
                    "reason" => "Yêu cầu captcha không thành công."
                ]);
            } else {
                return $res;
            }
        }
}
// 1.initialize geetest parameter
// $initCaptcha = new Geetest($TD->Setting('id-geetest'), $TD->Setting('key-geetest'),'http://gcaptcha4.geetest.com'); // id - key - api
// 2.get the verification parameters passed from the front end after verification
// $postCaptcha = json_decode($initCaptcha->verify($_POST['lot_number'], $_POST['captcha_output'], $_POST['pass_token'], $_POST['gen_time']), true);
