<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"]."/vendor/library/HtmlSplit.php";
// require_once($_SERVER['DOCUMENT_ROOT'].'/function/call-back/controller/oauth.google.php');
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
//   Copyright (C) 2021  WusTeam Development Team                             //
//   http://www.thanhdieu.com                                                 //
//                                                                            //
//   This program is free software. You can redistribute it and/or modify     //
//   it under the terms of either the current WusTeam License (viewable at    //
//   WusTeam.Com) or the WusTeam License that was distributed with this file  //
//                                                                            //
//   This program is distributed in the hope that it will be useful,          //
//   but WITHOUT ANY WARRANTY, without even the implied warranty of           //
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.                     //
//                                                                            //
//   You should have received a copy of the WusTeam License                   //
//   along with this program.                                                 //
//                                                                            //
////////////////////////////////////////////////////////////////////////////////
class DatabaseConnection
{
    protected static $db;

    /**
     * Method SetDatabase
     *
     * @param $db
     *
     * @return mixed
     */
    public static function SetDatabase($db)
    {
        self::$db = $db;
        self::$db->query("SET NAMES 'utf8mb4'");
        mysqli_query($db, "SET time_zone = '+07:00'");
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    /**
     * Method ThanhDieuDB
     *
     * @return mixed
     */
    public static function ThanhDieuDB()
    {
        return self::$db;
    }

    /**
     * Method CurrentTime
     *
     * @return mixed
     */
    public static function CurrentTime()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * Method CurrentTimeLite
     *
     * @return mixed
     */
    public static function CurrentTimeLite()
    {
        return date("Y-m-d");
    }
}
class THANHDIEUSTART extends DatabaseConnection
{
    public function __construct()
    {
        $this->setTimeZone();
    }

    /**
     * Method setTimeZone
     *
     * @return mixed
     */
    public function setTimeZone()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    /**
     * Method setDatabaseCharset
     *
     * @return mixed
     */
    public function setDatabaseCharset()
    {
        self::ThanhDieuDB()->query("SET NAMES 'utf8mb4'");
    }

    /**
     * Method getUserAgent
     *
     * @return mixed
     */
    public function getUserAgent()
    {
        return $_SERVER["HTTP_USER_AGENT"] ?? '';
    }

    /**
     * Method setSessionRequestTime
     *
     * @return mixed
     */
    public function setSessionRequestTime()
    {
        $_SESSION["session_request"] = time();
    }

    /**
     * Method getIPClient
     *
     * @return mixed
     */
    public function getIPClient()
    {
        return $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
    }

    /**
     * Method getCurrentTime
     *
     * @return mixed
     */
    public function getCurrentTime()
    {
        return date("Y-m-d H:i:s");
    }

    /**
     * Method getFormatCurrentTime
     *
     * @return mixed
     */
    public function getFormatCurrentTime()
    {
        return date("H:i:s d-m-Y");
    }
    /**
     * Method getWebsiteDomain
     *
     * @return mixed
     */
    public function getWebsiteDomain()
    {
        return class_exists('DomainManager') ? DomainManager::getCurrentHost() : ($_SERVER["HTTP_HOST"] ?? 'localhost');
    }

    /**
     * Method getCurrentURL
     *
     * @return mixed
     */
    public function getCurrentURL()
    {
        return $_SERVER["REQUEST_URI"] ?? '/';
    }

    /**
     * Method getDomain
     *
     * @return mixed
     */
    public function getDomain()
    {
        return class_exists('DomainManager') ? DomainManager::getCurrentDomain() : ($_SERVER["HTTP_HOST"] ?? 'localhost');
    }

    /**
     * Method getBaseURL
     *
     * @return mixed
     */
    public function getBaseURL()
    {
        return class_exists('DomainManager') ? DomainManager::getBaseUrl() : ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" ? "https" : "http") . "://" . ($_SERVER["HTTP_HOST"] ?? 'localhost'));
    }

    /**
     * Method getFullURL
     *
     * @return mixed
     */
    public function getFullURL()
    {
        return class_exists('DomainManager') ? DomainManager::getFullUrl() : ($this->getBaseURL() . $this->getCurrentURL());
    }
    /**
     * Method getPHPVersion
     *
     * @return mixed
     */
    public function getPHPVersion()
    {
        return phpversion();
    }
    /**
     * Method getServerSoftware
     *
     * @return mixed
     */
    public function getServerSoftware()
    {
        return $_SERVER["SERVER_SOFTWARE"] ?? 'CLI/Unknown';
    }
    /**
     * Method getMysqliCheck
     *
     * @return mixed
     */
    public function getMysqliCheck()
    {
        return function_exists("mysqli_connect");
    }
}
DatabaseConnection::SetDatabase($thanhdieudb);
class Settings extends DatabaseConnection
{
    private $TD;

    public function __construct()
    {
        $this->TD = self::ThanhDieuDB()
            ->query("SELECT * FROM `ws_settings`")
            ->fetch_assoc();
    }

    /**
     * Method Setting
     *
     * @param $data $data
     *
     * @return mixed
     */
    public function Setting($data)
    {
        if ($data === "ads" || $data === "modal-content") 
        {
            return $this->TD[$data] ?? null;
        }
        return isset($this->TD[$data]) ? THANHDIEU($this->TD[$data]) : null;
    }
}
class SecurityLavender extends DatabaseConnection
{
    private string $method = "aes-256-cbc"; // @ method enc
    private string $key; // @ AES key
    public ?string $publicKey; // @ RSA public key
    private ?string $privateKey; // @ RSA private key

    /**
     * Initialize class with AES + RSA
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = substr(hash("sha256", $key, true), 0, 32); // @ hash key
        $this->loadKey(); // @ load keys from DB
    }

    /**
     * Load RSA keys from database
     *
     * @return void
     */
     public function loadKey(): void
     {
         $wt = self::ThanhDieuDB()->prepare(
             "SELECT public_key, private_key 
              FROM ws_rsakey 
              WHERE rsa_id = 1"
         );
     
         if ($wt) 
         {
             $wt->execute();
             $vtd = $wt->get_result();
     
             if ($row = $vtd->fetch_assoc()) 
             {
                 $this->publicKey = $row['public_key'] ?? null;
                 $this->privateKey = $row['private_key'] ?? null;
             } 
             else 
             {
                 $this->createKey();
             }
         }
     }
     
     public function createKey(): void
     {
       
        //  $wt = self::ThanhDieuDB()->prepare("INSERT INTO ws_rsakey (public_key, private_key) VALUES (?, ?)");
        //  if ($wt) {
        //      $wt->bind_param('ss', $publicKey, $privateKey);
        //      $wt->execute();
        //      $this->publicKey = $publicKey;
        //      $this->privateKey = $privateKey;
        //  }
     }
     
     
    /**
     * Enc data using AES
     *
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method)); // @ rand iv
        $encrypted = openssl_encrypt($data, $this->method, $this->key, 0, $iv);
        return bin2hex($iv . $encrypted); // @ hex enc
    }

    /**
     * Dec data using AES
     *
     * @param string $data
     * @return string|null
     */
    public function decrypt(string $data): ?string
    {
        if (strlen($data) % 2 !== 0) {
            $data = '0' . $data; // @ add hex
        }
        $data = hex2bin($data); // @ dec hex
        $iv_length = openssl_cipher_iv_length($this->method);

        $iv = substr($data, 0, $iv_length);
        $encrypted = substr($data, $iv_length);

        if (strlen($iv) < $iv_length) {
            $iv = str_pad($iv, $iv_length, "\0");
        }

        $decrypted = openssl_decrypt($encrypted, $this->method, $this->key, 0, $iv);
        return $decrypted === false ? null : $decrypted; // @ indecipherable
    }

    /**
     * Enc RSA public key
     *
     * @param string $data
     * @return string|null
     */
    public function encryptRSA(string $data): ?string
    {
        if (!$this->publicKey) {
            return null; // @ no public key
        }
    
        openssl_public_encrypt($data, $encrypted, $this->publicKey);
        return $encrypted ? base64_encode($encrypted) : null;
    }
    /**
     * Dec RSA private key
     *
     * @param string $data
     * @return string|null
     */
    public function decryptRSA(string $data): ?string
    {
        if (!$this->privateKey) {
            return null; 
        }
        $privateKeys = openssl_pkey_get_private($this->privateKey);
        if ($privateKeys === false) {
            return null;
        }
        $decrypted = null;
        $result = openssl_private_decrypt(base64_decode($data), $decrypted, $privateKeys);
        if (!$result) {
            return null;
        }
        return $decrypted ?: null;
    }
    
}

$TD = new Settings();
$wtSecurity = new SecurityLavender($TD->Setting("key-aes"));
$wtSecurity->loadKey();
class WebsResource extends DatabaseConnection
{
    /**
     * Method MainResources
     *
     * @return mixed
     */
    public function MainResources()
    {
        return "public/src/vtd";
    }
    /**
     * Method CSSResources
     *
     * @return mixed
     */
    public function CSSResources()
    {
        return "public/src/vtd/css";
    }

    /**
     * Method JSResources
     *
     * @return mixed
     */
    public function JSResources()
    {
        return "public/src/vtd/js";
    }

    /**
     * Method IMGResources
     *
     * @return mixed
     */
    public function IMGResources()
    {
        return "public/src/vtd/img";
    }

    /**
     * Method LibraryResources
     *
     * @return mixed
     */
    public function LibraryResources()
    {
        return "public/src/vtd/libs";
    }
    /**
     * Method PluginsResources
     *
     * @return mixed
     */
    public function PluginsResources()
    {
        return "public/src/vtd/plugins";
    }
    /**
     * Method VendorResources
     *
     * @return mixed
     */
    public function VendorResources()
    {
        return "public/src/vtd/vendor";
    }
    /**
     * Method FontsResources
     *
     * @return mixed
     */
    public function FontsResources()
    {
        return "public/src/vtd/fonts";
    }
    /**
     * Method UserInfo
     *
     * @return mixed
     */
    public function UserInfo()
    {
        global $wtSecurity, $x;
        if (isset($_COOKIE["ssk"])) {
            $username = $wtSecurity->decrypt($_COOKIE["ssk"]); // dec ssk to get username
            $OoO = self::ThanhDieuDB()->prepare(
                "SELECT * FROM `users` WHERE `username`=?"
            );
            $OoO->bind_param("s", $username);
            if (!$OoO->execute()) {
                $x_msg = $x[0x000002]; // get error
                require $_SERVER["DOCUMENT_ROOT"] .
                    "/function/insert/error/server.php"; // show error
                exit();
            }
            $wt = $OoO->get_result();
            return $wt->num_rows > 0 ? $wt->fetch_assoc() : []; // get full info
        }
        return [];
    }
}
$taikhoan
= 
isset($_COOKIE["ssk"])
? $wtSecurity->decrypt($_COOKIE["ssk"])
: null;
$webs = new WebsResource();
if ($taikhoan !== null
) {
    $user = $webs->UserInfo();
} else {
    $user = null;
}
class CheckSSK
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Method check
     *
     * @return void
     */
    public function check()
    {
        if (
            empty($this->user["username"]) ||
            empty($this->user["access_key"]) ||
            $this->user["banned"] == 1
        ) {
            $this->kill_session(); // kill of user=null
        }
    }

    /**
     * Method kill_session
     *
     * @return void
     */
    private function kill_session()
    {
        setcookie("ssk", "", time() - rand(1000, 9999), "/", "", true, true);
    }
}
// $prefix ??= "";
// $xd=isset($user['rank']) && $user['rank'] == 'ctv' ? 2 : (isset($user['rank']) && in_array($user['rank'], ['admin', 'partner']) ? 1 : 0);
define("__SRC__", $webs->MainResources());
define("__CSS__", $webs->CSSResources());
define("__JS__", $webs->JSResources());
define("__IMG__", $webs->IMGResources());
define("__LIBRARY__", $webs->LibraryResources());
define("__PLUGINS__", $webs->PluginsResources());
define("__VENDOR__", $webs->VendorResources());
define("__FONTS__", $webs->FontsResources());
/**
 * Method THANHDIEU
 *
 * @param $value
 *
 * @return
 */
