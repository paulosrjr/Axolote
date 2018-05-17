<?php

require '/var/www/html/lib/libConstant.php';
require PATH_BASE . '/lib/libDB.php';
require PATH_BASE . '/lib/libBackup.php';

$rsWork = selectAllWork();
foreach ($rsWork as $row) {
    if (!getBackupIDNumberType($row['idwork'])) {

        $idserver = $row['server_idserver'];
        $idwork = $row['idwork'];
        $identify = $row['identify'];
        $command = $row['command'];
        $username = $row['user'];
        $password = $row['password'];
        $remotepath = $row['remotepath'];
        $parameters = $row['parameters'];

        $localpath = PATH_LOCAL . "/" . $idserver . "/" . $idwork;
        if (!file_exists($localpath)) {
            mkdir($localpath, 0777, true);
        }

        $stagingpath = PATH_STAGING . "/" . $idserver . "/" . $idwork;
        if (!file_exists($stagingpath)) {
            mkdir($stagingpath, 0777, true);
        }

        $rsIPServer = selectWorkServerIP($idserver);
        foreach ($rsIPServer as $row) {
            $ipserver = $row['ip'];
        }
        echo $command;
        if ($command === "" || $command === NULL) {
            $message = "[ERROR] - $identify - COMMAND not defined";
            insertLog($idserver, $idwork, $message);
            echo $message;
        } elseif ($username === "" || $username === NULL) {
            $message = "[WARNING] - $identify - USER not defined";
            insertLog($idserver, $idwork, $message);
            echo $message;
        } elseif ($password === "" || $password === NULL) {
            $message = "[ERROR] - $identify - Command not defined";
            insertLog($idserver, $idwork, $message);
            echo $message;
        } elseif ($remotepath === "" || $remotepath === NULL) {
            $message = "[ERROR] - $identify - Command not defined";
            insertLog($idserver, $idwork, $message);
            echo $message;
        } else {
            switch ($command) {
                case "scp":
                    $messageBegin = "Inicializing backup $identify";
                    insertLog($idserver, $idwork, $messageBegin, "3");
                    if (bkpSCP($idserver, $idwork, $username, $password, $parameters, $ipserver, $remotepath, $stagingpath)) {
                        bkpCompact($idserver, $idwork, $stagingpath, $localpath, $identify);
                        bkpStagingRemove($idserver, $idwork, $stagingpath);
                        //bkpBackupInfo($idserver, $idwork);    
                    } else {
                        $messageBegin = "Error inicializing backup $identify";
                        insertLog($idserver, $idwork, $messageBegin, "1");
                    }
                    break;

                case "sftp":
                    bkpSFTP();
                    break;

                case "ftp":
                    $messageBegin = "Inicializing backup $identify";
                    insertLog($idserver, $idwork, $messageBegin, "3");

                    if (bkpFTP($idserver, $idwork, $username, $password, $parameters, $ipserver, $remotepath, $stagingpath)) {
                        bkpCompact($idserver, $idwork, $stagingpath, $localpath, $identify);
                        bkpStagingRemove($idserver, $idwork, $stagingpath);
                        //bkpBackupInfo($idserver, $idwork);
                    } else {
                        $messageBegin = "Error inicializing backup $identify";
                        insertLog($idserver, $idwork, $messageBegin, "1");
                    }
                    break;

                case "rsync":
                    $messageBegin = "Inicializing backup $identify";
                    insertLog($idserver, $idwork, $messageBegin, "3");
                    if (bkpRsysnc($idserver, $idwork, $username, $password, $parameters, $ipserver, $remotepath, $stagingpath)) {
                        bkpCompact($idserver, $idwork, $stagingpath, $localpath, $identify);
                        bkpStagingRemove($idserver, $idwork, $stagingpath);
                        //bkpBackupInfo($idserver, $idwork);                  
                    } else {
                        $messageBegin = "Error inicializing backup $identify";
                        insertLog($idserver, $idwork, $messageBegin, "1");
                    }
                    break;

                case "script":
                    $messageBegin = "Inicializing backup $identify";
                    insertLog($idserver, $idwork, $messageBegin, "3");
                    if (bkpScript($idserver, $idwork, $username, $password, $parameters, $ipserver, $remotepath, $stagingpath)) {
                        bkpCompact($idserver, $idwork, $stagingpath, $localpath, $identify);
                        bkpStagingRemove($idserver, $idwork, $stagingpath);
                        //bkpBackupInfo($idserver, $idwork);
                    } else {
                        $messageBegin = "Error inicializing backup $identify";
                        insertLog($idserver, $idwork, $messageBegin, "1");
                    }
                    break;

                case "mysql":
                    $messageBegin = "Inicializing backup $identify";
                    insertLog($idserver, $idwork, $messageBegin, "3");
                    if (bkpMysql($idserver, $idwork, $username, $password, $parameters, $ipserver, $remotepath, $stagingpath)) {
                        bkpCompact($idserver, $idwork, $stagingpath, $localpath, $identify);
                        bkpStagingRemove($idserver, $idwork, $stagingpath);
                        //bkpBackupInfo($idserver, $idwork);
                    } else {
                        $messageBegin = "Error inicializing backup $identify";
                        insertLog($idserver, $idwork, $messageBegin, "1");
                    }
                    break;

                default:
                    $message = "[ERROR] - $identify - Command not exist in database";
                    insertLog($idserver, $idwork, $message);
                    echo $message;
                    break;
            }
        }
    }
}
?>