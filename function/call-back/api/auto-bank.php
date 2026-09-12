<?php
/**
 * Kết Nối CSDL
 */
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');

/**
*+----------------------------------------------------------------------
*|  __        __        _____                    
*| \ \      / /   _ __|_   _|__  __ _ _ __ ___  
*|  \ \ /\ / / | | / __|| |/ _ \/ _` | '_ ` _ \ 
*|   \ V  V /| |_| \__ \| |  __/ (_| | | | | | |  -- V5.0.3
*|    \_/\_/  \__,_|___/|_|\___|\__,_|_| |_| |_| 
*|                                            
*+----------------------------------------------------------------------
*| Author: ThanhDieu
*+----------------------------------------------------------------------
*| Tinh chỉnh bởi BILLVIET - sử dụng API SCPAYMENT
*| ACB-VPBANK AUTOBANK GATEWAY
*| Nếu đấu qua api bên nguồn khác, vui lòng edit các params theo nguồn đó
*| Php autobank yêu cầu phiên bản php 8.0 trở lên, nếu thấp hơn sẽ không hoạt động
*+----------------------------------------------------------------------
 */
header('Content-Type: application/json');
class AutoBank extends DatabaseConnection
{
    private $TD;
    private $time;
    
   /**
     * Initialize AutoBank instance
     *
     * @param $TD [settings object]
     * @param $time [datetime for operations]
     *
     * @return void
     */
    public function __construct($TD, $time) 
    {
        $this->TD = $TD; // - assign configuration
        $this->time = $time; // - assign current time (datetime)
    }
    
    /**
    * Process auto bank transfers and execute callback
    *
    * @param array $wusteam [List of bank accounts for processing]
    *
    */
    public function execute($wusteam)
    {
        global $domain;
        $bank = $wusteam;
        $wt = self::ThanhDieuDB()->query("SELECT * FROM ws_transfer WHERE kieubank = 'tudong'");
    
        while ($w = $wt->fetch_assoc()) 
        {
            $nganhang = $w['nganhang'];
            $callback = $w['callback'];
            if (valid_url($callback)) 
            {
                $bank[] = $callback; // - add api endpoint to array
                $nh[]   = $nganhang; // - add tennganhang to array
            }
        }
    
        if (empty($bank)) 
        {
            return $this->res(-1, 'chưa cấu hình auto bank.');
        }
    
        $a = $this->callback($bank);
    
        foreach ($a as $b)
         {
            if ($b == 0) 
            {
                $status = 0; 
            } 
            else 
            {
                $status = 1;
                $data   = json_decode($b, true); // - decode data
    
                if (isset($data['status']) && $data['status'] === 'success') 
                {
                    foreach ($data['transactions'] as $transaction) 
                    {
                        if ($transaction['type'] === 'IN') 
                        {
                            $this->handle($transaction, $domain); // - process data
                        }
                    }
                } 
                elseif (isset($data['status']) && $data['status'] === 'error') 
                {           
                    return $this->res(-3, $data['msg'] ?? 'Unknown error from callback api: '.$nganhang); // - return error reason from api (sieuthicode)
                }
            }
        }
        return $status == 1
            ? $this->res(200, 'callback is working: ('.implode(' | ', $nh).')') // - success
            : $this->res(-2, 'callback is not working'); // - failure
    }
    
    /**
    * Execute multiple cURL requests concurrently
     *
    * @param array $urls [List of URLs for the requests]
    *
    * @return array [Array of responses keyed by URL]
    */

    private function callback(array $urls) 
    {
        $a = curl_multi_init(); // @ thread curl
        $b = [];
        $c = [];
        foreach ($urls as $url) 
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $b[$url] = $ch;
            curl_multi_add_handle($a, $ch);
        }
    
        $running = null;

        do 
        {
            curl_multi_exec($a, $running);
            curl_multi_select($a);
        } while ($running > 0);
    
        foreach ($b as $url => $ch) 
        {
            $c[$url] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($a, $ch);
            curl_close($ch);
        }
    
