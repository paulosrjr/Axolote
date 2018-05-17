<?php
require 'lib/libSys.php';
require 'lib/libFile.php';
require 'lib/libServer.php';
require 'lib/libWork.php';
require 'lib/libBackup.php';

$page=filter_input(INPUT_POST,page,FILTER_DEFAULT);

switch ($page){
    case "server":       
        $servername=filter_input(INPUT_POST,name,FILTER_DEFAULT);
        $serverip=filter_input(INPUT_POST,ip,FILTER_DEFAULT);
        $serverdescription=filter_input(INPUT_POST,description,FILTER_DEFAULT);       
        if(validateNewServer($servername, $serverip, $serverdescription)){
            insertServer($servername, $serverip, $serverdescription);
        }
        break;

    case "del-server":
        $serverid=filter_input(INPUT_POST,idserver,FILTER_DEFAULT);              
        if($cleanServerID=cleanDeleteServer($serverid)){
            if(deleteServer($cleanServerID)){
                deleteServerFolder(); 
            }
            else{
                echo "Error deleting on database";
            }
        }
        break;
        
    case "work":
        $workidentify=filter_input(INPUT_POST,identificator,FILTER_DEFAULT);
        $workserver=filter_input(INPUT_POST,idserver,FILTER_DEFAULT);
        $workbackuptype=filter_input(INPUT_POST,idtype,FILTER_DEFAULT);       
        if(validateNewWork($workidentify, $workserver, $workbackuptype)){
            $workjob=preg_replace('/\s+/', '', $workidentify);
            insertWork($workjob, $workserver, $workbackuptype);
        }
        break;

    case "upd-work":
        $workid=filter_input(INPUT_POST,idwork,FILTER_DEFAULT);
        $username=filter_input(INPUT_POST,username,FILTER_DEFAULT);
        $password=filter_input(INPUT_POST,password,FILTER_DEFAULT);
        $remotepath=filter_input(INPUT_POST,remotepath,FILTER_DEFAULT);
        $parameters=filter_input(INPUT_POST,parameters,FILTER_DEFAULT);
     
        if($cleanWorkID=cleanUpdateWork($workid)){
           
        $rsBackupType=selectWorkBackupTypeID($cleanWorkID);
        foreach ($rsBackupType as $row){ $backupTypeID=$row[backupType_idbackupType]; }                    
        $rsBackupTypeName=selectBackupTypeID($backupTypeID);
        foreach ($rsBackupTypeName as $row){ $backupTypeName=$row[type]; if($row[type]==="SCRIPT" || $row[type]==="script"){ $scriptBackup=1; }}
           
        if($scriptBackup!=1){
           if(validateUpdateWork($username, $password, $remotepath)){
               $command=setWorkCommand($cleanWorkID);
               updateWork($cleanWorkID, $username, $password, $command, $parameters, $remotepath);
            }
           }
        elseif ($scriptBackup==1) {
            if(validateUpdateWorkScript($remotepath)){
               updateWork($cleanWorkID, "NO_USER", "NO_PASS", "script", $parameters, $remotepath);
            }    
           }
        }
        break;
        
    case "upd-work-form":
        $workid=filter_input(INPUT_POST,idwork,FILTER_DEFAULT);
        showWorkUpdateForm($workid);
        break;
        
    case "del-work":
        $workid=filter_input(INPUT_POST,idwork,FILTER_DEFAULT);
        if($cleanWorkID=cleanDeleteWork($workid)){                  
           deleteWork($cleanWorkID);
        }
        break;
        
    case "backup-search":
        $backupserver=filter_input(INPUT_POST,idserver,FILTER_DEFAULT);
        if($cleanServerID=cleanDeleteBackup($backupserver)){
            //echo "Envio: $cleanServerID<br>";
            backupDatatable($cleanServerID);
        }
        break;
    
    case "backup":
        echo "server";
        break;
}
?>