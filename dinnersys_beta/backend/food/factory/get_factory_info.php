<?php

function get_factory_info($factory_id)
{
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL get_factory_info(?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('i' ,$factory_id);
    $statement->execute();
    
    $statement->bind_result($fid ,$fname ,$disabled ,
        $lower_bound ,$upper_bound ,$pre_time
    );
    
    $result = [];
    while($statement->fetch())
    {
        $result[$fid] = new factory($fid ,$fname ,
            $lower_bound ,$pre_time ,$upper_bound ,$disabled);
    }
    
    return $result;
}

?>