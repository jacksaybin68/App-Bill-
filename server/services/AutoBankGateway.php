<?php
require_once __DIR__ . '/BankDepositService.php';

class AutoBankGateway extends DatabaseConnection
{
    private $TD;
    private $time;
    private $depositService;

    public function __construct($TD, $time)
    {
        $this->TD = $TD;
        $this->time = $time;
        $this->depositService = new BankDepositService($TD, $time);
    }

    public function execute(array $wusteam): array
    {
        $bank = $wusteam;
        $wt = self::ThanhDieuDB()->query("SELECT * FROM ws_transfer WHERE kieubank = 'tudong'");
        $nh = [];

        while ($w = $wt->fetch_assoc()) {
            $nganhang = $w['nganhang'];
            $callback = $w['callback'];
            if (valid_url($callback)) {
                $bank[] = $callback;
                $nh[] = $nganhang;
            }
        }

        if (empty($bank)) {
            return ['status' => -1, 'msg' => 'chưa cấu hình auto bank.'];
        }

        $a = $this->callback($bank);
        $status = 0;

        foreach ($a as $b) {
            if ($b == 0) {
                $status = 0;
            } else {
                $status = 1;
                $data = json_decode($b, true);

                if (isset($data['status']) && $data['status'] === 'success') {
                    foreach ($data['transactions'] as $transaction) {
                        if ($transaction['type'] === 'IN') {
                            $this->handle($transaction);
                        }
                    }
                } elseif (isset($data['status']) && $data['status'] === 'error') {
                    return ['status' => -3, 'msg' => $data['msg'] ?? 'Unknown error from callback api'];
                }
            }
        }

        return $status == 1
            ? ['status' => 200, 'msg' => 'callback is working: (' . implode(' | ', $nh) . ')']
            : ['status' => -2, 'msg' => 'callback is not working'];
    }

    private function callback(array $urls): array
    {
        $mh = curl_multi_init();
        $handles = [];
        $results = [];

        foreach ($urls as $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $handles[$url] = $ch;
            curl_multi_add_handle($mh, $ch);
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);

        foreach ($handles as $url => $ch) {
            $results[$url] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
        }

        curl_multi_close($mh);
        return $results;
    }

    private function handle(array $transaction): void
    {
        $cuphap = strtolower($this->TD->Setting('cuphap-naptien'));
        $noidungnap = preg_replace('/\s+/', ' ', trim($transaction['description']));

        if (preg_match('/' . preg_quote($cuphap, '/') . '(\d+)/i', $noidungnap, $uid)) {
            $userId = $uid[1];
            $client = $this->getuser($userId);
            if ($client) {
                $a = $this->get_time_desc($noidungnap);
                if ($this->depositService->validateTimeWindow($a)) {
                    $bankName = $transaction['bank'] ?? 'unknown';
                    $amount = (int)$transaction['amount'];
                    $transactionID = $transaction['transactionID'];

                    $this->depositService->processDeposit($client, $amount, $transactionID, $bankName);
                }
            }
        }
    }

    private function getuser(int $userId): ?string
    {
        $conn = self::ThanhDieuDB();
        $stmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $w = $result->fetch_assoc()) {
            return $w['username'];
        }
        return null;
    }

    private function get_time_desc(string $description): string
    {
        if (preg_match('/(\d{2}:\d{2}:\d{2})/', $description, $matches)) {
            return $matches[1];
        }
        return '00:00:00';
    }
}