function THANHDIEU($value)
{
    if (is_array($value)) {
        return array_map("THANHDIEU", $value);
    } else {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    }
}
class Redirect
{
    /**
     * Method getParameter
     *
     * @param $name $name
     *
     */
    public static function getParameter($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return null;
    }
    /**
     * Method Login
     */
    public static function Login()
    {
        $redirect = self::getParameter("redirect");
        $login = "/oauth/dang-nhap";
        if ($redirect !== null) {
            $login .= "?redirect=".urlencode($redirect);
        }
        return $login;
    }
    /**
     * Method Register
     */
    public static function Register()
    {
        $redirect = self::getParameter("redirect");
        $register = "/oauth/dang-ky";
        if ($redirect !== null) {
            $register .= "?redirect=".urlencode($redirect);
        }
        return $register;
    }
}
class UserSession
{
    /**
     * Method CheckAdmin
     *
     * @param $user $user
     *
     */
    public static function CheckAdmin($user)
    {
        global $TD;
        if (
            isset($user["rank"]) &&
            (strtolower($user["rank"]) === "admin" ||
                strtolower($user["rank"]) === "partner")
        ) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Method GetUsername
     *
     * @param $user $user
     *
     * @return void
     */
    public static function GetUsername($user)
    {
        return isset($user["username"]) ? $user["username"] : null;
    }
}
class CheckSessionLogin
{

    public function __construct()
    {
    }

    /**
     * Method TD
     *
     * @param $taikhoan $taikhoan
     * @param $user $user
     *
     */
    public function check($taikhoan = null, $user = null)
    {
        global $taikhoan, $user, $wtSecurity;
        if (
            isset($_COOKIE["ssk"]) &&
            !empty($taikhoan) &&
            isset($user) &&
            (!isset($user["banned"]) || $user["banned"] != 1)
        ) {
            return $wtSecurity->decrypt($_COOKIE["ssk"]) ===
                $taikhoan;
        } else {
            return false;
        }
    }
}
class SessionExpiredChecker
{
    private $encryption_key;

    public function __construct()
    {
        global $TD;
        $this->encryption_key = $TD->Setting("key-aes");
    }

    /**
     * Check status & info user
     */
    public function check($taikhoan = null, $user = null)
    {
        global $taikhoan, $user;
        if (
            $taikhoan === null ||
            empty($user) ||
            (isset($user["banned"]) && $user["banned"] == 1)
        ) {
            $this->logout();
            return true;
        }
        return false;
    }

    /**
     * Logout user
     */
    private function logout()
    {
        $taikhoan = null;
        setcookie("ssk", "", time() - 3600, "/");
    }

    /**
     * Check cookie 'ssk' (user none login)
     */
    public function checkssk()
    {
        global $user,$wtSecurity;
        if (!isset($_COOKIE['ssk']) || empty($_COOKIE['ssk'])) {
            return false;
        }
        if ($wtSecurity->decrypt($_COOKIE['ssk']) === false) {
            return true;
        }
        if (isset($user['banned']) && $user['banned'] == 1) {
            return true;
        }
        return false;
    }
}

class CheckRank
{
    public static function rank($user)
    {
        if (!isset($user["rank"]) || $user["rank"] !== "admin") {
            return true;
        }
        return false;
    }
}
class CheckRankAndSession extends SessionExpiredChecker
{
    /**
     * Method TD
     *
     * @param $user $user
     * @param $taikhoan $taikhoan
     *
     * @return void
     */
    public static function TD($user, $taikhoan)
    {
        if ((new SessionExpiredChecker())->check()) {
            exit(
                JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Phiên đã hết hạn vui lòng đăng nhập lại!",
                ])
            );
        }
        if (!self::check_admin($user)) {
            exit(
                JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Mày tuổi gì đồi bug admin vậy ku em!",
                ])
            );
        }
    }

    /**
     * Method check_admin
     *
     * @param $user $user
     *
     */
    private static function check_admin($user)
    {
        return isset($user["rank"]) && $user["rank"] === "admin";
    }
}
class TDSpamChecker
{
    /**
     * Method TD
     *
     * @param $identifier $identifier
     * @param $TD
     * @param $maxRequests $maxRequests
     *
     */
    public static function TD($identifier, $TD, $maxRequests = null)
    {
        $timeWindow = 5;
        $blockTime = 30;
        if ($maxRequests === null) {
            $maxRequests = self::MaxRequests($TD->Setting("anti-spam"));
        }
        $requestKey = "request_count_".$identifier;
        $expiryKey = "request_expiry_".$identifier;
        $blockUntilKey = "block_until_".$identifier;
        $currentTime = time();

        if (!isset($_SESSION[$requestKey])) {
            $_SESSION[$requestKey] = 0;
        }
        if (!isset($_SESSION[$expiryKey])) {
            $_SESSION[$expiryKey] = $currentTime + $timeWindow;
        }
        if (!isset($_SESSION[$blockUntilKey])) {
            $_SESSION[$blockUntilKey] = 0;
        }
        if ($currentTime < $_SESSION[$blockUntilKey]) {
            return false;
        }
        if ($currentTime > $_SESSION[$expiryKey]) {
            $_SESSION[$requestKey] = 0;
            $_SESSION[$expiryKey] = $currentTime + $timeWindow;
        }
        $_SESSION[$requestKey]++;
        if ($_SESSION[$requestKey] > $maxRequests) {
            $_SESSION[$blockUntilKey] = $currentTime + $blockTime;
            return false;
        }

        return true;
    }
    /**
     * Method MaxRequests
     *
     * @param $sensitivity $sensitivity
     *
     */
    private static function MaxRequests($sensitivity)
    {
        return $sensitivity == 0 ? random_int(3, 5) : random_int(2, 3);
    }
}
function valid_url($url)
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
function valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
    preg_match(
        '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        $email
    );
}

function BACKUP_DATABASE($thanhdieudb)
{
    $folder = realpath(__DIR__."/../public/cache/backup/");
    // $backup_file_name="backup-".substr(uniqid(), -16).".sql";
    $backup_file_name =
    "backup-".md5(WsRandomString::Number(10))."-".time().".sql";
    $backup_file_path = $folder."/".$backup_file_name;
    $return = "";
    $alltables = [];
    $result = mysqli_query($thanhdieudb, "SHOW TABLES");
    while ($row = mysqli_fetch_row($result)) {
        $alltables[] = $row[0];
    }
    foreach ($alltables as $table) {
        $result = mysqli_query($thanhdieudb, "SELECT * FROM ".$table);
        $num_fields = mysqli_num_fields($result);
        $return .= "DROP TABLE IF EXISTS ".$table.";\n";
        $row2 = mysqli_fetch_row(
            mysqli_query($thanhdieudb, "SHOW CREATE TABLE ".$table)
        );
        $return .= "\n".$row2[1].";\n\n";
        while ($row = mysqli_fetch_row($result)) {
            $return .= "INSERT INTO ".$table." VALUES(";
            for ($j = 0; $j < $num_fields; $j++) {
                $value = isset($row[$j]) ? $row[$j] : null;
                $return .=
                $value !== null ? '"'.addslashes($value).'"' : "NULL";
                if ($j < $num_fields - 1) {
                    $return .= ",";
                }
            }
            $return .= ");\n";
        }
        $return .= "\n\n";
    }
    $handle = fopen($backup_file_path, "w+");
    if ($handle) {
        fwrite($handle, $return);
        fclose($handle);
        return $backup_file_name;
    } else {
        return false;
    }
}
/**
 * Dec post data
 *
 * @param array $postData data post
 * @param object $securityInstance object security
 * @return array data decrypted
 */
function decryptPostData(array $postData, $securityInstance, array $excludeKeys = []): array
{
    $data = [];
    foreach ($postData as $key => $value) 
    {
        if (in_array($key, $excludeKeys)) 
        {
            $data[$key] = $value;
            continue;
        }

        if (strpos($value, '=') !== false) 
        {
            $data[$key] = $securityInstance->decryptRSA($value);
            if ($data[$key] === null) 
            {
                exit(JSON_FORMATTER(['status' => -1, 'msg' => "Request data is not authorized."]));
            }
        } 
        else 
        {
            $data[$key] = $value;
        }
    }
    return $data;
}
/**
 * Method ThanhDieuPOST
 *
 * @param callable $callback [payloads]
 *
 * @return void
 */
function ThanhDieuPOST(callable $callback)
{
    extract($GLOBALS);
    $payload = ($_POST['thanhdieu-protected'] ?? false) && ($decrypted = $wtSecurity->decryptRSA($_POST['thanhdieu-protected'])) 
        ? json_decode($decrypted, true) 
        : null;

    if ($payload !== null) 
    {
        return $callback($payload);
    }
    return null;
}
class WsCheckIMG
{
    /**
     * Method WsCheckImg
     *
     * @param $vlxx $vlxx
     *
     */
    public static function WsCheckImg($vlxx)
    {
        return in_array($vlxx, ["png", "jpg", "jpeg", "webp", "gif"]);
    }
    /**
     * Method SizeLimit
     *
     * @param $fileSize
     * @param $limit
     *
     */
    public static function SizeLimit($fileSize, $limit = 15)
    {
        if ($fileSize <= $limit * 1024 * 1024) {
            return true;
        } else {
            // return "Kích thước của ảnh không được vượt quá giới hạn cho phép (15MB).";
            return false;
        }
    }
}
class TimeFormatter
{
    private $dateTime;

    public function __construct($dateTime = null)
    {
        $this->dateTime = $dateTime ? new DateTime($dateTime) : new DateTime();
    }

    /**
     * Method ThoiGian
     *
     */
    public function ThoiGian()
    {
        $FormattedDate = $this->dateTime->format("H:i");
        $DayOfWeek = $this->dateTime->format("l");
        $FormattedDate .=
        " " .
        $this->NgayTrongTuan($DayOfWeek) .
        " " .
        $this->dateTime->format("d/m/Y");
        return $FormattedDate;
    }

