<?php

require '/var/www/html/lib/libConstant.php';
require PATH_BASE.'/lib/libDB.php';
require PATH_BASE.'/lib/libBackup.php';

    $backuppath=PATH_LOCAL;
    $stagingpath=PATH_STAGING;
    
    $retention=getLogRetention();
    $rsSelectLogRetention=selectLogRetention($retention);
    
    foreach ($rsSelectLogRetention as $row) 
        { 
        removeLog($row[0]);        
        }
?>