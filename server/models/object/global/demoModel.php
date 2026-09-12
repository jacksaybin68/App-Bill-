<?php
header('Content-Type: application/json');
if (isset($_POST['action']) && $_POST['action'] === 'call-demo') {
    die(json_encode((new CallDemo())->Demo($_POST['demoName'])));
}