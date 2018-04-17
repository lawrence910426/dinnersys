<?php

function check_recv($id)
{
    $uid = unserialize($_SESSION['user'])->id;
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "SELECT check_recv(? ,?);";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('ii' ,$id ,$uid);
    $statement->execute();
    $statement->bind_result($result);
    
    if($statement->fetch())
    {
        if($result != 'success') 
            throw new Exception($result);
    }
    else
        throw new Exception('unable to fetch data from server.');
}

?>