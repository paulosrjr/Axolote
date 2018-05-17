<?php

//DEFAULT
function dbConn() {
    $dbConn = new PDO('mysql:dbname=backup;host=mysql', 'root', 'pass');
    return $dbConn;
}

//INSERTS
//SERVER
function insertServer($servername, $serverip, $serverdescription) {
    $sqlInsertServer = "INSERT INTO server (name,ip,description) VALUES ('$servername','$serverip','$serverdescription');";
//echo $sqlInsertServer;
    try {
        $db = dbConn();
        if ($db->query($sqlInsertServer)) {
            echo "Success";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function deleteServer($serverid) {
    $sqlDeleteServer = "delete from server where idserver=$serverid;";
    $sqlDeleteServerWork = "delete from work where server_idserver=$serverid;";
    try {
        $db = dbConn();
        if ($db->query($sqlDeleteServer)) {
            if ($db->query($sqlDeleteServerWork)) {
                echo "Success";
                return true;
            }
        } else {
            echo "Error on server deleting";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//WORK
function insertWork($workidentificator, $workserver, $worktype) {
    $sqlInsertWork = "INSERT INTO work (identify,server_idserver,backupType_idbackupType) VALUES ('$workidentificator',$workserver,$worktype);";
//echo $sqlInsertWork;
    try {
        $db = dbConn();
        if ($db->query($sqlInsertWork)) {
            echo "Success";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function updateWork($idwork, $username, $password, $command, $parameters, $remotepath) {
    $sqlUpdateWork = "UPDATE work SET user='$username',password='$password',command='$command',parameters='$parameters',remotepath='$remotepath' WHERE idwork='$idwork'";
//echo $sqlUpdateWork;
    try {
        $db = dbConn();
        if ($db->query($sqlUpdateWork)) {
            echo "Success";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function deleteWork($workid) {
    $sqlDeleteWork = "delete from work where idwork=$workid;";
//echo $sqlDeleteWork;
    try {
        $db = dbConn();
        if ($db->query($sqlDeleteWork)) {
            echo "Success";
        } else {
            echo "Error on delete";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//SELECT
//SERVER
function selectAllServer() {
    $db = dbConn();
    $sqlSelectServerDatatable = "select * from server;";
    $rsAllServer = $db->query($sqlSelectServerDatatable);
    return $rsAllServer;
    $db->close();
}

function selectWorkServerDatatable($idserver) {
    $db = dbConn();
    $sqlSelectServerWorkCount = "select count(w.idwork) as count from server as s, work as w where s.idserver=w.server_idserver and w.server_idserver='$idserver';";
    $rsWorkServerDatatable = $db->query($sqlSelectServerWorkCount);
    return $rsWorkServerDatatable;
    $db->close();
}

function selectWorkServerID($name, $ip) {
    $db = dbConn();
    $sqlSelectWorkServerID = "select idserver from server where name='$name' and ip='$ip';";
    $rsWorkServerID = $db->query($sqlSelectWorkServerID);
    return $rsWorkServerID;
    $db->close();
}

function selectServerByID($idserver) {
    $db = dbConn();
    $sqlSelectServerByID = "select * from server where idserver='$idserver';";
    $rsServerByID = $db->query($sqlSelectServerByID);
    return $rsServerByID;
    $db->close();
}

function selectServerNameByID($idserver) {
    $db = dbConn();
    $sqlSelectServerNameByID = "SELECT name FROM server where idserver=$idserver;";
    $rsServerNameByID = $db->query($sqlSelectServerNameByID);
    foreach ($rsServerNameByID as $row) {
        $name = $row[name];
        return $name;
    }
    $db->close();
}

//WORK
function selectAllWork() {
    $db = dbConn();
    $sqlSelectAllWork = "select * from work;";
    $rsAllWork = $db->query($sqlSelectAllWork);
    return $rsAllWork;
    $db->close();
}

function selectWorkByID($idwork) {
    $db = dbConn();
    $sqlSelectWorkByID = "select * from work where idwork=$idwork;";
    $rsWorkByID = $db->query($sqlSelectWorkByID);
    return $rsWorkByID;
    $db->close();
}

function selectWorkBackupTypeID($idwork) {
    $db = dbConn();
    $sqlSelectWorkBackupTypeID = "select backupType_idbackupType from work where idwork=$idwork;";
//echo $sqlSelectWorkBackupTypeID;
    $rsWorkBackupTypeID = $db->query($sqlSelectWorkBackupTypeID);
    return $rsWorkBackupTypeID;
    $db->close();
}

function selectWorkServerName($idserver) {
    $db = dbConn();
    $sqlSelectWorkServerName = "SELECT name FROM server where idserver=$idserver;";
    $rsWorkServerName = $db->query($sqlSelectWorkServerName);
    return $rsWorkServerName;
    $db->close();
}

function selectWorkServerIP($idserver) {
    $db = dbConn();
    $sqlSelectWorkServerIP = "SELECT ip FROM server where idserver=$idserver;";
    $rsWorkServerIP = $db->query($sqlSelectWorkServerIP);
    return $rsWorkServerIP;
    $db->close();
}

function selectWorkBackupTypeName($idbackupType) {
    $db = dbConn();
    $sqlSelectWorkBackupTypeName = "SELECT type FROM backupType where idbackupType=$idbackupType;";
    $rsWorkBackupTypeName = $db->query($sqlSelectWorkBackupTypeName);
    return $rsWorkBackupTypeName;
    $db->close();
}

function selectWorkIdentifyByID($idwork) {
    $db = dbConn();
    $sqlSelectWorkIdentifyByID = "SELECT identify FROM work where idwork=$idwork;";
//echo $sqlSelectWorkIdentifyByID;
    $rsWorkIdentifyByID = $db->query($sqlSelectWorkIdentifyByID);
    foreach ($rsWorkIdentifyByID as $row) {
        $identify = $row[identify];
        return $identify;
    }
//$db->close();
}

//BACKUP TYPE
function selectAllBackupType() {
    $db = dbConn();
    $sqlSelectAllBackupType = "select * from backupType;";
    $rsAllBackupType = $db->query($sqlSelectAllBackupType);
    return $rsAllBackupType;
    $db->close();
}

function selectBackupTypeID($idbackupType) {
    $db = dbConn();
    $sqlSelectBackupTypeID = "select * from backupType where idbackupType=$idbackupType;";
    $rsAllBackupTypePerID = $db->query($sqlSelectBackupTypeID);
    return $rsAllBackupTypePerID;
    $db->close();
}

//BACKUP TYPE PARAMETERS
function selectAllBackupTypeParameters($idbackuptype) {
    $db = dbConn();
    $sqlSelectAllBackupTypeParameters = "SELECT parameter,description FROM backup.backupTypeParameters where backupType_idbackupType=$idbackuptype;";
    $rsAllBackupTypeParameters = $db->query($sqlSelectAllBackupTypeParameters);
    return $rsAllBackupTypeParameters;
    $db->close();
}

//LOG
function selectAllLog() {
    $db = dbConn();
    $sqlSelectLogDatatable = "select * from log;";
    $rsAllLog = $db->query($sqlSelectLogDatatable);
    return $rsAllLog;
    $db->close();
}

function insertLog($idserver, $idwork, $message, $status = "-1") {
    $db = dbConn();

//if($status==NULL || $status==0 || $status=='0'){$status="-1";}

    $sqlInsertLog = "INSERT INTO log (`server_idserver`, `work_idwork`, `log`, `status`) VALUES ('$idserver','$idwork','$message','$status');";
    if ($db->query($sqlInsertLog)) {
        return true;
    }
}

function removeLog($idlog) {
    $db = dbConn();
    $sqlRemoveLog = "DELETE FROM log where idlog=$idlog;";
    if ($db->query($sqlRemoveLog)) {
        return true;
    }
}

function selectLogRetention($retention) {
    try {
        $db = dbConn();
        $sqlSelectLogRetention = "SELECT * FROM backup.log WHERE dateandtime < NOW() - INTERVAL $retention DAY;";
        $rsLogRetention = $db->query($sqlSelectLogRetention);
        return $rsLogRetention;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//BACKUP
function insertBackupInfo($idserver, $idwork, $file) {
    $db = dbConn();
    $sqlBackupInfo = "INSERT INTO backup (`server_idserver`, `work_idwork`, `file`) VALUES ('$idserver','$idwork','$file');";
    if ($db->query($sqlBackupInfo)) {
        return true;
        ;
    }
}

function selectBackupByServerID($idserver) {
    try {
        $db = dbConn();
        //echo "Recebo: $idserver";
        $sqlSelectBackupByServerID = "select * from backup where server_idserver='$idserver';";
        //echo $sqlSelectBackupByServerID;
        $rsBackupByServerID = $db->query($sqlSelectBackupByServerID);
        return $rsBackupByServerID;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function updateBackupCleaning($idbackup) {
    try {
        $db = dbConn();
        //echo "Recebo: $idbackup";
        $sqlUpdateBackupCleaning = "UPDATE `backup`.`backup` SET `status`='1' WHERE `idbackup`='$idbackup';";
        echo $sqlUpdateBackupCleaning;
        $rsUpdateBackupCleaning = $db->query($sqlUpdateBackupCleaning);
        return true;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}

function selectBackupRetention($retention) {
    try {
        $db = dbConn();
        //echo "Recebo: $idbackup";
        $sqlSelectBackupRetention = "SELECT * FROM backup.backup WHERE dateandtime < NOW() - INTERVAL $retention DAY AND status='0';";
        //echo $sqlSelectBackupRetention;
        $rsBackupRetention = $db->query($sqlSelectBackupRetention);
        return $rsBackupRetention;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//SECURITY
function searchUser($username, $password) {
    try {
        $db = dbConn();
        $sqlSelectUserPassword = "select count(*) as ok from user where user='$username' and password='$password';";
        $rsSelectUserPassword = $db->query($sqlSelectUserPassword);
        return $rsSelectUserPassword;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

//PARAMETER
function getRetention() {
    try {
        $db = dbConn();
        $sqlSelectRetention = "select parameter.value from parameter where parameter.parameter='retention';";
        $rsSelectRetention = $db->query($sqlSelectRetention);
        foreach ($rsSelectRetention as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getLogRetention() {
    try {
        $db = dbConn();
        $sqlSelectRetention = "select parameter.value from parameter where parameter.parameter='logretention';";
        $rsSelectRetention = $db->query($sqlSelectRetention);
        foreach ($rsSelectRetention as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

//DASHBOARD
function getTotalLogMessages() {
    try {
        $db = dbConn();
        $sqlSelectTotalMessages = "select count(*) from log;";
        $rsSelectTotalMessages = $db->query($sqlSelectTotalMessages);
        foreach ($rsSelectTotalMessages as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getErrorsLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "select count(*) from log where status='1';";
        $rsSelectTotalMessages = $db->query($sqlSelect);
        foreach ($rsSelectTotalMessages as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getUnknownLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "select count(*) from log where status='-1';";
        $rsSelectTotalMessages = $db->query($sqlSelect);
        foreach ($rsSelectTotalMessages as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getWarningLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "select count(*) from log where status='2';";
        $rsSelect = $db->query($sqlSelect);
        foreach ($rsSelect as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getSuccessLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "select count(*) from log where status='0';";
        $rsSelect = $db->query($sqlSelect);
        foreach ($rsSelect as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getInfoLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "select count(*) from log where status='3';";
        $rsSelect = $db->query($sqlSelect);
        foreach ($rsSelect as $row) {
            return $row[0];
        }
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

function getErrorsCountLogMessages() {
    try {
        $db = dbConn();
        $sqlSelect = "SELECT server_idserver, count(*) as logcount FROM backup.log where status='1' group by server_idserver order by logcount DESC;";
        $rsSelectTotalMessages = $db->query($sqlSelect);
        return $rsSelectTotalMessages;
        $db->close();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

?>
