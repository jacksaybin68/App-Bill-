<?php
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
class UserBillInfo extends DatabaseConnection
{
    private $user;
    private $plans;
    private $freebill;
    private $TD;
    private $taikhoan;

    public function __construct($user, $plans, $freebill, $TD, $taikhoan)
    {
        $this->user = $user;
        $this->plans = $plans;
        $this->freebill = $freebill;
        $this->TD = $TD;
        $this->taikhoan = $taikhoan;
    }

    private function getPlanDetails() {
        if (isset($this->user, $this->taikhoan) && $this->plans->TD('tengoi', $this->taikhoan)) {
            return [
                "namePlan" => strtoupper($this->plans->TD('tengoi', $this->taikhoan)),
                "limitBill" => ($this->plans->TD('gioihanbill', $this->taikhoan) ?? 0) > 1999 ? "∞" : $this->plans->TD('gioihanbill', $this->taikhoan),
                "leftBill" => max(0, $this->plans->ConLaiLanTao($this->taikhoan)) > 1999 ? "∞" : max(0, $this->plans->ConLaiLanTao($this->taikhoan)),
                "leftTime" => $this->plans->TD('ngayhethan', $this->taikhoan) > 3650 ? "Vĩnh viễn" : $this->plans->TD('ngayhethan', $this->taikhoan),
                "paymentDate" => $this->plans->TD('ngaymua', $this->taikhoan),
                "lastUpdate" => self::CurrentTime()
            ];
        }
        return null;
    }    
    public function getFreeBillDetails()
    {
        $limitBill = $this->TD->Setting('limit-bill');
        return [
            "namePlan" => "Miễn phí",
            "limitBill" => $limitBill,
            "leftBill" => ($this->freebill->checked($this->taikhoan, $limitBill)) ? $limitBill : 0,
            "leftTime" => null,
            "paymentDate" => null,
            "planNone" => 'free',
            "lastUpdate" => self::CurrentTime()
        ];
    }

    private function getAdminDetails()
    {
        return [
            "namePlan" => "∞",
            "limitBill" => "∞",
            "leftBill" => "∞",
            "leftTime" => "∞",
            "paymentDate" => "∞",
            "lastUpdate" => self::CurrentTime()
        ];
    }

    public function getUserBillInfo()
    {
        if (isset($this->user)) {
            if ($this->user['rank'] !== 'admin' && $this->user['rank'] !== 'leader') 
            {
                $planDetails = $this->getPlanDetails();
                if ($planDetails) {
                    return $planDetails;
                } else {
                    return $this->getFreeBillDetails();
                }
            } elseif ($this->user['rank'] === 'admin' || $this->user['rank'] === 'leader') 
            {
                return $this->getAdminDetails();
            }
        } else {
            return $this->getFreeBillDetails();
        }
    }
}

$data = new UserBillInfo($user, $plans, $freebill, $TD, $taikhoan);
$BillInfo = $data->getUserBillInfo();
if ($BillInfo) 
{
    echo "data: ".json_encode(['user-ini' => $BillInfo])."\n\n";
} else {
    echo "data: ".json_encode(['user-ini' => $data->getFreeBillDetails()])."\n\n";
}
flush();