    /**
     * Method NgayTrongTuan
     *
     * @param $DayOfWeek $DayOfWeek
     *
     * @return void
     */
    private function NgayTrongTuan($DayOfWeek)
    {
        $Map = [
            "Monday" => "Thứ Hai",
            "Tuesday" => "Thứ Ba",
            "Wednesday" => "Thứ Tư",
            "Thursday" => "Thứ Năm",
            "Friday" => "Thứ Sáu",
            "Saturday" => "Thứ Bảy",
            "Sunday" => "Chủ Nhật",
        ];

        return $Map[$DayOfWeek] ?? $DayOfWeek;
    }
}
/////////////---Vươ4ng Tha2nh Diệ1u---/////////////
class CheckPlanStatus extends DatabaseConnection
{
    public function TD($taikhoan)
    {
        $VTD = self::ThanhDieuDB()->prepare(
            "SELECT * FROM ws_plans WHERE taikhoan=? AND ngayhethan > NOW() AND trangthai=1"
        );
        $VTD->bind_param("s", $taikhoan);
        $VTD->execute();
        $OoO = $VTD->get_result();
        if ($OoO->num_rows > 0) {
            return $OoO->fetch_assoc();
        } else {
            return null;
        }
    }
}
class PlanExpiredChecker extends DatabaseConnection
{
    public static function TD()
    {
        $OoO = self::ThanhDieuDB()->query(
            "SELECT plans_id, taikhoan, tengoi FROM ws_plans WHERE ngayhethan <= NOW() AND trangthai != 0"
        );
        if ($OoO && $OoO->num_rows > 0) {
            while ($row = $OoO->fetch_assoc()) {
                $plan_id = $row["plans_id"];
                $taikhoan = $row["taikhoan"];
                $plan_name = $row["tengoi"];
                $current_time = self::CurrentTime();
                self::ThanhDieuDB()->query(
                    "UPDATE ws_plans SET trangthai=0 WHERE plans_id='{$plan_id}'"
                );
                self::ThanhDieuDB()->query(
                    "INSERT INTO ws_logs (username, content, time, action) VALUES ('$taikhoan', 'gói thành viên " .
                    strtoupper($plan_name) .
                    " đã hết hạn', '$current_time', 'Hết Hạn Gói VIP')"
                );
            }
            $OoO->free();
        }
    }
}
class FreeBill extends DatabaseConnection
{
    public function checked($taikhoan, $limit)
    {
        $current_time_lite = self::CurrentTimeLite();
        $vtd = self::ThanhDieuDB()->prepare(
            "SELECT COUNT(*) as count FROM ws_freebill WHERE taikhoan=? AND DATE(thoigian)=?"
        );
        $vtd->bind_param("ss", $taikhoan, $current_time_lite);
        $vtd->execute();
        $OoO = $vtd->get_result();
        $ws = $OoO->fetch_assoc();
        return $ws["count"] >= $limit;
    }
}
class LimitBill extends DatabaseConnection
{
    /**
     * Method checked
     *
     * @param $taikhoan $taikhoan
     * @param $limit $limit
     *
     */
    public function checked($taikhoan, $limit)
    {
        $current_time = self::CurrentTimeLite();
        $vtd = self::ThanhDieuDB()->prepare(
            "SELECT COUNT(*) as count FROM ws_limitbill WHERE taikhoan=? AND DATE(ngaytao)=?"
        );
        $vtd->bind_param("ss", $taikhoan, $current_time);
        $vtd->execute();
        $OoO = $vtd->get_result();
        $ws = $OoO->fetch_assoc();
        return $ws["count"] >= $limit;
    }
}
class Plans extends DatabaseConnection
{
    /**
     * Method TD
     *
     * @param string $column
     * @param string $account
     *
     * @return mixed
     */
    public function TD($column, $account = null)
    {
        $current_time = self::CurrentTime();
        $vtd = self::ThanhDieuDB()->prepare("SELECT p.$column,
                   COALESCE(l.total, 0) AS total_limit,
                   (p.gioihanbill - COALESCE(l.total, 0)) AS solantaoconlai
            FROM ws_plans p
            LEFT JOIN (
                SELECT taikhoan, COUNT(*) AS total
                FROM ws_limitbill
                WHERE DATE(ngaytao)=CURDATE()
                GROUP BY taikhoan
            ) l ON p.taikhoan=l.taikhoan
            WHERE p.taikhoan=? AND p.ngayhethan >= ? AND p.trangthai=1
        ");
        $vtd->bind_param("ss", $account, $current_time);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $OoO->num_rows > 0) {
            $row = $OoO->fetch_assoc();
            if (isset($row[$column])) {
                return $row[$column];
            }
        }
        return null;
    }

    /**
     * Method to get the remaining create bill count
     *
     * @param string $account
     * @return int|null
     */
    public function ConLaiLanTao($account)
    {
        $current_time = self::CurrentTime();

        $vtd = self::ThanhDieuDB()->prepare("SELECT
                (p.gioihanbill - COALESCE(l.total, 0)) AS solantaoconlai
            FROM ws_plans p
            LEFT JOIN (
                SELECT taikhoan, COUNT(*) AS total
                FROM ws_limitbill
                WHERE DATE(ngaytao)=CURDATE()
                GROUP BY taikhoan
            ) l ON p.taikhoan=l.taikhoan
            WHERE p.taikhoan=? AND p.ngayhethan >= ? AND p.trangthai=1
        ");
        $vtd->bind_param("ss", $account, $current_time);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $OoO->num_rows > 0) {
            return $OoO->fetch_assoc()["solantaoconlai"];
        }
        return null;
    }
}
class DanhSachGoi extends DatabaseConnection
{
    public $id;
    public $tengoi;
    public $giagoi;
    public $hansudung;
    public $gioihanbill;
    public $trangthai;
    public $thanhtoan;

    public function __construct($data, $userPlan)
    {
        $this->id = $data['dsgoi_id'];
        $this->tengoi = $data['tengoi'];
        $this->giagoi = $data['giagoi'];
        $this->hansudung = $this->sethsd($data['hansudung']);
        $this->gioihanbill = $this->setlimitbill($data['gioihanbill']);
        $this->trangthai = $data['trangthai'];

        if ($userPlan === null) {
            $this->thanhtoan = 'Chọn Gói';
        } else {
            $this->thanhtoan = $userPlan === 'vip'.$this->id ? 'Gia Hạn Ngay&nbsp;<font color="yellow">(Đang sử dụng)</font>✅' : '<font color="#0aff54">Nâng Cấp Ngay</font>';
        }
    }
    /**
     * Method setlimitbill
     *
     * @param $gioihanbill $gioihanbill [explicite description]
     *
     * @return string
     */
    private function setlimitbill($gioihanbill)
    {
        return $gioihanbill > 1999 ? 'Không giới hạn tạo bill ∞/∞' : 'Giới hạn tạo '.$gioihanbill.' bill/1 ngày';
    }
    private function sethsd($hansudung)
    {
        return $hansudung > 3650 ? 'Vĩnh viễn' : $hansudung.' ngày';
    }
    public function render()
    {
        if ($this->trangthai == 0) {
            return '<button data-plan="'.$this->id.'" class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-danger w-full btn btn-disabled" disabled>❌ Gói Không Còn Khả Dụng ❌</button>';
        }
        return '<button data-plan="'.$this->id.'" class="user-thue-goi nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-primary w-full">'.$this->thanhtoan.'</button>';
    }
}
class Deposit extends DatabaseConnection
{
    private $settings;
    private $params;

    public function __construct($settings)
    {
        $this->settings = $settings;
        $this->params = $this->getParams();
    }

    /**
     * Method getParams
     *
     * @return mixed
     */
    private function getParams()
    {
        if (!isset($_GET['token'])) 
        {
            return null;
        }

        $tokens = $this->decrypt($_GET['token']);

        if (!$tokens) 
        {
            return null;
        }

        if (count(explode('|', $tokens)) !== 7) 
        {
            return null;
        }

        list($session_deposit, $stk, $nganhang, $chutaikhoan, $sotien, $madonnap, $taikhoan) = explode('|', $tokens);

        if (empty($session_deposit) || empty($stk) || empty($nganhang) || empty($chutaikhoan) || empty($sotien) || empty($madonnap) || empty($taikhoan)) 
        {
            return null;
        }

        return (object)
            [
            'session_deposit' => $session_deposit,
            'stk' => $stk,
            'nganhang' => $nganhang,
            'chutaikhoan' => $chutaikhoan,
            'sotien' => $sotien,
            'madonnap' => $madonnap,
            'taikhoan' => $taikhoan,
        ];
    }

    /**
     * Method decrypt
     *
     * @param $token
     *
     * @return string
     */
    private function decrypt($token)
    {

        global $wtSecurity;
        if (!$token || strlen($token) % 2 !== 0) 
        {
            return null;
        }
        return $wtSecurity->decrypt($token);
    }

    /**
     * Method validate
     *
     * @param $yourself
     *
     * @return mixed
     */
    public function validate($yourself)
    {
        if (!$this->params) 
        {
            $this->redirect();
        } elseif (!isset($_SESSION['session_deposit']) || $_SESSION['session_deposit'] !== true) 
        {
            $this->redirect();
        }
        $wt = self::ThanhDieuDB()->prepare("SELECT * FROM ws_transfer WHERE stk = ? AND nganhang = ? AND chutaikhoan = ?");
        $wt->bind_param("sss", $this->params->stk, $this->params->nganhang, $this->params->chutaikhoan);
        $wt->execute();
        $lavender = $wt->get_result();
        if ($lavender->num_rows <= 0 || empty($this->params->session_deposit) || empty($this->params->sotien)) 
        {
            $this->redirect();
        } elseif ($this->params->taikhoan !== $yourself) 
        {
            $this->redirect();
        }
        return (object)
            [
            'sotien' => $this->params->sotien,
            'stk' => $this->params->stk,
            'nganhang' => $this->params->nganhang,
            'chutaikhoan' => $this->params->chutaikhoan,
            'madonnap' => $this->params->madonnap,
        ];
    }

    /**
     * Method redirect
     *
     * @return void
     */
    public function redirect()
    {
        global $taikhoan;

        die('<meta http-equiv="refresh" content="0;url=/nap-tien/'.$taikhoan.'/send">');
    }
}
class SecurityUtils
{
    /**
     * Method DetectSQLInjection
     *
     * @param $sql
     *
     * @return mixed
     */
    public static function DetectSQLInjection($sql)
    {
        if (
            preg_match(
                "/\b(union|select|insert|update|delete|drop|alter|truncate|exec|xp_cmdshell|or|order\s*by|from|where|and|group\s*by|having|char|nchar|varchar|nvarchar|cast|convert|declare|script|' OR '1'='1' -- -|' OR '1'='1' #|' OR 1=1 --|' OR 'x'='x' --|' OR 1=1 LIMIT 1 -- -|' OR 1=1; --|' OR '1'='1' --|' OR '1'='1'; --|' OR '1'='1'; DROP TABLE users -- -|' OR 1=CONVERT\(int, \(SELECT @@version\)\) --|' OR 1=\(SELECT COUNT\(\*\) FROM information_schema\.tables\) --|' OR 'x'='x' AND 'y'='y' --|' OR 'x'='x' AND 'y'='z' --|' UNION SELECT null, username, password FROM users --)\b/i",
                $sql
            ) &&
            !preg_match(
                "/' UNION SELECT null, username, password FROM users --/i",
                $sql
            )
        ) {
            return true;
        }
        return false;
    }
}
class CountFormatter
{
    /**
     * Method Count
     *
     * @param $count
     *
     * @return string
     */
    public static function EN($count)
    {
        $count = $count ?? 0;
        if ($count >= 1000 && $count < 1000000) {
            return round($count / 1000, 1)."K";
        } elseif ($count >= 1000000 && $count < 1000000000) {
            return round($count / 1000000, 1)."M";
        } elseif ($count >= 1000000000) {
            return round($count / 1000000000, 1)."B";
        } else {
            return $count;
        }
    }
}
class FormatNumber
{
    /**
     * Method TD
     *
     * @param $coin $coin
     * @param $type $type
     *
     */
    public static function TD($coin, $type = 1)
    {
        if (empty($coin)) {
            $coin = 0;
        }        

        if ($type == 1) {
            return number_format($coin, 0, ",", ".");
        } elseif ($type == 2) {
            return number_format($coin, 0, ",", ",");
        } else {
            return number_format($coin, 0, ",", ".");
        }
    }