        curl_multi_close($a);
        return $c;
    }

    /**
     * Handle transaction processing
     *
     * @param array $transaction [transaction details]
     * @param string $cuphap [Deposit syntax]
     * @param string $noidungnap [Deposit content]
     * @param int $userId [User ID]
     * @param string $client [Client account name]
     * @param float $transaction['amount'] [Deposit amount]
     * @param string $transaction['transactionID'] [Transaction ID]
     * @param string $transaction['bank'] [Depositing bank]
     *
     * @return void
     */
    private function handle($transaction,$domain)
     {
        $cuphap     = strtolower($this->TD->Setting('cuphap-naptien'));
        $noidungnap = preg_replace('/\s+/', ' ', trim($transaction['description']));
        
        if (preg_match('/'.preg_quote($cuphap, '/').'(\d+)/i', $noidungnap, $uid)) // - filter noidungnap
        {
            $userId = $uid[1];
            $client = $this->getuser($userId);
            if ($client) 
            {
                $a = $this->get_time_desc($noidungnap);
                $b = date('Y-m-d').' '.$a;
                $c = strtotime($b);
                $d = strtotime($this->time) - $c;
                if ($d <= WsRandomString::Number(10)) 
                { 
                 $bankName = $transaction['bank'] ?? 'unknown';
                $this->congtien($client, KhuyenMai($transaction['amount']), $transaction['transactionID'], $bankName, 'https://'.$domain.'/call-back/api/n');
                } else 
                {
                    exit($this->res(-1, 'unable to add funds.'));
                }
            }
        }
    }
    
    /**
     * Get username by user ID
     *
     * @param int $userId [User ID]
     *
     * @return string|null [Username or null if not found]
     */
    private function getuser($userId)
    {
        $o = self::ThanhDieuDB()->query("SELECT username FROM users WHERE user_id = '{$userId}'");
        if ($o && $w = $o->fetch_assoc()) 
        {
            return $w['username'];
        }
        return null;
    }
    
    /**
    * Process deposit transaction
    *
    * @param string $username [Account name]
    * @param float $amount [Deposit amount]
    * @param string $transactionID [Transaction ID]
    * @param string $bank [Receiving bank]
    * @param string $notice [Callback URL for notification]
    * 
    * @return void
    */
    private function congtien($username, $amount, $transactionID, $bank, $notice) 
    {
        if (self::ThanhDieuDB()->query("SELECT * FROM ws_history_bank WHERE magiaodich = '{$transactionID}'")->num_rows > 0) 
        {
            return;
        } else if ($amount < $this->TD->Setting('min-nap')) 
        {
            self::ThanhDieuDB()->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Số tiền nạp dưới mức nạp tối thiểu', '{$this->time}', 'thatbai')");
            return;
        }
        if (curl($notice)) {
        self::ThanhDieuDB()->query("UPDATE users SET sodu = sodu + {$amount}, tongnap = tongnap + {$amount} WHERE username = '{$username}'");
        self::ThanhDieuDB()->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Nạp tiền vào tài khoản', '{$this->time}', 'thanhcong')");
        self::ThanhDieuDB()->query("INSERT INTO ws_logs (username, content, time, action) VALUES ('{$username}', 'nạp tiền tự động $bank - Số tiền: ".FormatNumber::TD($amount, 2)."đ', '{$this->time}', 'Nạp Tiền')");
        }
    }
    
    /**
    * Extract time from description
    *
    * @param string $description [Description string]
    *
     * @return string [Extracted time or default '00:00:00']
    */

    private function get_time_desc($description) // - acb bank get time
    {
        if (preg_match('/(\d{2}:\d{2}:\d{2})/', $description, $matches)) 
        {
            return $matches[1];
        }
        return '00:00:00'; 
    }
    
    /**
    * Return response format
    *
    * @param int $code [Response code]
    * @param string $msg [Response message]
    *
    * @return array [Response with status, message, and version]
    */

    private function res($code, $msg) 
    {
        return [
            'status' => $code,
            'msg' => $msg,
            'version' => $this->TD->Setting('version-code') // - Version Lavender Fakebill
        ];
    }
}

$action = new AutoBank($TD, $time);
// $callback = $TD->Setting('api-bank');
echo JSON_FORMATTER(['auto-bank' => $action->execute([])]);