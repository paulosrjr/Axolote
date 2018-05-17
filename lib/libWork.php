<?php
function validateNewWork($workidentify,$workserver,$workbackuptype) {
try {
if ($workidentify==""){ echo "Identificator don't be null"; return false; }
elseif ($workidentify==NULL){ echo "Identificator don't be null"; return false; }
elseif (strlen($workidentify)<5){ echo "Minimal 6 chars in identificator field"; return false; }
elseif ($workserver==""){ echo "Server don't be null"; return false; }
elseif ($workserver==NULL){ echo "Server don't be null"; return false; }
elseif ($workbackuptype==""){ echo "Backup type don't be null"; return false; }
elseif ($workbackuptype==NULL){ echo "Backup type don't be null"; return false; }
else { return true; }
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function validateUpdateWork($username,$password,$remotepath) {
try {    
if ($username==""){ echo "User don't be null"; return false; }
elseif ($username==NULL){ echo "User don't be null"; return false; }
elseif (strlen($username)<3){ echo "Minimal 3 chars in user field"; return false; }
elseif ($password==""){ echo "Password don't be null"; return false; }
elseif ($password==NULL){ echo "Password don't be null"; return false; }
elseif ($remotepath==""){ echo "Remote path don't be null"; return false; }
elseif ($remotepath==NULL){ echo "Remote path don't be null"; return false; }
else { return true; }
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function validateUpdateWorkScript($remotepath) {
try {    
if ($remotepath==""){ echo "Script name don't be null"; return false; }
elseif ($remotepath==NULL){ echo "Script name  don't be null"; return false; }
elseif (strlen($remotepath)<3){ echo "Minimal 3 chars in script name  field"; return false; }
else { return true; }
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function cleanDeleteWork($workid) {
try {
    $cleanWorkid=substr($workid,4);
    $cleanID=intval($cleanWorkid);
    return $cleanID;
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function cleanUpdateWork($workid) {
try {
    $cleanWorkid=substr($workid,4);
    $cleanID=intval($cleanWorkid);
    return $cleanID;
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function validateNewWorkError($workidentify,$workserver,$workbackuptype) {
try {
if ($workidentify==""){ $warning="Identificator don't be null"; $error=1; }
elseif ($workidentify==NULL){ $warning.="Identificator don't be null"; $error=1; }
elseif (strlen($workidentify)<5){ $warning.="Minimal 6 chars in identificator field"; $error=1; }
elseif ($workserver==""){ $warning.="Server don't be null"; $error=1; }
elseif ($workserver==NULL){ $warning.="Server don't be null"; $error=1; }
elseif ($workbackuptype==""){ $warning.="Backup type don't be null"; $error=1; }
elseif ($workbackuptype==NULL){ $warning.="Backup type don't be null"; $error=1; }
elseif ($error==1){ echo $warning; return false; }
else { return true; }

}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function showWorkUpdateForm($workid) {
    try {
    //echo "Begin Form...<br>";    
    if($cleanWorkID=cleanUpdateWork($workid)){                  
            //echo $cleanWorkID."<br>";
                    echo "<div class=\"alert alert-warning\" role=\"alert\">";
                    echo "<span class=\"pficon-layered\">";
                    echo "<span class=\"pficon pficon-warning-triangle\"></span>";
                    echo "<span class=\"pficon pficon-warning-exclamation\"></span>";
                    echo "</span>";
                    $rsWorkEditData=selectWorkByID($cleanWorkID);             
                    foreach ($rsWorkEditData as $row){ echo "The Job <strong>".$row[identify]."</strong> with "; }                    
                    $rsBackupType=selectWorkBackupTypeID($cleanWorkID);
                    foreach ($rsBackupType as $row){ $backupTypeID=$row[backupType_idbackupType]; }                    
                    $rsBackupTypeName=selectBackupTypeID($backupTypeID);
                    foreach ($rsBackupTypeName as $row){ 
                    $backupTypeName=$row[type];
                    echo "backup type <strong>".$row[type]."</strong>, will be changed. Are you sure?";                             
                    if($row[type]==="SCRIPT" || $row[type]==="script"){ $scriptBackup=1; }
                    elseif($row[type]==="MYSQL" || $row[type]==="mysql"){ $mysqlBackup=1; }                            
                    }
                    echo "</div>";
                    echo "<br>";                    
                    echo "<form class=\"form-horizontal\">";                    
                    if($scriptBackup!=1){
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"col-sm-3 control-label\" for=\"txtWorkUser\">User</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" id=\"txtWorkUser\" class=\"form-control\">";
                    echo "</div>";
                    echo "</div>";
                    //echo "<br>";
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"col-sm-3 control-label\" for=\"txtWorkPassword\">Password</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" id=\"txtWorkPassword\" class=\"form-control\">";
                    echo "</div>";
                    echo "</div>";
                    }
                    //echo "<br>";
                    
                    if($scriptBackup==1){                        
                        $fieldUpdateValue="Script Name";                         
                    }
                    elseif($mysqlBackup==1){
                        $fieldUpdateValue="Database Name";                         
                    }
                    else {
                        $fieldUpdateValue="Remote Path";                         
                    }
                    
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"col-sm-3 control-label\" for=\"txtWorkRemotePath\">$fieldUpdateValue</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" id=\"txtWorkRemotePath\" class=\"form-control\">";
                    echo "</div>";
                    echo "</div>";
                    
                    echo "<div class=\"alert alert-warning\" role=\"alert\">";
                    echo "<span class=\"pficon-layered\">";
                    echo "<span class=\"pficon pficon-help\"></span>";
                    echo "</span>";
                    echo "Possible, usable, parameters of $backupTypeName&nbsp;(case sensitive): <br>";
                    $rsBackupTypeParameters=selectAllBackupTypeParameters($backupTypeID);   
                    foreach ($rsBackupTypeParameters as $row){                
                        echo "<span class=\"fa fa-angle-right\"></span>&nbsp;&nbsp;&nbsp;".$row[parameter]."&nbsp;:&nbsp;&nbsp;".$row[description]."<br>";
                        
                    }
                    echo "</div>";
                    
                    if($mysqlBackup!=1){
                    echo "<div class=\"form-group\">";
                    echo "<label class=\"col-sm-3 control-label\" for=\"txtWorkParameters\">Parameters</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" id=\"txtWorkParameters\" class=\"form-control\">";
                    echo "</div>";
                    echo "</div>";
                    }
                    
                    echo "</form>";
    }
    } catch (Exception $exc) { echo $exc->getTraceAsString(); }}
    
function setWorkCommand($idwork) {
  $rsBackupType=selectWorkBackupTypeID($idwork);
    foreach ($rsBackupType as $row){ $backupTypeID=$row[backupType_idbackupType]; }
  $command=getBackupCommand($backupTypeID);
  return $command;
}
?>