    /**
     * Method PREG
     *
     * @param $number
     *
     */
    public static function PREG($number)
    {
        if (preg_match("/\d/", $number)) {
            return preg_replace("/[^0-9]/", "", trim($number));
        }
        return $number;
    }
    public static function STK($number)
    {
        return preg_replace("/(\d{4})(?=\d)/", '$1 ', self::PREG($number));
    }
}
class FormatTime
{
    /**
     * Method TD
     *
     * @param $time
     * @param $type
     *
     */
    public static function TD($time, $type = 2)
    {
        if ($type == 1) {
            return date("H:i:s d/m/Y", strtotime($time));
        } else {
            return date("H:i d/m/Y", strtotime($time));
        }
    }
}
class WsRandomString
{
    /**
     * Method TD
     *
     * @param $length
     *
     */
    public static function TD($length = 10)
    {
        $numbers = "0123456789";
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $Letters = max(1, intdiv($length, 5));
        $Numbers = $length - $Letters;
        $random = "";
        for ($i = 0; $i < $Numbers; $i++) {
            $random .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        for ($i = 0; $i < $Letters; $i++) {
            $random .= $letters[rand(0, strlen($letters) - 1)];
        }
        $random = str_shuffle($random);

        return $random;
    }    
    /**
     * Method generateRandomString
     *
     * @return string
     */
    public static function str($length = 10, $mode = 1)
    {
        $numbers = "0123456789";
        switch ($mode) {
            case 1: 
                $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                return substr(str_shuffle(str_repeat($letters, ceil($length / strlen($letters)))), 0, $length);
    
            case 2:
                $letters = "abcdefghijklmnopqrstuvwxyz";
                return substr(str_shuffle(str_repeat($letters, ceil($length / strlen($letters)))), 0, $length);
    
            case 3:
            default:
                $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $Letters = max(1, intdiv($length, 2));
                $Numbers = $length - $Letters;
    
                $random = "";
                for ($i = 0; $i < $Numbers; $i++) {
                    $random .= $numbers[rand(0, strlen($numbers) - 1)];
                }
                for ($i = 0; $i < $Letters; $i++) {
                    $random .= $letters[rand(0, strlen($letters) - 1)];
                }
    
                return str_shuffle($random);
        }
    }    
    /**
     * Method TD2
     *
     * @param $length
     * @param $letterCount
     *
     */
    public static function TD2($length = 16, $letterCount = 1)
    {
        $numbers = "0123456789";
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $random = "";
        if ($letterCount > $length) {
            $letterCount = $length;
        }
        for ($i = 0; $i < $length - $letterCount; $i++) {
            $random .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        for ($i = 0; $i < $letterCount; $i++) {
            $randomLetter = $letters[rand(0, strlen($letters) - 1)];
            $randomPosition = rand(0, strlen($random));
            $random = substr_replace(
                $random,
                $randomLetter,
                $randomPosition,
                0
            );
        }

        return $random;
    }

    /**
     * Method Key
     *
     * @param $length
     *
     */
    public static function Key($length = 36)
    {
        $hex = bin2hex(random_bytes(max(36, intdiv($length, 2) * 2) / 2));
        $uuid = sprintf(
            "%012s-%04s-%04x-%04x-%012s",
            substr($hex, 0, 12),
            substr($hex, 12, 4),
            (hexdec(substr($hex, 16, 4)) & 0x0fff) | 0x4000,
            (hexdec(substr($hex, 20, 4)) & 0x3fff) | 0x8000,
            substr($hex, 24, 12)
        );

        return $uuid;
    }
    /**
     * Method Number
     *
     * @param $length
     *
     */
    public static function Number($length = 10)
    {
        $digits = "0123456789";
        $random = "";
        for ($i = 0; $i < $length; $i++) {
            $random .= $digits[rand(0, 9)];
        }
        return $random;
    }    
  /**
     * Method AlphaNumeric
     *
     * @param int $length
     * @return string
     */
    public static function AlphaNumeric($length = 18)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $letters[random_int(0, strlen($letters) - 1)];
        }
        return $random;
    }
}
class BrowserSupport
{
    private $browsers = [
        "firefox",
        "chrome",
        "safari",
        "opera",
        "corom",
        "coccoc",
    ];
    private $browser = null;

    public function __construct()
    {
        $this->browser = new stdClass();
        $this->detect();
    }

    private function detect()
    {
        $userAgent = $_SERVER["HTTP_USER_AGENT"] ?? '';
        preg_match(
            "#(".implode("|", $this->browsers).")(/| )([^ ]+)#i",
            $userAgent,
            $match
        );

        $this->browser->version = isset($match[3]) ? round((int) $match[3]) : 0;

        $match = isset($match[1]) ? strtolower($match[1]) : '';

        foreach ($this->browsers as $val) {
            $this->browser->{$val} = ($match == $val);
        }

        if ($this->browser->safari || $this->browser->opera) {
            preg_match(
                "#version/([^ ]+)#i",
                $_SERVER["HTTP_USER_AGENT"],
                $match
            );

            $this->browser->version = isset($match[1]) ? round((int) $match[1]) : 0;
        }

        $this->browser->webkit =
        $this->browser->chrome || $this->browser->safari;
    }
    public function check(...$browsersToCheck)
    {
        foreach ($browsersToCheck as $val) {
            if (isset($this->browser->{$val}) && $this->browser->{$val}) {
                return $val;
            }
        }
        return false;
    }
}
class TextCutter
{
    /**
     * Method characters
     *
     * @param $string
     * @param $length
     *
     */
    public function characters($string, $length)
    {
        if (mb_strlen($string, "UTF-8") > $length) {
            return mb_substr($string, 0, $length, "UTF-8")."...";
        }
        return $string;
    }
}
class curlServiceSocial 
{
    private $apiURL;
    private $username;
    private $apiKey;

    public function __construct($TD)
    {
        $this->apiURL = '';
        $this->apiKey = 'DfcDzuw4CfSDEWlOpgZzMCno7ZjugmPhPia';
    }

    private function curl($postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiURL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'status' => -1,
                'msg' => "Internal server error, unable to connect back-end. $error",
            ];
        }
        curl_close($ch);
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => -1,
                'msg' => 'Internal server error, unable to decode JSON response.',
            ];
        }

        if (isset($result['code']) && $result['code'] === 200 && isset($result['status']) && $result['status'] === 'success') {
            return [
                'status' => 200,
                'data' => $result,
            ];
        } else {
            return [
                'status' => -1,
                'data' => $result,
            ];
        }
    }
    public function add($service, $link, $quantity)
    {
        $postData = [
            'action' => 'add',
            'service' => $service,
            'link' => $link,
            'quantity' => $quantity,
            'key' => $this->apiKey,
        ];

        return $this->curl($postData);
    }
    public function status($order)
    {
        $postData = [
            'action' => 'status',
            'order' => $order,
            'key' => $this->apiKey,
        ];

        return $this->curl($postData);
    }
}

/** ----------------------------------------------------------------------------- */
/**
 * Giải Thích Update
 * $update->wusteam('update','tenbang', array('username' => 'taikhoan'), "id=1")
 * trong đó tenbang là tên bảng cần update | id= 1 tức cột cụ thể cần update
 * tương tự into chỉ cần thay update thành into, into khong cần sài cột cụ thể
 * eg. $into->wusteam('insert', 'tenbang',array('username' => 'taikhoan','message' => 'Đây là thông báo')))
 */
