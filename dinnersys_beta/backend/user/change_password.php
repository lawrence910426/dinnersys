<?php

function change_password($user_id ,$old_password ,$new_password)
{
    $sql = "SELECT change_password(? ,? ,?);";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql);
    
    $statement->bind_param('iss', $user_id, $old_password , $new_password);
    $statement->execute();
    
    $statement->bind_result($result);
    if($statement->fetch())
        if($result != "success")
            throw new Exception($result);
}

?>