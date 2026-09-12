<?php
$DynamicsIsland = (!empty($_POST['control-dynamic']) && in_array(strval($_POST['control-dynamic']), ['on', '1'], true)) ? ($_POST['dynamics'] ?? '') : '';
$vachsong = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/networks/dark/nw-'.($_POST["vachsong"] ?? null).'.png';
$iconTinHieu = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/networks/dark/'.($_POST["tin-hieu"] ?? null).'.png';
$iconPins = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/phoi/'.((isset($_POST['percent-pin']) && $_POST['percent-pin'] === 'on') ? 'battery-x' : 'battery-z').'/dark/'.$_POST['pin'].'.png';
$iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'].'/'. __IMG__.'/phoi/dynamics/'.$DynamicsIsland.'.png';
require $_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/bill-settings/main.php';