class WussunSQL extends DatabaseConnection
{
    /**
     * Method wusteam
     *
     * @param $action $action
     * @param $table $table
     * @param $data $data
     * @param $condition $condition
     *
     * @return mixed
     */
    public function wusteam($action, $table, $data, $condition = null)
    {
        if ($action == "insert") {
            $this->insert($table, $data);
        } else {
            die(
                JSON_FORMATTER([
                    "status" => -1,
                    "msg" => "Request could not be processed!",
                ])
            );
        }
    }
    /**
     * Method insert
     *
     * @param $table
     * @param $data
     *
     * @return mixed
     */
    private function insert($table, $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);
        $stmt = self::ThanhDieuDB()->prepare(
            "INSERT INTO $table (" .
            implode(", ", $columns) .
            ") VALUES (" .
            rtrim(str_repeat("?, ", count($columns)), ", ") .
            ")"
        );
        $stmt->bind_param(str_repeat("s", count($columns)), ...$values);
        $stmt->execute();
    }
    // private function update1($table, $data, $condition) {
    //     if ($condition === null) {
    //         die("Điều kiện cập nhật không được cung cấp!");
    //     }
    //     $setExpressions=array();
    //     foreach ($data as $column => $value) {
    //         $setExpressions[]="$column=?";
    //     }
    //     $stmt=self::ThanhDieuDB()->prepare("UPDATE $table SET ".implode(",", $setExpressions)." WHERE $condition");
    //     $stmt->bind_param(str_repeat('s', count($data)),...array_values($data));
    //     $stmt->execute();
    // }
    public function update($sql)
    {
        if (empty($sql)) {
            die("Câu lệnh SQL không được cung cấp!");
        }
        $stmt = self::ThanhDieuDB()->prepare($sql);
        if (!$stmt) {
            die("Lỗi trong quá trình chuẩn bị câu lệnh SQL!");
        }
        $stmt->execute();
        if ($stmt->errno) {
            die($stmt->error);
        }
    }
}
/** ----------------------------------------------------------------------------- */
function Avatar($username, $color)
{
    $initial = strtoupper(substr($username, 0, 1));
    $size = 100;
    $font_size = $size / 2;
    $image = imagecreate($size, $size);
    $bgColor = hex2rgb($color);
    if ($bgColor === false) {
        $bgColor = ["r" => 66, "g" => 133, "b" => 244];
    }
    $background_color = imagecolorallocate(
        $image,
        $bgColor["r"],
        $bgColor["g"],
        $bgColor["b"]
    );
    imagefill($image, 0, 0, $background_color);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    $font_path = $_SERVER["DOCUMENT_ROOT"]."/".__FONTS__."/common/Helvetica/Helvetica.ttf";
    $bbox = imagettfbbox($font_size, 0, $font_path, $initial);
    $text_width = $bbox[2] - $bbox[0];
    $text_height = $bbox[7] - $bbox[1];
    $x = round(($size - $text_width) / 2);
    $y = round(($size - $text_height) / 2 - $bbox[1]);
    imagettftext(
        $image,
        $font_size,
        0,
        $x,
        $y,
        $text_color,
        $font_path,
        $initial
    );
    ob_start();
    imagepng($image);
    $image_data = ob_get_clean();
    imagedestroy($image);
    return "data:image/png;base64,".Base64_Enc($image_data);
}
function hex2rgb($hex)
{
    $hex = preg_replace("/[^a-fA-F0-9]/", "", $hex);
    if (strlen($hex) !== 6) {
        return false;
    }
    return [
        "r" => hexdec(substr($hex, 0, 2)),
        "g" => hexdec(substr($hex, 2, 2)),
        "b" => hexdec(substr($hex, 4, 2)),
    ];
}
function RandomHexColor()
{
    return "#".strtolower(dechex(rand(0x000000, 0xffffff)));
}
function DeviceId()
{
    return sprintf(
        "%04x%04x-%04x-%04x-%04x-%04x%04x%04x",
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
function UserAgent()
{
    $list = [
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13(KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13",
        "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13",
        "Mozilla/5.0 (Linux; U; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13",
        "Mozilla/5.0 (Macintosh; U; Mac OS X 10_6_1; en-US) AppleWebKit/530.5 (KHTML, like Gecko) Chrome/ Safari/530.5",
        "Mozilla/5.0 (Macintosh; U; Mac OS X 10_5_7; en-US) AppleWebKit/530.5 (KHTML, like Gecko) Chrome/ Safari/530.5",
        "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-US) AppleWebKit/530.9 (KHTML, like Gecko) Chrome/ Safari/530.9",
        "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-US) AppleWebKit/530.6 (KHTML, like Gecko) Chrome/ Safari/530.6",
        "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-US) AppleWebKit/530.5 (KHTML, like Gecko) Chrome/ Safari/530.5",
    ];
    return $list[array_rand($list)];
}
function KhuyenMai($sotien)
{
    global $TD;

    $khuyenmai = $TD->Setting("khuyen-mai");

    if ($khuyenmai > 0 && $sotien >= $khuyenmai) {
        $tongtien = $sotien + $sotien * 0.2;
    } else {
        $tongtien = $sotien;
    }
    return $tongtien;
}

function Base64_Enc($value)
{
    $encoded = base64_encode($value);
    $ws = rtrim($encoded, "=");
    return $ws;
}
function Base64_Dec($value)
{
    $padding = strlen($value) % 4;
    if ($padding) {
        $value .= str_repeat("=", 4 - $padding);
    }
    return base64_decode($value);
}
function capitalize($domain)
{
    $parts = explode(".", $domain);
    $caption = array_map("ucfirst", $parts);
    return implode(".", $caption);
}
function isMobile()
{
    return preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|ipad|ipod|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"] ?? ''
    );
}
// class Dashboard_MobileDetect {

//     protected $accept;
//     protected $userAgent;
//     protected $isMobile = false;
//     protected $isAndroid = null;
//     protected $isAndroidtablet = null;
//     protected $isIphone = null;
//     protected $isIpad = null;
//     protected $isBlackberry = null;
//     protected $isBlackberrytablet = null;
//     protected $isOpera = null;
//     protected $isPalm = null;
//     protected $isWindows = null;
//     protected $isWindowsphone = null;
//     protected $isGeneric = null;
//     protected $devices = array(
//       "android" => "android.*mobile",
//       "androidtablet" => "android(?!.*mobile)",
//       "blackberry" => "blackberry",
//       "blackberrytablet" => "rim tablet os",
//       "iphone" => "(iphone|ipod)",
//       "ipad" => "(ipad)",
//       "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
//       "windows" => "windows ce; (iemobile|ppc|smartphone)",
//       "windowsphone" => "windows phone os",
//       "generic" => "(kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
//     );

//     public function __construct() {
//       $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
//       $this->accept = $_SERVER['HTTP_ACCEPT'];

//       if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
//         $this->isMobile = true;
//       } elseif (strpos($this->accept, 'text/vnd.wap.wml') > 0 || strpos($this->accept, 'application/vnd.wap.xhtml+xml') > 0) {
//         $this->isMobile = true;
//       } else {
//         foreach ($this->devices as $device => $regexp) {
//           if ($this->isDevice($device)) {
//             $this->isMobile = true;
//           }
//         }
//       }

//       if ($this->isMobile && $this->isDevice('ipad')) {
//         $this->isMobile = false;
//       }
//     }

//     public function __call($name, $arguments) {
//       $device = substr($name, 2);
//       if ($name == "is".ucfirst($device) && array_key_exists(strtolower($device), $this->devices)) {
//         return $this->isDevice($device);
//       } else {
//         trigger_error("Method $name not defined", E_USER_WARNING);
//       }
//     }

//     private static $instance;
//     static function load() {
//       $class = __CLASS__;
//       return ( self::$instance ? self::$instance : ( self::$instance = new $class() ));
//     }

//     static function is($device = null) {
//       if (is_null($device)) {
//         return self::load()->isMobile();
//       } else {
//         return self::load()->isDevice($device);
//       }
//     }

//     public function isMobile() {
//       return $this->isMobile;
//     }

//     protected function isDevice($device) {
//       $var = "is".ucfirst($device);
//       $return = $this->$var === null ? (bool) preg_match("/".$this->devices[strtolower($device)]."/i", $this->userAgent) : $this->$var;
//       if ($device != 'generic' && $return == true) {
//         $this->isGeneric = false;
//       }
//       return $return;
//     }

//   }
function RandomDeviceId()
{
    return sprintf(
        "%04x%04x-%04x-%04x-%04x-%04x%04x%04x",
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
function isDate($date)
{
    return preg_match(
        "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/",
        $date
    );
}
function getFormattedDate()
{
    switch (date('w')) {
        case 0:$date = 'Chủ nhật';
            break;
        case 1:$date = 'Thứ Hai';
            break;
        case 2:$date = 'Thứ Ba';
            break;
        case 3:$date = 'Thứ Tư';
            break;
        case 4:$date = 'Thứ Năm';
            break;
        case 5:$date = 'Thứ Sáu';
            break;
        case 6:$date = 'Thứ Bảy';
            break;
        default:$date = '';
            break;
    }

    if (date('H') < 12) {
        $times = 'Sáng';
    } elseif (date('H') < 14) {
        $times = 'Trưa';
    } elseif (date('H') < 18) {
        $times = 'Chiều';
    } elseif (date('H') < 21) {
        $times = 'Tối';
    } else {
        $times = 'Khuya';
    }
    $day = date('d');
    $month = date('m');
    $year = date('Y');
    return "$date, $times $day/$month/$year";
}
function AuthIconBank()
{
    return [
        ["file" => "msb", "class" => "start-0 top-[30%] size-12"],
        ["file" => "vietinbank", "class" => "-start-[25%] top-[40%] size-16"],
        ["file" => "tpbank", "class" => "-start-[5%] top-[52%] size-16"],
        ["file" => "vietcombank", "class" => "-start-[35%] top-[65%] size-24"],
        ["file" => "oceanbank", "class" => "-start-[35%] top-[20%] size-10"],
        ["file" => "sacombank", "class" => "-start-[55%] top-[40%] size-20"],
        ["file" => "scb", "class" => "end-0 top-[30%] size-12"],
        ["file" => "ocb", "class" => "-end-[25%] top-[40%] size-16"],
        ["file" => "agribank", "class" => "-end-[5%] top-[52%] size-16"],
        ["file" => "mbbank2", "class" => "-end-[35%] top-[65%] size-24"],
        ["file" => "bidv", "class" => "-end-[35%] top-[20%] size-10"],
        ["file" => "acbbank", "class" => "-end-[55%] top-[40%] size-20"],
    ];
}
function VnTones($str)
{
    $vi = ["à", "á", "ạ", "ả", "ã", "ả", "â", "ấ", "ầ", "ẩ", "ẫ", "ậ", "ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ể", "ễ", "ệ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ẩ", "Ẫ", "Ậ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ể", "Ễ", "Ệ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ"];
    $en = ["a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D"];
    return str_replace($vi, $en, $str);
}
function RemoveParams($url)
{
    $a = parse_url($url);
    if (isset($a["query"])) {
        $b = $a["path"];
    } else {
        $b = $url;
    }
    return urldecode($b);
}
function JSON_FORMATTER($res)
{
    return json_encode(
        $res,
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );
}
function FormatStk($stk)
{
    if (strlen($stk) <= 6) {
        return $stk;
    }
    $f = substr($stk, 0, 2);
    $l = substr($stk, -3);
    return $f."xxx".$l;
}
function TaoBillTheoGoi($taikhoan, $into, $tengoi, $ngayhethan)
{
    // $into->wusteam("insert", "ws_logs", [
    //     "username" => $taikhoan,
    //     "content" => "tạo fake bill qua gói VIP".$tengoi,
    //     "action" => "Tạo Bill Qua Gói",
    // ]);
    if ((date("Y", strtotime($ngayhethan)) - date("Y")) > 10) {
        return;
    }
    $into->wusteam("insert", "ws_limitbill",
        [
            "taikhoan" => $taikhoan,
        ]);
}
function HistoryFakebill($into, $taikhoan, $Bill, $base64, $name, $type)
{
    $into->wusteam('insert', 'ws_history_fakebill', [
        'username' => $taikhoan,
        'image' => $Bill->save('data:image/jpeg;base64,'.$base64, $_SERVER['DOCUMENT_ROOT'].'/public/cache/bill/'),
        'namebill' => $name,
        'type' => $type,
    ]);
}
function TaoBillTheoSoDu($taikhoan, $giataobill, $user, $thanhdieudb, $into)
{
    $sodu_moi = $user["sodu"] - $giataobill;
    $thanhdieudb->query(
        "UPDATE users SET sodu = '$sodu_moi', tongtieu = tongtieu + '$giataobill' WHERE username = '$taikhoan'"
    );
    $into->wusteam("insert", "ws_logs",
        [
            "username" => $taikhoan,
            "content" => "tạo bill với giá ".FormatNumber::TD($giataobill)."đ",
            "action" => "Tạo Bill Theo Số Dư",
        ]);
}
function TaoBillFree($taikhoan, $into)
{
    $into->wusteam("insert", "ws_logs", [
        "username" => $taikhoan,
        "content" => "tạo fake bill miễn phí",
        "action" => "Tạo Bill Free",
    ]);
    $into->wusteam("insert", "ws_freebill", [
        "taikhoan" => $taikhoan,
    ]);
}
function FormatHsdGoi($ngay)
{
    if ($ngay >= 3650) {
        return "Vĩnh viễn";
    }
    $nam = floor($ngay / 365);
    $thang = floor(($ngay % 365) / 30);
    $tuan = floor(($ngay % 30) / 7);
    $wt = null;
    if ($nam > 0) {
        $wt .= $nam." năm";
    } elseif ($thang > 0) {
        $wt .= $thang." tháng";
    } elseif ($tuan > 0) {
        $wt .= $tuan." tuần";
    } else {
        $wt .= $ngay." ngày";
    }

    return $wt;
}
function isSecure()
{
    return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ||
        $_SERVER["SERVER_PORT"] == 443 ||
        ((!empty($_SERVER["HTTP_X_FORWARDED_PROTO"]) &&
        $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https") ||
        (!empty($_SERVER["HTTP_X_FORWARDED_SSL"]) &&
            $_SERVER["HTTP_X_FORWARDED_SSL"] == "on"));
}
function AlwaysUseHTTPS()
{
    if (!isSecure()) {
        header(
            "Location: https://" .
            $_SERVER["HTTP_HOST"] .
            $_SERVER["REQUEST_URI"],
            true,
            301
        );
        exit();
    }
}
if ($TD->Setting("https")) {
    AlwaysUseHTTPS();
}
function CheckStrongPassword($password)
{
    $hasLetter = false;
    $hasDigit = false;
    $hasSpecial = false;
    $specialCharacters = "!@#$%^&*()_+";

    if (strlen($password) < 6) {
        return false;
    }
    for ($i = 0; $i < strlen($password); $i++) {
        if (ctype_alpha($password[$i])) {
            $hasLetter = true;
        } elseif (ctype_digit($password[$i])) {
            $hasDigit = true;
        } elseif (strpos($specialCharacters, $password[$i]) !== false) {
            $hasSpecial = true;
        }
    }
    return ($hasLetter && $hasDigit) ||
        ($hasDigit && $hasSpecial) ||
        ($hasLetter && $hasSpecial);
}
function CheckPassword($password)
{
    if (preg_match('/^[a-zA-Z0-9~!@#$%^&*()_+]+$/', $password)) {
        return true;
    } else {
        return false;
    }
}
function CheckFullName($hovaten)
{
    if (
        preg_match(
            '/[^\p{L}\p{N}\s]|[!@#$%^&*()_+={}\[\]:;"\'<>?,.\/\\`~|\\\\]/u',
            $hovaten
        )
    ) {
        return false;
    } else {
        return true;
    }
}
function CheckSdt($sdt)
{
    if (preg_match('/^(03|05|07|08|09)\d{8}$/', $sdt)) {
        return false;
    } else {
        return true;
    }
}
function VerifyOldPassword($username, $password, $db)
{
    $tdtv = $db->prepare("SELECT password FROM users WHERE username=?");
    $tdtv->bind_param("s", $username);
    $tdtv->execute();
    $result = $tdtv->get_result();
    if ($result->num_rows == 1) {
        $w = $result->fetch_assoc();
        $hashed_pass = $w["password"];
        return password_verify($password, $hashed_pass);
    }
    return false;
}
function TaoMatKhauManh(
    $length = 13,
    $add_dashes = false,
    $available_sets = "hack"
) {
    $sets = [];
    if (strpos($available_sets, "h") !== false) {
        $sets[] = "abcdefghjkmnpqrstuvwxyz";
    }
    if (strpos($available_sets, "a") !== false) {
        $sets[] = "ABCDEFGHJKMNPQRSTUVWXYZ";
    }
    if (strpos($available_sets, "c") !== false) {
        $sets[] = "0123456789";
    }
    if (strpos($available_sets, "k") !== false) {
        $sets[] = '.!@#$*~-';
    }
    $all = null;
    $password = null;
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }

    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++) {
        $password .= $all[array_rand($all)];
    }

    $password = str_shuffle($password);

    if (!$add_dashes) {
        return $password;
    }
    $dash_len = floor(sqrt($length));
    $dash_str = null;
    while (strlen($password) > $dash_len) {
        $dash_str .= substr($password, 0, $dash_len)."-";
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}
class RequestPageCount extends DatabaseConnection
{
    public function TD($page)
    {
        $vtd = self::ThanhDieuDB()->prepare(
            "UPDATE ws_requestpages SET count_request=count_request + 1 WHERE pages=?"
        );
        $vtd->bind_param("s", $page);
        $vtd->execute();
        if ($vtd->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
function TDSlug($str)
{
    $characters = [
        "á" => "a",
        "à" => "a",
        "ả" => "a",
        "ã" => "a",
        "ạ" => "a",
        "ă" => "a",
        "ắ" => "a",
        "ằ" => "a",
        "ẳ" => "a",
        "ẵ" => "a",
        "ặ" => "a",
        "â" => "a",
        "ấ" => "a",
        "ầ" => "a",
        "ẩ" => "a",
        "ẫ" => "a",
        "ậ" => "a",
        "đ" => "d",
        "é" => "e",
        "è" => "e",
        "ẻ" => "e",
        "ẽ" => "e",
        "ẹ" => "e",
        "ê" => "e",
        "ế" => "e",
        "ề" => "e",
        "ể" => "e",
        "ễ" => "e",
        "ệ" => "e",
        "í" => "i",
        "ì" => "i",
        "ỉ" => "i",
        "ĩ" => "i",
        "ị" => "i",
        "ó" => "o",
        "ò" => "o",
        "ỏ" => "o",
        "õ" => "o",
        "ọ" => "o",
        "ô" => "o",
        "ố" => "o",
        "ồ" => "o",
        "ổ" => "o",
        "ỗ" => "o",
        "ộ" => "o",
        "ơ" => "o",
        "ớ" => "o",
        "ờ" => "o",
        "ở" => "o",
        "ỡ" => "o",
        "ợ" => "o",
        "ú" => "u",
        "ù" => "u",
        "ủ" => "u",
        "ũ" => "u",
        "ụ" => "u",
        "ư" => "u",
        "ứ" => "u",
        "ừ" => "u",
        "ử" => "u",
        "ữ" => "u",
        "ự" => "u",
        "ý" => "y",
        "ỳ" => "y",
        "ỷ" => "y",
        "ỹ" => "y",
        "ỵ" => "y",
        "Á" => "A",
        "À" => "A",
        "Ả" => "A",
        "Ã" => "A",
        "Ạ" => "A",
        "Ă" => "A",
        "Ắ" => "A",
        "Ằ" => "A",
        "Ẳ" => "A",
        "Ẵ" => "A",
        "Ặ" => "A",
        "Â" => "A",
        "Ấ" => "A",
        "Ầ" => "A",
        "Ẩ" => "A",
        "Ẫ" => "A",
        "Ậ" => "A",
        "Đ" => "D",
        "É" => "E",
        "È" => "E",
        "Ẻ" => "E",
        "Ẽ" => "E",
        "Ẹ" => "E",
        "Ê" => "E",
        "Ế" => "E",
        "Ề" => "E",
        "Ể" => "E",
        "Ễ" => "E",
        "Ệ" => "E",
        "Í" => "I",
        "Ì" => "I",
        "Ỉ" => "I",
        "Ĩ" => "I",
        "Ị" => "I",
        "Ó" => "O",
        "Ò" => "O",
        "Ỏ" => "O",
        "Õ" => "O",
        "Ọ" => "O",
        "Ô" => "O",
        "Ố" => "O",
        "Ồ" => "O",
        "Ổ" => "O",
        "Ỗ" => "O",
        "Ộ" => "O",
        "Ơ" => "O",
        "Ớ" => "O",
        "Ờ" => "O",
        "Ở" => "O",
        "Ỡ" => "O",
        "Ợ" => "O",
        "Ú" => "U",
        "Ù" => "U",
        "Ủ" => "U",
        "Ũ" => "U",
        "Ụ" => "U",
        "Ư" => "U",
        "Ứ" => "U",
        "Ừ" => "U",
        "Ử" => "U",
        "Ữ" => "U",
        "Ự" => "U",
        "Ý" => "Y",
        "Ỳ" => "Y",
        "Ỷ" => "Y",
        "Ỹ" => "Y",
        "Ỵ" => "Y",
        " " => "-",
    ];
    $str = trim(
        preg_replace(
            "/-+/",
            "-",
            preg_replace(
                "/\s+/",
                "-",
                preg_replace(
                    "/[^a-z0-9-\s]/",
                    "",
                    strtolower(strtr($str, $characters))
                )
            )
        ),
        "-"
    );
    return $str;
}
class TotalGolbal extends DatabaseConnection
{
    private $taikhoan;

    public function __construct($taikhoan)
    {
        $this->taikhoan = $taikhoan;
    }

    public function Users()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `users`");
    }

    public function BannedUsers()
    {
        return $this->TD(
            "SELECT COUNT(*) AS COUNT FROM `users` WHERE `banned` > 0"
        );
    }

    public function Traffic()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_traffic`");
    }

    public function Money()
    {
        return $this->TD(
            "SELECT SUM(tongnap) AS COUNT FROM `users` WHERE `tongnap` > 0 AND `rank` != 'admin'"
        );
    }

    public function Logs()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_logs`");
    }

    public function Bank()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_history_bank`");
    }

    public function Card()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_history_card`");
    }

    public function HistoryFakeBill()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_history_fakebill`");
    }
    public function TotalFakeBill()
    {
        return $this->TD(
            "SELECT MAX(fakebill_id) AS COUNT 
             FROM `ws_history_fakebill`"
        );
    }
      public function TotalFreeFakeBill()
    {
        return $this->TD(
            "SELECT MAX(freebill_id) AS COUNT 
             FROM `ws_freebill`"
        );
    }
    public function Plans()
    {
        return $this->TD(
            "SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE trangthai='1'"
        );
    }
    public function AllPlans()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_plans`");
    }

    public function ListPlan()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_dsgoi`");
    }

    public function VIP1()
    {
        return $this->TD(
            "SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip1'"
        );
    }

    public function VIP2()
    {
        return $this->TD(
            "SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip2'"
        );
    }

    public function VIP3()
    {
        return $this->TD(
            "SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip3'"
        );
    }
    public function FreeBill()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_freebill`");
    }
    public function RevenueBank()
    {
        return $this->TD("SELECT SUM(sotien) AS COUNT FROM `ws_history_bank` WHERE sotien > 0");
    }

    public function RevenueCard()
    {
        return $this->TD("SELECT SUM(menhgia) AS COUNT FROM `ws_history_card` WHERE menhgia > 0");
    }

    public function checkBlackIP()
    {
        $oOo = self::ThanhDieuDB()->query("SELECT blackip FROM ws_settings");
        if ($oOo) {
            $data = $oOo->fetch_assoc();
            return $data ? $data["blackip"] : null;
        }
        return null;
    }
    private function TD($OWO)
    {
        $oOo = self::ThanhDieuDB()->query($OWO);
        if ($oOo) {
            $data = $oOo->fetch_assoc();
            return $data ? $data["COUNT"] : 0;
        }
        return 0;
    }
}
class Transfer extends DatabaseConnection
{
    public function TD($column, $record)
    {
        $offset = $record - 1;
        $vtd = self::ThanhDieuDB()->prepare(
            "SELECT `$column` FROM ws_transfer LIMIT ?, 1"
        );
        $vtd->bind_param("i", $offset);
        $vtd->execute();
        $wt = $vtd->get_result();
        if ($w = $wt->fetch_assoc()) {
            return $w[$column];
        } else {
            return "Chưa cấu hình transfer";
        }
    }
}
class BlacklistChecker extends DatabaseConnection
{
    /**
     * Method CheckBlacklist
     *
     * @param $ip
     * @param $TD
     *
     * @return void
     */
    public function blacklist($ip, $TD)
    {
        if (empty($ip)) {
            return;
        }
        $checkbanip = self::ThanhDieuDB()->query(
            "SELECT `black-ip` FROM ws_settings"
        );
        if ($checkbanip && $checkbanip->num_rows > 0) {
            while ($row = $checkbanip->fetch_assoc()) {
                if (!empty($row["black-ip"])) {
                    $bannedIps = array_filter(array_map('trim', explode("|", $row["black-ip"])));
                    if (in_array($ip, $bannedIps, true)) {
                        $message =
                        '<pre>Your IP has been blacklisted, if you need support, contact us <a href="' .
                        $TD->Setting("telegram") .
                            '" target="_blank">here</a></pre>.';
                        http_response_code(403);
                        header("HTTP/1.1 403 Forbidden");
                        die($message);
                    }
                }
            }
        }
    }
}
function anonymous($username)
{
    $length = strlen($username);
    if ($length <= 4) {
        return $username;
    }
    $a = ceil($length / 2);
    $b = $length - $a;
    return substr($username, 0, $a).str_repeat("*", $b);
}
function timeago($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1) {
        return "0 giây";
    }
    $a = [
        365 * 24 * 60 * 60 => "năm",
        30 * 24 * 60 * 60 => "tháng",
        24 * 60 * 60 => "ngày",
        60 * 60 => "giờ",
        60 => "phút",
        1 => "giây",
    ];
    $a_plural = [
        "năm" => "năm",
        "tháng" => "tháng",
        "ngày" => "ngày",
        "giờ" => "giờ",
        "phút" => "phút",
        "giây" => "giây",
    ];
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r." ".($r > 1 ? $a_plural[$str] : $str)." trước";
        }
    }
}
function FilterTags($text)
{
    $blacklist = ["<script", "</script", "<?php", "?>"];
    foreach ($blacklist as $word) {
        $text = str_ireplace($word, Chars($word), $text);
    }
    return $text;
}
function Chars($text)
{
    return implode("/", str_split($text));
}
class BrowserInfo
{
    public $name;
    public $icon;

