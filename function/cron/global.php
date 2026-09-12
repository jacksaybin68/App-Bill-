<?php
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/AutoBankGateway.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/CallbackAuth.php';

header('Content-type: application/json');

CallbackAuth::validate();

$time = date('Y-m-d H:i:s');
try {
    $gateway = new AutoBankGateway($TD, $time);
    $result = $gateway->execute([]);

    echo JSON_FORMATTER([
        'cron-job' => [
            'status' => 200,
            'msg' => 'service it worked.',
            'data' => $result
        ]
    ]);
} catch (Exception $e) {
    echo JSON_FORMATTER([
        'cron-job' => [
            'status' => -1,
            'msg' => 'Service error: ' . $e->getMessage()
        ]
    ]);
}
