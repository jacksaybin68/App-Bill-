<?php
if (!class_exists('DatabaseConnection')) 
{
    header('Location: /');
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'thanhdieu-attack-ngl') 
{
    $target = $_POST['target'];
    $server = $_POST['server'];
    $question = $_POST['question'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://'.$domain.'/call-back/api/spam-ngl'.'?target='.urlencode($target).'&question='.urlencode($question).'&server='.urlencode($server));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        exit(JSON_FORMATTER(['status' => 400, 'msg' => 'Lỗi: ' . curl_error($ch)]));
    }
    $data = json_decode($response, true);
}