    public function __construct($userAgent)
    {
        $this->name = "Google Chrome";
        $this->icon = "chrome";

        $userAgent = (string) $userAgent;

        if (strpos($userAgent, "Firefox") !== false) {
            $this->name = "Firefox";
            $this->icon = "firefox";
        } elseif (strpos($userAgent, "Chrome") !== false) {
            $this->name = "Google Chrome";
            $this->icon = "chrome";
        } elseif (strpos($userAgent, "Safari") !== false) {
            $this->name = "Safari";
            $this->icon = "safari";
        } elseif (strpos($userAgent, "Edge") !== false) {
            $this->name = "Microsoft Edge";
            $this->icon = "edge";
        } elseif (
            strpos($userAgent, "MSIE") !== false ||
            strpos($userAgent, "Trident") !== false
        ) {
            $this->name = "Internet Explorer";
            $this->icon = "ie";
        } elseif (strpos($userAgent, "Opera") !== false || strpos($userAgent, "OPR") !== false) {
            $this->name = "Opera";
            $this->icon = "opera";
        }
    }
}
class DeviceInfo
{
    public $name;
    public $icon;

    public function __construct($userAgent)
    {
        $this->name = "Không Xác Định";
        $this->icon = "android";

        $userAgent = (string) $userAgent;

        if (strpos($userAgent, "Android") !== false) {
            $this->name = "Android";
            $this->icon = "android";
        } elseif (
            preg_match(
                "/iPhone(?:\s+OS)?\s([0-9_]+)?\s*.*\s*like\s*Mac OS X/",
                $userAgent,
                $matches
            )
        ) {
            $this->name = "iOS";
            $iphone_version = !empty($matches[1])
            ? str_replace("_", ".", $matches[1])
            : "";
            $this->name = $iphone_version ? "iPhone $iphone_version" : "iPhone";
            $this->icon = "apple";
        } elseif (strpos($userAgent, "iPad") !== false) {
            $this->name = "iPad";
            $this->icon = "apple";
        } elseif (strpos($userAgent, "Windows Phone") !== false) {
            $this->name = "Windows Phone";
            $this->icon = "win1";
        } elseif (strpos($userAgent, "Macintosh") !== false) {
            $this->name = "macOS";
            $this->icon = "mac";
        } elseif (strpos($userAgent, "Linux") !== false) {
            $this->name = "Linux";
            $this->icon = "linux";
        } elseif (strpos($userAgent, "Windows") !== false) {
            if (
                preg_match(
                    "/Windows\s(?:NT\s)?(\d+\.\d+)/",
                    $userAgent,
                    $windows_matches
                )
            ) {
                $windows_version = $windows_matches[1];
                $this->name = "Windows $windows_version";
            } elseif (
                preg_match(
                    "/Windows\s(?:NT\s)?(\d+)/",
                    $userAgent,
                    $windows_matches
                )
            ) {
                $windows_version = $windows_matches[1];
                $this->name = "Windows $windows_version";
            } else {
                $this->name = "Windows";
            }
            $this->icon = "win1";
        }
    }
}
class ThoiGianTrongTuan
{
    public static $td = [
        "Monday" => "Thứ Hai",
        "Tuesday" => "Thứ Ba",
        "Wednesday" => "Thứ Tư",
        "Thursday" => "Thứ Năm",
        "Friday" => "Thứ Sáu",
        "Saturday" => "Thứ Bảy",
        "Sunday" => "Chủ Nhật",
    ];
    public static function convert($thoiGian)
    {
        foreach (self::$td as $english => $vietnamese) {
            $thoiGian = str_replace($english, $vietnamese, $thoiGian);
        }
        return $thoiGian;
    }
}
$now = date("H:i l d/m/Y", time());
foreach (ThoiGianTrongTuan::$td as $english => $vietnamese) {
    $now = str_replace($english, $vietnamese, $now);
}
$formatter_time = preg_replace(
    "/(\d{2}\/\d{2}\/\d{4})/",
    "ngày $1",
    ThoiGianTrongTuan::convert(date("l, H:i d/m/Y", time()))
);
function SaveModal($data)
{
    return [
        "text" => $data ? "Kích Hoạt" : "Vô Hiệu Hoá",
        "color" => $data ? "primary" : "danger",
        "checked" => $data ? "checked" : "",
    ];
}
function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}
function ucwordsFirst($str)
{
    $words = explode(" ", $str);
    $words = array_map("ucfirst", $words);
    return implode(" ", $words);
}
function convertGroup($index)
{
    switch ($index) {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " nghìn triệu triệu";
        case 4:
            return " nghìn tỷ";
        case 3:
            return " tỷ";
        case 2:
            return " triệu";
        case 1:
            return " nghìn";
        case 0:
            return "";
    }
}
function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";
    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
        return "";
    }
    if ($digit1 != "0") {
        $buffer .= convertDigit($digit1)." trăm";
        if ($digit2 != "0" || $digit3 != "0") {
            $buffer .= " ";
        }
    }

    if ($digit2 != "0") {
        $buffer .= convertTwoDigit($digit2, $digit3);
    } elseif ($digit3 != "0") {
        $buffer .= convertDigit($digit3);
    }
    return $buffer;
}
function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0") {
        switch ($digit1) {
            case "1":
                return "mười";
            case "2":
                return "ai mươi";
            case "3":
                return "ba mươi";
            case "4":
                return "bốn mươi";
            case "5":
                return "năm mươi";
            case "6":
                return "sáu mươi";
            case "7":
                return "bảy mươi";
            case "8":
                return "tám mươi";
            case "9":
                return "chín mươi";
        }
    } elseif ($digit1 == "1") {
        switch ($digit2) {
            case "1":
                return "mười một";
            case "2":
                return "mười hai";
            case "3":
                return "mười ba";
            case "4":
                return "mười bốn";
            case "5":
                return "mười lăm";
            case "6":
                return "mười sáu";
            case "7":
                return "mười bảy";
            case "8":
                return "mười tám";
            case "9":
                return "mười chín";
        }
    } else {
        $temp = convertDigit($digit2);
        if ($temp == "năm") {
            $temp = "lăm";
        }
        if ($temp == "một") {
            $temp = "mốt";
        }
        switch ($digit1) {
            case "2":
                return "hai mươi $temp";
            case "3":
                return "ba mươi $temp";
            case "4":
                return "bốn mươi $temp";
            case "5":
                return "năm mươi $temp";
            case "6":
                return "sáu mươi $temp";
            case "7":
                return "bảy mươi $temp";
            case "8":
                return "tám mươi $temp";
            case "9":
                return "chín mươi $temp";
        }
    }
}
function convertDigit($digit)
{
    switch ($digit) {
        case "0":
            return "không";
        case "1":
            return "một";
        case "2":
            return "hai";
        case "3":
            return "ba";
        case "4":
            return "bốn";
        case "5":
            return "năm";
        case "6":
            return "sáu";
        case "7":
            return "bảy";
        case "8":
            return "tám";
        case "9":
            return "chín";
    }
}
function convert_number_to_words($number, $type = 1)
{
    if (strpos($number, ".")) {
        list($integer, $fraction) = explode(".", (string) $number);
    } else {
        $integer = $number;
        $fraction = null;
    }
    $output = "";
    if ($integer[0] == "-") {
        $output = "âm ";
        $integer = ltrim($integer, "-");
    } elseif ($integer[0] == "+") {
        $output = "dương ";
        $integer = ltrim($integer, "+");
    }

    if ($integer[0] == "0") {
        $output .= "không";
    } else {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group = rtrim(chunk_split($integer, 3, " "), " ");
        $groups = explode(" ", $group);

        $groups2 = [];
        foreach ($groups as $g) {
            $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);
        }
        for ($z = 0; $z < count($groups2); $z++) {
            if ($groups2[$z] != "") {
                $output .=
                $groups2[$z] .
                convertGroup(11 - $z) .
                    ($z < 11 &&
                    !array_search("", array_slice($groups2, $z + 1, -1)) &&
                    $groups2[11] != "" &&
                    $groups[11][0] == "0"
                    ? " "
                    : "".($type == 1 ? ", " : " ")."");
            }
        }
        $output = rtrim($output, ", ");
    }
    if ($fraction > 0) {
        $output .= " phẩy";
        for ($i = 0; $i < strlen($fraction); $i++) {
            $output .= " ".convertDigit($fraction[$i]);
        }
    }
    $output .= " đồng";
    $output = ucfirst($output);
    return $output;
}
function has_repeated_patterns($string)
{
    $string = strtolower(preg_replace("/\s+/", "", $string));
    $length = strlen($string);
    for ($i = 1; $i <= $length / 2; $i++) {
        if ($length % $i == 0) {
            $pattern = substr($string, 0, $i);
            if (str_repeat($pattern, $length / $i) == $string) {
                return true;
            }
        }
    }
    return false;
}
class VIPHistory extends DatabaseConnection
{
    public function TongMuaGoi($condition)
    {
        $OoO = self::ThanhDieuDB()
            ->query("SELECT COUNT(*) AS total FROM `ws_plans` WHERE
            $condition");
        if ($OoO !== false && $OoO->num_rows > 0) {
            $row = $OoO->fetch_assoc();
            return $row["total"];
        } else {
            return 0;
        }
    }
    public function TongMuaHomNay()
    {
        $HomNay = date("Y-m-d");
        return $this->TongMuaGoi("DATE(ngaymua)='$HomNay'");
    }

    public function TongMuaHomQua()
    {
        $HomQua = date("Y-m-d", strtotime("-1 day"));
        return $this->TongMuaGoi("DATE(ngaymua)='$HomQua'");
    }

    public function TongMuaTuanNay()
    {
        $DauTuanNay = date("Y-m-d", strtotime("monday this week"));
        $CuoiTuanNay = date("Y-m-d", strtotime("sunday this week"));
        return $this->TongMuaGoi(
            "DATE(ngaymua) BETWEEN '$DauTuanNay' AND '$CuoiTuanNay'"
        );
    }

    public function TongMuaThangNay()
    {
        $DauThangNay = date("Y-m-01");
        $CuoiThangNay = date("Y-m-t");
        return $this->TongMuaGoi(
            "DATE(ngaymua) BETWEEN '$DauThangNay' AND '$CuoiThangNay'"
        );
    }
}

function remove_expired_alom($dir = "/function/obf-php/alom/download/")
{
    $files = glob($_SERVER["DOCUMENT_ROOT"].$dir."*");
    foreach ($files as $file) {
        if (is_file($file)) {
            $file_time = filemtime($file);
            if (time() - $file_time > 180) 
            {
                unlink($file);
            }
        }
    }
}
function ChargingCard5s(
    $telco,
    $code,
    $serial,
    $amount,
    $request_id,
    $partner_id,
    $sign,
    $command
) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://card5s.vn/chargingws/v2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            "telco" => $telco,
            "code" => $code,
            "serial" => $serial,
            "amount" => $amount,
            "request_id" => $request_id,
            "partner_id" => $partner_id,
            "sign" => $sign,
            "command" => $command,
        ]),
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    ]);
    $res = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($res, true);
    if (isset($data["status"])) {
        $status = $data["status"];
        if (in_array($status, [100, 400])) {
            return $data["message"];
        } else {
            return $status;
        }
    }
    return "Không thành công.";
}
// function Status($status)
// {
//     $msg=[
//         '1' => 'Thành công',
//         '2' => 'Thành công nhưng sai mệnh giá',
//         '3' => 'Thẻ lỗi',
//         '4' => 'Bảo trì',
//         '99' => 'Thẻ chờ xử lý',
//         '100' => 'Gửi thẻ thất bại',
//     ];
//     return $msg[$status] ?? 'Lỗi máy chủ';
// }
$loaithe = [
    "viettel" => "viettel",
    "vinaphone" => "vinaphone",
    "mobiphone" => "mobiphone",
    "vietnammobile" => "vietnammobile",
    "zing" => "zing",
    "gate" => "gate",
    "garena" => "garena",
    "vcoin" => "vcoin",
];
$menhgia = [
    "10.000" => 10000,
    "20.000" => 20000,
    "30.000" => 30000,
    "50.000" => 50000,
    "100.000" => 100000,
    "200.000" => 200000,
    "300.000" => 300000,
    "500.000" => 500000,
];
$thu = [
    1 => 'Thứ Hai',
    2 => 'Thứ Ba',
    3 => 'Thứ Tư',
    4 => 'Thứ Năm',
    5 => 'Thứ Sáu',
    6 => 'Thứ Bảy',
    7 => 'Chủ Nhật',
];
$fakebill = [
    [
        "name" => "Tạo Bill MBBank",
        "icon" => "/".__IMG__."/icon/bank/mbbank2.png",
        "stats" => "mb",
        "target" => "/fake-bill/mb-bank",
    ],
    [
        "name" => "Tạo Bill Vietcombank",
        "icon" => "/".__IMG__."/icon/bank/vietcombank.png",
        "stats" => "vcb",
        "target" => "/fake-bill/vietcombank",
    ],
    [
        "name" => "Tạo Bill Techcombank",
        "icon" => "/".__IMG__."/icon/bank/techcombank.png",
        "stats" => "tcb",
        "target" => "/fake-bill/techcombank",
    ],
    [
        "name" => "Tạo Bill ACB",
        "icon" => "/".__IMG__."/icon/bank/acb.png",
        "stats" => "acb",
        "target" => "/fake-bill/acb",
    ],
    [
        "name" => "Tạo Bill Vietinbank",
        "icon" => "/".__IMG__."/icon/bank/vietinbank.png",
        "stats" => "ctg",
        "target" => "/fake-bill/vietinbank",
    ],
    [
        "name" => "Tạo Bill MSB",
        "icon" => "/".__IMG__."/icon/bank/msb.png",
        "stats" => "msb",
        "target" => "/fake-bill/msb",
    ],
    [
        "name" => "Tạo Bill Agribank",
        "icon" => "/".__IMG__."/icon/bank/agribank.png",
        "stats" => "agribank",
        "target" => "/fake-bill/agribank",
    ],
    [
        "name" => "Tạo Bill Zalopay",
        "icon" => "/".__IMG__."/icon/bank/zalopay.png",
        "stats" => "zalopay",
        "target" => "/fake-bill/zalopay",
    ],
    [
        "name" => "Ngân Hàng Khác",
        "icon" => "https://www.freeiconspng.com/uploads/orange-circle-png-3.png",
        "stats" => "tpbank",
        "target" => "/fake-bill-chuyen-khoan",
    ],
];
$fakebillpriority = [
    [
        "name" => "MBBank Priority",
        "icon" => "https://www.mbageas.life/_next/image?url=https%3A%2F%2Fwww.mbageas.life%2Fuploads%2F6zHnGsBouH3nKWOpjq8ax%2F1598862795678_original.png&w=1920&q=100",
        "target" => "/fake-bill-chuyen-khoan/mb-bank-priority",
    ],
    [
        "name" => "Vietcombank Priority",
        "icon" => "/".__IMG__."/icon/bank/vietcombank.png",
        "target" => "/fake-bill-chuyen-khoan/vietcombank-priority",
    ],
    [
        "name" => "ACB Privilege",
        "icon" => "/".__IMG__."/icon/bank/acb.png",
        "target" => "/fake-bill-chuyen-khoan/acb-privilege",
    ],
    [
        
        "name" => "Ngân Hàng Khác",
        "icon" => "https://pngimg.com/d/circle_PNG47.png",
        "target" => "/fake-bill-priority",
    ],
];
$fakesodu = [
    [
        "name" => "MBBank",
        "icon" => "/".__IMG__."/icon/bank/mbbank2.png",
        "target" => "/fake-so-du/mb-bank",
    ],
    [
        "name" => "Vietcombank",
        "icon" => "/".__IMG__."/icon/bank/vietcombank.png",
        "target" => "/fake-so-du/vietcombank",
    ],
    [
        "name" => "Ví Momo",
        "icon" => "/".__IMG__."/icon/bank/momo.png",
        "target" => "/fake-so-du/momo",
    ],
    [
        "name" => "Ví Zalopay",
        "icon" => "/".__IMG__."/icon/bank/zalopay.png",
        "target" => "/fake-so-du/zalopay",
    ],
    [
        "name" => "ACB",
        "icon" => "/".__IMG__."/icon/bank/acb.png",
        "target" => "/fake-so-du/acb",
    ],
];

