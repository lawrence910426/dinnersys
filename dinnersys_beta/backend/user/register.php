<?php

function register($usr_name ,$phone_num ,$is_vege ,$gen ,$email ,$usr_login_id ,$pswd)
{
    $sql_command = "SELECT register(? ,? ,? ,? ,? ,? ,?);";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    $statement->bind_param('ssissss',$usr_name ,$phone_num ,$is_vege ,$gen ,$email ,$usr_login_id ,$pswd);
    $statement->execute();
    
    $statement->bind_result($result);
    if($statement->fetch())
        if($result != 'success')
            throw new Exception($result);
}

?>