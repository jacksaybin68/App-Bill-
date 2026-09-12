<?php
class BankDepositService extends DatabaseConnection
{
    private $TD;
    private $time;

    public function __construct($TD, $time)
    {
        $this->TD = $TD;
        $this->time = $time;
    }

    public function processDeposit(string $username, int $amount, string $transactionID, string $bankName): array
    {
        $amount = (int)$amount;

        if ($amount <= 0 || $amount > 2000000000) {
            return ['status' => -1, 'msg' => 'Số tiền không hợp lệ'];
        }

        if ($amount < (int)$this->TD->Setting('min-nap')) {
            $this->insertHistory($username, $transactionID, $amount, $bankName, 'thatbai', 'Số tiền nạp dưới mức nạp tối thiểu');
            return ['status' => -1, 'msg' => 'Số tiền nạp dưới mức nạp tối thiểu'];
        }

        $conn = self::ThanhDieuDB();
        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare(
                "INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai, bank_name) VALUES (?, 'Nạp Tự Động', ?, ?, 'Nạp tiền vào tài khoản', ?, 'thanhcong', ?)"
            );
            $stmt->bind_param('ssiss', $username, $transactionID, $amount, $this->time, $bankName);
            $stmt->execute();
            $stmt->close();

            $this->updateUserBalance($username, $amount);
            $this->insertLog($username, $amount, $bankName);

            $conn->commit();
            return ['status' => 200, 'msg' => 'Nạp tiền thành công'];
        } catch (mysqli_sql_exception $e) {
            $conn->rollback();
            if ($e->getCode() == 1062) {
                return ['status' => 200, 'msg' => 'Giao dịch đã được xử lý trước đó'];
            }
            return ['status' => -1, 'msg' => 'Lỗi xử lý giao dịch'];
        }
    }

    private function insertHistory(string $username, string $transactionID, int $amount, string $bankName, string $status, string $content): void
    {
        $conn = self::ThanhDieuDB();
        $stmt = $conn->prepare(
            "INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai, bank_name) VALUES (?, 'Nạp Tự Động', ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssissss', $username, $transactionID, $amount, $content, $this->time, $status, $bankName);
        $stmt->execute();
    }

    private function updateUserBalance(string $username, int $amount): void
    {
        $conn = self::ThanhDieuDB();
        $stmt = $conn->prepare(
            "UPDATE users SET sodu = sodu + ?, tongnap = tongnap + ? WHERE username = ?"
        );
        $stmt->bind_param('iis', $amount, $amount, $username);
        $stmt->execute();
    }

    private function insertLog(string $username, int $amount, string $bankName): void
    {
        $conn = self::ThanhDieuDB();
        $content = 'nạp tiền tự động ' . $bankName . ' - Số tiền: ' . FormatNumber::TD($amount, 2) . 'đ';
        $stmt = $conn->prepare(
            "INSERT INTO ws_logs (username, content, time, action) VALUES (?, ?, ?, 'Nạp Tiền')"
        );
        $stmt->bind_param('sss', $username, $content, $this->time);
        $stmt->execute();
    }

    public function validateTimeWindow(string $transactionTimeDesc): bool
    {
        $b = date('Y-m-d') . ' ' . $transactionTimeDesc;
        $c = strtotime($b);
        $d = strtotime($this->time) - $c;

        if ($d < 0) {
            $d = $d + 86400;
        }

        return abs($d) <= 900;
    }
}