class Bill extends DatabaseConnection
{
    private $current_url;
    private $path = "/public/cache/bill/";
    protected $slugs = ["/fake-bill/mb-bank", "vietcombank", "/fake-bill/techcombank", "acb", "vp-bank", "momo", "msb", "bidv", "agribank", "/fake-bdsd/mb-bank", "/fake-so-du/mb-bank"];

    public function __construct($current_url)
    {
        $this->path = $_SERVER["DOCUMENT_ROOT"].$this->path;
        $this->current_url = $current_url;
    }
    /**
     * Demo Bill Bank / Xem Trước Ảnh
    */
    private $img = [
        "Bill-MbBank" => "https://thanhdieu.com/bill/mb.png",
        "Bill-MbBank-Tet" => "https://thanhdieu.com/bill/mb-tet.png",
        // "Bill-MbBank-Priority" => "https://thanhdieu.com/bill/mb-priority.jpg",
        "Bill-MbBank-DonLuu" => "https://thanhdieu.com/bill/mb-donluu.png",
        "Bill-Vietcombank" => "https://thanhdieu.com/bill/vcb.png",
        "Bill-Techcombank" => "https://thanhdieu.com/bill/tcb.png",
        "Bill-Vietinbank" => "https://thanhdieu.com/bill/vietinbank.png",
        "Bill-Acb" => "https://thanhdieu.com/bill/acb.png",
        "Bill-Momo-LienBank" => "https://thanhdieu.com/bill/momo-lienbank.png",
        "Bill-Zalopay" => "https://thanhdieu.com/bill/zalopay.png",
        "Bill-Msb" => "https://thanhdieu.com/bill/msb.png",
        "Bill-TPBank" => "https://thanhdieu.com/bill/tpbank.png",
        "Bill-BIDV" => "https://thanhdieu.com/bill/bidv.jpeg",
        "Bill-Agribank" => "https://thanhdieu.com/bill/agribank.png",
        "Bill-VPBank" => "https://thanhdieu.com/bill/vpbank.png",
        "Bill-Sell-Binance" => "https://thanhdieu.com/bill/sell-binance.png",
        "Bill-ManHinhKhoa-MbBank" => "https://thanhdieu.com/bill/mb-manhinhkhoa.png",
        "Sodu-Vietinbank" => "https://thanhdieu.com/bill/sodu-vietinbank.png",
        "Sodu-Momo" => "https://thanhdieu.com/bill/sodu-momo.png",
        "Sodu-Zalopay" => "https://thanhdieu.com/bill/sodu-zalopay.png",
        "Sodu-Acb" => "https://thanhdieu.com/bill/sodu-acb.png",
        "Sodu-MbBank" => "https://thanhdieu.com/bill/sodu-mb.png",
        "BDSD-MbBank" => "https://thanhdieu.com/bill/bdsd-mb.png",
        "BDSD-Techcombank" => "https://thanhdieu.com/bill/bdsd-tcb.png",
        "CCCD-MatTruoc" => "https://i.imgur.com/mHtMvOP.jpeg",
        "CCCD-QRCode" => "https://i.imgur.com/8MixDEH.png",
    ];

