<?php

require_once(__DIR__ . "/user.php");

function login($login_id, $pswd ,$device_id)
{
    $login_command = "CALL login(? ,? ,?);";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($login_command);
    
    $statement->bind_param('sss', $login_id, $pswd ,$device_id);

    $statement->execute();
    $statement->bind_result($id ,$name ,$class_id);
    
    if($statement->fetch())
        $account = new user($id ,$name ,$class_id);   
        
    if($account == null) throw new Exception("No account.");
    
    return $account;
}
?>