<?php

function get_able_oper($id)
{
    $result = array();   
    
    $cmd = "CALL show_avaialble_operations(?);";
    $mysqli = $_SESSION['sql_server'];
    
    $statement = $mysqli->prepare($cmd);
    
    $statement->bind_param('i', $id);

    $statement->execute();
    $statement->bind_result($internal_name ,$external_name);
    
    while($statement->fetch())
        $result[$external_name] = $internal_name;
    
    return $result;
}

?>