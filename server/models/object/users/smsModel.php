<?php
if (!class_exists('DatabaseConnection')) {header('location: /');exit;}
if (isset($_POST['action']) && $_POST['action'] === 'thanhdieu-attack-sms') 
{
    $sdt = $_POST['sdt'];
    $spamsms_id = $_POST['spamsms_id'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://'.$domain.'/call-back/api/spam-sms?sdt='.urlencode($sdt));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "X-WusTeam: 2bac6acbcd29-020f-4cee-ae0d-7ad267d1aa86"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        $update = $thanhdieudb->prepare("UPDATE ws_spamsms SET trangthai = 'fail' WHERE spamsms_id = ?");
        $update->bind_param("i", $spamsms_id);
        $update->execute();
        $update->close();
    }
}