    /**
     * Method Demo
     *
     * @param $slugs $slugs
     *
     * @return mixed
     */
    public function Demo($slugs)
    {
        if (array_key_exists($slugs, $this->img)) 
        {
            return '<img src="/' .
            __IMG__ .
            '/main/thumbnail-bill.jpg" data-src="' .
            $this->img[$slugs].'?v='.rand(1,9999).
                '" alt="' .
                $slugs .
                '" class="h-full w-full object-cover object-center lazyload"/>';
        } else {
        //     return '<img src="/'.__IMG__ .
        //         '/main/thumbnail-bill.jpg" data-src="/' .
        //         __IMG__ .
        //         '/main/demo-default.png" alt="' .
        //         $slugs .
        //         '" class="h-full w-full object-cover object-center lazyload"/>';
        // }
        return '<img src="/' .
        __IMG__ .
        '/main/thumbnail-bill.jpg" data-src="'.$slugs.'?v='.rand(1,9999).
            '" alt="Fake Bill Lavender" class="h-full w-full object-cover object-center lazyload"/>';
        }
    }

    /**
     * Method setting
     *
     * @param $exclude $exclude
     *
     * @return string
     */
    public function setting($exclude = null)
    {
        $slug = $exclude
        ? array_filter($this->slugs, fn($slugs) => $slugs !== $exclude)
        : $this->slugs;
        return (bool) array_filter(
            $slug,
            fn($slugs) => strpos($this->current_url, $slugs) !== false
        );
    }
    /**
     * Method fakebill
     *
     * @return void
     */

    public function fakebill()
    {
        global $TD;
        $t = date(
            "Y-m-d H:i:s",
            strtotime("-".$TD->Setting("auto-delete")." days")
        );
        $vtd = self::ThanhDieuDB()->prepare(
            "SELECT fakebill_id, `image` FROM ws_history_fakebill WHERE `time` < ?"
        );
        $vtd->bind_param("s", $t);
        $vtd->execute();
        $result = $vtd->get_result();
        while ($row = $result->fetch_assoc()) {
            $this->delete($row["fakebill_id"], $row["image"]);
        }
    }

    /**
     * Method delete_img
     *
     * @param $fakebillId $fakebillId
     * @param $imageName $imageName
     *
     * @return void
     */

    private function delete($fakebillId, $imageName)
    {
        $imagePath = $this->path.$imageName;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $delete = self::ThanhDieuDB()->prepare(
            "DELETE FROM ws_history_fakebill WHERE fakebill_id=?"
        );
        $delete->bind_param("i", $fakebillId);
        $delete->execute();
    }
    /**
     * Method check_image
     *
     * @return void
     */
    public function check()
    {
        $vtd = self::ThanhDieuDB()->prepare(
            "SELECT `image` FROM ws_history_fakebill"
        );
        $vtd->execute();
        $result = $vtd->get_result();
        $imagesInDb = [];
        while ($row = $result->fetch_assoc()) {
            $imagesInDb[] = $row["image"];
        }
        $allImages = scandir($this->path);
        $allImages = array_diff($allImages, [".", ".."]);
        foreach ($allImages as $imageFile) {
            if (!in_array($imageFile, $imagesInDb)) {
                $filePath = $this->path.$imageFile;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }
    /**
     * Method save
     *
     * @param $base64
     * @param $dir
     *
     * @return string
     */
    public function save($base64, $dir)
    {
        if (strpos($base64, "base64,") === false) {
            throw new Exception("Error 0x000001");
        }
        $data = substr($base64, strpos($base64, ",") + 1);
        $data = base64_decode($data);
        $image = imagecreatefromstring($data);
        if ($image === false) {
            throw new Exception("Error 0x000002");
        }
        $name_img = md5(rand(1000, 9999)).".jpg";
        $tar_file = $dir.$name_img;
        if (imagejpeg($image, $tar_file, 100)) {
            imagedestroy($image);
            return $name_img;
        } else {
            throw new Exception("Không thể lưu ảnh.");
        }
    }
    public function totalCreated($params) 
{
    if (!is_array($params) || empty($params)) {
        throw new InvalidArgumentException("Empty array.");
    }

    $db = self::ThanhDieuDB();
    $conditions = implode(" AND ", array_map(function ($column) use ($db) {
        return "`" . $db->real_escape_string($column) . "` = ?";
    }, array_keys($params)));

    $sql = "SELECT COUNT(*) as total FROM ws_history_fakebill WHERE $conditions";
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        throw new RuntimeException("Prepare failed: " . $db->error);
    }

    $values = array_values($params);
    $types = str_repeat("s", count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        return (int) $row['total'];
    }
    return 0;
}
}

function TDSideBarSetting($url)
{
    global $current_url;
    return basename($current_url) === $url ? "active" : "";
}
class BackupRemove
{
    private $dir = "/public/cache/backup/";
    public function __construct()
    {
        $this->dir = $_SERVER["DOCUMENT_ROOT"].$this->dir;
    }
    public function RemoveBackup($Minutes = 2)
    {
        $max_time = time() - $Minutes * 60;
        $files = glob($this->dir."/*");
        foreach ($files as $file) {
            if (filemtime($file) < $max_time) 
            {
                unlink($file);
            }
        }
    }
}
require __DIR__."/obj.php";
class ThanhDieuOP extends DatabaseConnection
{
    public function cleanup()
    {
        $a = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/uploads/t/';
        $f = glob($a . '*');
        $u = [];
        $td = self::ThanhDieuDB()->query("SELECT hinhthunho FROM ws_products");
        if ($td) {
            while ($w1 = $td->fetch_assoc()) {
                $t = $w1['hinhthunho'];
                if (!empty($t)) {
                    $n = basename($t);
                    if (strpos($n, 'thumbnail_') === 0) {
                        $u[$n] = true;
                    }
                }
            }
        }
        $hk = self::ThanhDieuDB()->query("SELECT noidung FROM ws_products");
        if ($hk) {
            while ($w2 = $hk->fetch_assoc()) {
                $c = $w2['noidung'];
                preg_match_all('/<img[^>]+src="[^"]*\/san-pham\/([^\/"]+)"/i', $c, $matches);
                foreach ($matches[1] as $img) {
                    if (strpos($img, 'main_') === 0) {
                        if (file_exists($a . $img)) {
                            $u[$img] = true;
                        }
                    }
                }
            }
        }
        foreach ($f as $b) {
            $n = basename($b);
            if ((strpos($n, 'thumbnail_') === 0 || strpos($n, 'main_') === 0) && !isset($u[$n])) {
                unlink($b);
            }
        }
    }
}
class ThanhDieuOP__ extends DatabaseConnection
{
    public function cleanup()
    {
        $a = glob($_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/uploads/t/'.'*');
        $d = self::ThanhDieuDB()->prepare("SELECT anhsanpham FROM ws_products");
        $d->execute();
        $o = $d->get_result();
        $d->close();
        $t = [];
        while ($m = $o->fetch_assoc()) {
            $c = explode('|', $m['anhsanpham'] ?? '');
            foreach ($c as $i) {
                $t[] = basename(trim($i));
            }
        }
        foreach ($a as $b) {
            $n = basename($b);
            if (!$this->e($n) && !in_array($n, $t)) {
                unlink($b);
            }
        }
    }
    private function e($n)
    {
        return (strpos(basename($n), 'main_') === 0 || strpos(basename($n), 'thumbnail_') === 0);
       }
}
function ClearIMGProduct() {(new ThanhDieuOP())->cleanup();(new ThanhDieuOP__())->cleanup();}