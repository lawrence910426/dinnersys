<?php

require_once(__DIR__ . "/user.php");
require_once(__DIR__ . "/login.php");

function change_password($user_id ,$new_password ,$old_password)
{
    if (!(preg_match('/[A-Za-z0-9 ]+/', $new_password) &&
        preg_match('/[A-Za-z0-9 ]+/', $old_password))) die("Invalid password");
    login($user_id ,$old_password); # this will check if the old password is valid.
    
    
    $sql = "UPDATE dinnersys.users
        SET password = ?
        WHERE user_id = ? AND password = ?
        LIMIT 1;";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql);
    
    $statement->bind_param('sds', $new_password, $user_id , $old_password);
    $statement->execute() or die("Error");
    
    return [
        'user_id' => $user_id ,
        'pswd' => $new_password
        ];
}

?>