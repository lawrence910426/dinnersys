<?php

function get_custom_dish_id($tmp)
{
    $mysqli = $_SESSION['sql_server'];
    $sql = "SELECT get_dish_id(? ,? ,? ,? ,? ,? ,? ,? ,? ,?)";
    
    $statement = $mysqli->prepare($sql);
    sort($tmp);
    $statement->bind_param('iiiiiiiiii' ,
        $tmp[0] ,$tmp[1] ,$tmp[2] ,$tmp[3] ,$tmp[4],
        $tmp[5] ,$tmp[6] ,$tmp[7] ,$tmp[8] ,$tmp[9]);
    $statement->execute();
    
    $statement->bind_result($result);
    
    if($statement->fetch())
        if(is_numeric($result)) 
            return intval($result);
        else 
            throw new Exception($result);
    else
        throw new Exception('unable to fetch data from server.');
}

?>