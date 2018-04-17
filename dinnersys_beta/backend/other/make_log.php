<?php

function make_log($uid ,$func_name ,$query_detail ,$ip)
{
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL make_log(? ,? ,? ,?);";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('isss' ,$uid ,$func_name ,$query_detail ,$ip);
    $statement->execute();
}

?>