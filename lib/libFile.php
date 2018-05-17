<?php

function deleteServerFolder($idserver) {
    try {
        $path=PATH_LOCAL."/".$idserver;
        if(rmdir(PATH_LOCAL/$idserver)){ return true; }
        else { return false; }
    }
    catch (Exception $exc) { echo $exc->getTraceAsString(); }}

    
function createServerFolder($idserver) {
    try {
        $path=PATH_LOCAL."/".$idserver;
        if(mkdir($path,0766,true)){ return true; }
        else { return false; }
    }
    catch (Exception $exc) { echo $exc->getTraceAsString(); }}

?>