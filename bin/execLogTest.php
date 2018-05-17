<?php

require '/var/www/html/lib/libConstant.php';
require PATH_BASE . '/lib/libDB.php';
require PATH_BASE . '/lib/libBackup.php';

$idserver = "16";
$idwork = "99";
$messageBegin = "Error message test";
$code = "1";
insertLog($idserver, $idwork, $messageBegin, $code);
?>