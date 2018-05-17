<?php
function validateNewServer($servername,$serverip,$serverdescription) {
try {
if ($servername===""){ echo "Server name don't be null"; return false; }
elseif ($servername===NULL){ echo "Server name don't be null"; return false; }
elseif (strlen($servername)<1){ echo "Minimal 1 chars in name of server"; return false; }
elseif ($servername===" "){ echo "Minimal 1 chars in name of server"; return false; }
elseif ($serverip===""){ echo "IP don't be null"; return false; }
elseif ($serverip===NULL){ echo "IP don't be null"; return false; }
elseif (filter_var($serverip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) { echo("$serverip is not a valid IPv4 address"); }
else { return true; }
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

function cleanDeleteServer($serverid) {
try {
    $cleanServerid=substr($serverid,4);
    $cleanID=intval($cleanServerid);
    return $cleanID;
}
catch (Exception $exc) { echo $exc->getTraceAsString(); }}

?>