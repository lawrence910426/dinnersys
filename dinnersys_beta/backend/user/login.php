<?php

require_once("user.php");

function login($id, $pswd)
{
    $login_command = "SELECT * FROM users WHERE user_id = ? AND password = ?;";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($login_command);
    
    $statement->bind_param('is', $id, $pswd);

    $statement->execute();
    $statement->bind_result($user_id ,$user_name ,$password ,$user_prev);
    
    $selected_accounts = 0;         #this value shouldn't be bigger than 1.
    $account;
    while($statement->fetch())
    {
        $account = new user($user_id ,$user_name ,$user_prev);
        $selected_accounts += 1;
    } 
    if($selected_accounts != 1) die("error login");
    
    return $account;
}


/**
 *             $login_command = "SELECT * FROM users WHERE user_id = ? AND password = ?;";
 *             $statement = $_SESSION['sql_server']->prepare($login_command);
 *             
 *             $id = 11707;
 *             $ps = 'iloveeliza';
 *             $statement->bind_param('is', $id, $ps);
 *         
 *             $statement->execute();
 *             
 *             $user_id = "";
 *             $user_name = "";
 *             $user_prev = "";
 *             $password = "";
 *             $statement->bind_result($user_id ,$user_name ,$password ,$user_prev);
 *     
 *             $selected_accounts = 0;         #this value shouldn't be bigger than 1.
 *             $account; require_once("./user/user.php");
 *             while($statement->fetch())
 *             {
 *                 if($selected_accounts == 1) die("error login");
 *                 $account = new user($user_id ,$user_name ,$user_prev);
 *                 $selected_accounts += 1;
 *                 $_SESSION['user'] = serialize($account);
 *                 $account->show_user(false);
 *             } 
 *             $statement->close();
 */

?>





            
            



