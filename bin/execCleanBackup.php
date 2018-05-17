<?php

require '/var/www/html/lib/libConstant.php';
require PATH_BASE.'/lib/libDB.php';
require PATH_BASE.'/lib/libBackup.php';

$backupRetention=getRetention();

    $backuppath=PATH_LOCAL;
    $stagingpath=PATH_STAGING;
    
    $retention=getRetention();
    $rsSelectRetention=selectBackupRetention($retention);
    
    foreach ($rsSelectRetention as $row) 
        { 
        $backupfile=$backuppath."/".$row[2]."/".$row[1]."/".$row[3];
        if (updateBackupCleaning($row[0])){       
            if (!unlink($backupfile))
                {
                    $message="Error deleting $backupfile";
                    $idserver=$row[2];
                    $idwork=$row[1];                            
                    insertLog($idserver,$idwork,$message,"1");
                }
            else
                {
                    $message="Deleted $backupfile";
                    $idserver=$row[2];
                    $idwork=$row[1];
                    insertLog($idserver,$idwork,$message,"3");
                }
        }
        else{
                    $message="Register update error: $row[3]";
                    $idserver=$row[2];
                    $idwork=$row[1];
                    insertLog($idserver,$idwork,$message,"1");
        }
        }
?>