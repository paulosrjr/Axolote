<?php
require 'lib/libSys.php';
require 'lib/libSecurity.php';
$page=filter_input(INPUT_POST,page,FILTER_DEFAULT);

$logoff=filter_input(INPUT_GET,logoff,FILTER_DEFAULT);

switch ($page) {
   case "logon":
                $username=filter_input(INPUT_POST,username,FILTER_DEFAULT);
                $password=filter_input(INPUT_POST,password,FILTER_DEFAULT);
                secUserAuth($username, $password);                
        break;
   case "logoff":
       session_destroy();
       $redirect=$_SERVER['SERVER_NAME'];
       //header("location: index.php");
        break;
   case "change-pass":
       
        break;
    default:
        break;
}
if ($logoff==="yes") {
       session_destroy();
       $redirect=$_SERVER['SERVER_NAME'];
       header("location: index.php");
}
?>