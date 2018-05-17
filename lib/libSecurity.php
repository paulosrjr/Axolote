<?php

function secUserAuth($username, $password) {
    $rsUserPass = searchUser($username, $password);
    foreach ($rsUserPass as $row) {
        $resultCount = intval($row['ok']);
        if ($resultCount === 0) {
            echo "Invalid user or password";
        } elseif ($resultCount === 1) {
            $_SESSION['usernameHA'] = $username;
            $_SESSION['passwordHE'] = $password;
            $_SESSION['magicalnumber'] = 666;
            echo "Success";
        } elseif ($resultCount > 1) {
            echo "A error occurred";
        }
    }
}

?>