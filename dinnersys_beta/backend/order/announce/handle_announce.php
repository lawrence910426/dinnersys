<?php

function get_announce($start ,$end)
{
    # id ,msg ,anno_type ,esti_datetime ,device_id
    # would return in array mode.
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL get_announce(? ,?);";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('ss' ,$start ,$end);
    $statement->execute();
    $statement->bind_result($id ,$msg ,$anno_type ,$esti_dt ,$device_id);
    
    $result = [];
    while($statement->fetch())
    {
        $result[$id] = new announce(
            $id ,$msg ,$anno_type ,$esti_dt ,$device_id
        );
    }
    return $result;
}

function done_announce($id ,$device_id)
{
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL done_announce(? ,?);";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('is' ,$id ,$device_id);
    $statement->execute();
}

?>