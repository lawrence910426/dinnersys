<?php

require_once(__DIR__ . "/user.php");

function login($id, $pswd)
{
    if(!preg_match('/[A-Za-z0-9 ]+/', $pswd)) die("Invalid password. <br>");
    
    $login_command = "SELECT * FROM users WHERE user_id = ? AND password = ?;";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($login_command);
    
    $statement->bind_param('is', $id, $pswd);

    $statement->execute();
    $statement->bind_result($user_id ,$user_name ,$password ,$user_prev ,$class_no);
    
    $selected_accounts = 0;         #this value shouldn't be bigger than 1.
    $account;
    while($statement->fetch())
    {
        $account = new user($user_id ,$user_name ,$user_prev ,$class_no);
        $selected_accounts += 1;
    } 
    if($selected_accounts != 1) die("error login");
    
    return $account;
}

?>