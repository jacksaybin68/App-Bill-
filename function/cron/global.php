<?php
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
header('Content-type: application/json');
function PlanExpired() 
{
    return null;
}

try 
{
    curl('https://'.$domain.'/function/call-back/api/auto-bank.php');
    PlanExpired();
    echo JSON_FORMATTER([
        'cron-job' => [
        'status' => 200,
        'msg'=> 'service it worked.',
        'version'=> $TD->Setting('version-code'),
    ]]);
    
} catch (Exception $e) 
{
    echo 'Lỗi: '.$e->getMessage();
}
