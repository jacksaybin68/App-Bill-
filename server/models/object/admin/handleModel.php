<?php
/**
 * @author Vương Thanh Diệu
 */
if (!class_exists('DatabaseConnection')){header('location: /');}
class Authentication extends DatabaseConnection 
{    
    /**
     * Method Admin
     *
     * @param $taikhoan $taikhoan [users/username]
     *
     * @return void
     */
    public function Admin($taikhoan) 
    {
        global $wtSecurity;
        if (isset($_COOKIE['ssk'])) 
        {
            if ($wtSecurity->decrypt($_COOKIE['ssk'])) 
            {
                $user = $this->Administrator($taikhoan);
                if ($user !== null && isset($user['rank']) && (THANHDIEU($user['rank']) !== 'admin' && THANHDIEU($user['rank']) !== 'partner')) 
                {
                    $this->___Logout("/");
                }
                if (isset($user['banned']) && THANHDIEU($user['banned']) == 1) 
                {
                    $this->___Login("/~/#server-404");
                }
            } else {
                $this->___Login("/~/#server-404");
            }
        } else {
            $this->___Login("/~/#server-404");
        }
    }
        
    /**
     * Method Administrator
     * @param $taikhoan $taikhoan [users/username]
     */
    private function Administrator($taikhoan) 
    {
        return self::ThanhDieuDB()->query("SELECT * FROM `users` WHERE `username`='$taikhoan'")->fetch_assoc();
    }
    
    /**
     * Method ___Logout
     *
     * @param $redirect $redirect [chuyen huong]
     *
     * @return void
     */
    private function ___Logout($redirect) 
    {
        setcookie('ssk', '', time() - WsRandomString::Number(8), "/", "", true, true);
        $this->___Login($redirect);
    }

    private function ___Login($redirect) 
    {
        header("Location: $redirect");
        exit;
    }
}
/**
 * WSTitle
 */
class WSTitle 
{
    private $current_url;
    private $titles = 
    [
        'dashboard' => 'Dashboard',
        'analytics' => 'Dữ Liệu Thống Kê',
        'card' => 'Lịch Sử Nạp Thẻ Cào',
        'bank' => 'Lịch Sử Nạp Ngân Hàng',
        'payment' => 'Cài Đặt Nạp Tiền',
        'banned' => 'Thành Viên Bị Cấm',
        'logs' => 'Hoạt Động Gần Đây',
        'log' => 'Nhật Ký Hoạt Động',
        'cron-jobs' => 'Tác Vụ Cron Jobs',
        'tutorial-of-admin' => 'Hướng Dẫn Cho Admin',
    ];    
    /**
     * Method __construct
     *
     * @param $current_url [global variable]
     *
     * @return void
     */
    public function __construct($current_url) 
    {
        $this->current_url = $current_url;
    }
    public function v3() 
    {
        $parse_url = trim(parse_url($this->current_url,PHP_URL_PATH),'/');
        if(strpos($parse_url,'users/list')!==false)return'Danh Sách Thành Viên';    
        if(strpos($parse_url,'create/newfeeds')!==false)return'Đăng Bảng Tin Mới'; 
        if(strpos($parse_url,'newfeeds/list')!==false)return'Danh Sách Bảng Tin'; 
        if(strpos($parse_url,'manager/plan')!==false)return'Tạo - Sửa Gói';     
        if(strpos($parse_url,'history/plan')!==false)return'Lịch Sử Mua Gói';   
        if(strpos($parse_url,'history/bill')!==false)return'Lịch Sử Tạo Bill';                                                                                                   
        if(strpos($parse_url,'settings')!== false)return'Cài Đặt Hệ Thống';
        if(strpos($parse_url,'edit/')!==false)return'Chỉnh Sửa Thành Viên';   
        if(strpos($parse_url,'handle/ctv')!==false)return'Xử Lý Đơn Cộng Tác Viên';   
        if(strpos($parse_url,'create/product')!==false)return'Đăng Đơn Hàng Mới';  
        if(strpos($parse_url,'product/list')!==false)return'Danh Sách Đơn Hàng';  
        return $this->titles[pathinfo(basename($parse_url),PATHINFO_FILENAME)]??'Trang Quản Trị';
    }
}
/**
 * AdminResource
 */
class AdminResource 
{  
  /**
   * Method Path
   *
   * @return
   */
  public function Path() 
  {
      return '/admin';
  }
}
/**
 * Method BankList
 */
function BankList()  
{
    $file_db = __DIR__ . '/list.bank.db';
    $auto_update = 14 * 24 * 60 * 60; 
    if (file_exists($file_db)) 
    {
        $last_modified = filemtime($file_db);
        if (time() - $last_modified < $auto_update) 
        {
            $data = file_get_contents($file_db);
            $json_data = json_decode($data, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($json_data['data'])) 
            {
                return $json_data['data'];
            } else {
                return "Data unsupported";
            }
        }
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.viqr.net/list-banks/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);

    if (is_null($data) || !isset($data['data'])) 
    {
        return [];
    }
    file_put_contents($file_db, $res);
    return $data['data'];
}
$ThongKeTaoBill = 
[
    [
        'title' => 'Hôm Nay',
        'desc' => 'Tổng lượt mua gói trong ngày hôm nay.',
        'class' => 'bg-primary',
        'tongmua' => $history_goivip->TongMuaHomNay() ?? 0,
    ],
    [
        'title' => 'Hôm Qua',
        'desc' => 'Tổng lượt mua gói trong ngày hôm qua.',
        'class' => 'bg-warning',
        'tongmua' => $history_goivip->TongMuaHomQua() ?? 0,
    ],
    [
        'title' => 'Tuần Này',
        'desc' => 'Tổng lượt mua gói trong tuần này.',
        'class' => 'bg-success',
        'tongmua' => $history_goivip->TongMuaTuanNay() ?? 0,
    ],
    [
        'title' => 'Tháng Này',
        'desc' => 'Tổng lượt mua gói trong tháng này.',
        'class' => 'bg-danger',
        'tongmua' => $history_goivip->TongMuaThangNay() ?? 0,
    ],
];
$banks = BankList();
$title = new WSTitle($current_url);
$admin = new AdminResource();
$authentication = new Authentication();
$authentication->Admin($taikhoan);