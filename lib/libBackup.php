<?php

function bkpRsysnc($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    $cmd = "sshpass -p '$password' rsync --progress -ah -e \"ssh -o StrictHostKeyChecking=no\" $parameters $username@$ip:$remotepath $localpath 1>/dev/null; echo $?";
    echo $cmd . "\n";
    if ($output = shell_exec($cmd)) {
        $output = "RSYNC: $output";
        if (intval($output) != 0) {
            insertLog($idserver, $idwork, $output, "1");
            return false;
        } else {
            insertLog($idserver, $idwork, $output, "0");
            return true;
        }
    } else {
        $output = "Error in execution: $cmd";
        insertLog($idserver, $idwork, $output, "1");
        return false;
    }
}

function bkpSCP($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    $cmd = "sshpass -p '$password' scp -o stricthostkeychecking=no $parameters $username@$ip:$remotepath $localpath 2>&1; echo $?";
    echo $cmd . "\n";
    if ($output = shell_exec($cmd)) {
        $output = "SCP: $output";
        if (intval($output) != 0) {
            insertLog($idserver, $idwork, $output, "1");
            return false;
        } else {
            insertLog($idserver, $idwork, $output, "0");
            return true;
        }
    } else {
        $output = "Error in execution: $cmd";
        insertLog($idserver, $idwork, $output, "1");
        return false;
    }
}

function bkpFTP($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    $cmd = "cd $localpath && wget $parameters -m --ftp-user=$username --ftp-password=$password ftp://$ip$remotepath && echo $?";
    echo $cmd . "\n";
    if ($output = shell_exec($cmd)) {
        $output = "FTP: $output";
        insertLog($idserver, $idwork, $output);
        return true;
    } else {
        $output = "Error in execution: $cmd";
        insertLog($idserver, $idwork, $output);
        return false;
    }
}

function bkpScript($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    if (!file_exists($localpath) || !is_dir($localpath)) {
        mkdir($localpath);
    }

    $cmd = PATH_SCRIPT . "/$remotepath $localpath $parameters";
    echo $cmd . "\n";
    //if ($output = shell_exec($cmd)) {        
    $output = shell_exec($cmd);
    if (intval($output) != 0) {
        $output = "SCRIPT: $output";
        insertLog($idserver, $idwork, $output, "0");
        return true;
    } else {
        $output = "Error in execution: $cmd";
        insertLog($idserver, $idwork, $output, "1");
        return false;
    }
    /* else {
      $output = "Error in execution: $cmd";
      insertLog($idserver, $idwork, $output,"1");
      return false;
      } */
}

function bkpMysql($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    if (!file_exists($localpath) || !is_dir($localpath)) {
        mkdir($localpath);
    }
    date_default_timezone_set('America/Sao_Paulo');
    $date = date("Ymd-H-i");
    $file = "$date-$remotepath.sql";
    $cmd = "mysqldump -u$username -p$password -h$ip $remotepath > $localpath/$file; echo $?";
    echo $cmd . "\n";
    if ($output = shell_exec($cmd)) {
        if (intval($output) != 0) {
            $output = "MYSQL: $output";
            insertLog($idserver, $idwork, $output, "1");
            return false;
        } else {
            $output = "MYSQL: $output";
            insertLog($idserver, $idwork, $output, "0");
            return true;
        }
    } else {
        $output = "Error in execution: $cmd";
        insertLog($idserver, $idwork, $output, "1");
        return false;
    }
}

function bkpMysqlAll($idserver, $idwork, $username, $password, $parameters, $ip, $remotepath, $localpath) {
    if (!file_exists($localpath) || !is_dir($localpath)) {
        mkdir($localpath);
    }
    date_default_timezone_set('America/Sao_Paulo');
    $date = date("Ymd-H-i");
    //$cmdGetDatabases="mysql -u$username -p$password -h$ip -e 'show databases' -s --skip-column-names";
    $cmdGetDatabases = "mysql -uusername -p$password -h$ip -e 'show databases' -s --skip-column-names";
    //$cmdLastCommand="echo $?";
    echo $cmdGetDatabases . "\n";
    $outputGetDatabases = passthru($cmdGetDatabases);
    //echo $outputGetDatabases;
    
    $pos=stripos($outputGetDatabases, "ERROR");
    
    if ($pos == true) {
        echo "Showing error";
    }
    else{
        echo "Not showing error";
        echo $pos;
    }
    
    foreach (preg_split("/((\r?\n)|(\r\n?))/", $outputGetDatabases) as $db) {
        if (strstr($outputGetDatabases, "ERROR")) {
            echo "Showing error";
        } else {
            $file = "$date-$db.sql";
            $cmdDoBackup = "mysqldump -u$username -p$password -h$ip $db > $localpath/$file; echo $?";
            //echo $cmdDoBackup;
            echo "\n";
            echo $file;
            //echo $outputGetDatabases;
        }
    }
    
    /* if ($output = shell_exec($cmdGetDatabases)) {
      if (intval($output) != 0) {
      $output = "MYSQL All: $output";
      //insertLog($idserver, $idwork, $output, "1");
      return false;
      } else {
      $output = "MYSQL All: $output";
      //insertLog($idserver, $idwork, $output, "0");
      return true;
      }
      } else {
      $output = "Error in execution: $cmd";
      insertLog($idserver, $idwork, $output, "1");
      return false;
      } */
}

function bkpCompact($idserver, $idwork, $stagingpath, $localpath, $workname) {
    date_default_timezone_set('America/Sao_Paulo');
    $date = date("Ymd-H-i");
    $randomNumber = mt_rand(9999, 9999999);
    $file = "$date-$workname-$randomNumber.tar.gz";
    $cmd = "tar -zcf $localpath/$file $stagingpath && echo $?";
    echo $cmd . "\n";
    $output = shell_exec($cmd);
    $output = "COMPACTING $stagingpath FILES: " . $output;
    if (intval($output) != "0") {
        insertLog($idserver, $idwork, $output, "1");
        return false;
    } else {
        insertLog($idserver, $idwork, $output, "3");
        insertBackupInfo($idserver, $idwork, $file);
        return true;
    }
}

function bkpBackupInfo($idserver, $idwork, $file) {
    //date_default_timezone_set('America/Sao_Paulo');
    //$date=date("Ymd-H-i");
    //$file=$date-$workname.".tar.gz";
    insertBackupInfo($idserver, $idwork, $file);
}

function bkpStagingRemove($idserver, $idwork, $stagingpath) {
    $cmd = "rm -rf $stagingpath 2>&1; echo $?";
    echo $cmd . "\n";
    $output = shell_exec($cmd);
    $output = "REMOVING STAGING $stagingpath: " . $output;
    if (intval($output) != "0") {
        insertLog($idserver, $idwork, $output, "2");
        return false;
    } else {
        insertLog($idserver, $idwork, $output, "3");
        return true;
    }
}

function getBackupCommand($idbackupType) {
    $rsbackupType = selectBackupTypeID($idbackupType);
    foreach ($rsbackupType as $row) {
        $backupTypeName = $row[type];
    }
    $command = strtolower($backupTypeName);
    return $command;
}

function getBackupIDNumberType($idnumber) {
    if ($idnumber % 2 == 0) {
        return true; //Even
    } else {
        return false; //Odd
    }
}

function cleanDeleteBackup($serverid) {
    try {
        $cleanServerid = substr($serverid, 4);
        $cleanID = intval($cleanServerid);
        //echo "Retorno: $cleanID<br>";
        return $cleanID;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

?>