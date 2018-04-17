<?php

function delete_order($order_id)       //only allows to delete the order that made by the user itself.
{   
    $uid = unserialize($_SESSION['user'])->id;
    
    $sql_command = "SELECT delete_order(? ,?);";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    $statement->bind_param('ii' ,$order_id ,$uid);
    $statement->execute();
    $statement->bind_result($result);
    
    if($statement->fetch())
    {
        if($result != 'success')
            throw new Exception($result);
    }
}

?>