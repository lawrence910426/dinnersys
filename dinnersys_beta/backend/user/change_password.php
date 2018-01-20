<?php

require_once("user.php");
require_once("login.php");

function idenity_verify($user_id ,$old_password)
{
    $test_user = login($user_id ,$old_password);
    $logged_user = unserialize($_SESSION['user']);
    
    if($test_user == null || $logged_user != $test_user) die("Access denied.");
}


function change_password($user_id ,$new_password ,$old_password)
{
    idenity_verify($user_id ,$old_password);
    $sql = "UPDATE dinnersys.users
        SET password = ?
        WHERE user_id = ? AND password = ?
        LIMIT 1;";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql);
    
    $statement->bind_param('sds', $new_password, $user_id , $old_password);
    $statement->execute() or die("Failed to change your password. Please call 0975192145 for help.");
    
    return [
        'user_id' => $user_id ,
        'pswd' => $new_password
        ];
}

?>