<?php
function simpleCheckLogged(){ if(isset($_SESSION['usernameHA']) && isset($_SESSION['passwordHE']) && $_SESSION['magicalnumber']===666){ }
else{ header("location: index.php"); }}
simpleCheckLogged();
?>