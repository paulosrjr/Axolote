<?php
require '../lib/libDB.php';
require '../lib/libConstant.php';
require '../lib/libBackup.php';
$rsWork=selectAllWork();          
foreach ($rsWork as $row) {
        if(!getBackupIDNumberType($row['idwork'])){
            echo "\n Odd - ".$row['idwork'];
        }
        else{
            echo "\n Even - ".$row['idwork'];
        }
}