<?php
/**
 * Kết Nối CSDL
 */
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/AutoBankGateway.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/CallbackAuth.php';

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

CallbackAuth::validate();

$time = date('Y-m-d H:i:s');
$action = new AutoBankGateway($TD, $time);
echo JSON_FORMATTER(['auto-bank' => $action->execute([])]);
