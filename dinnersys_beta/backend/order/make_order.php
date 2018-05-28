<?php

function make_order($user_id ,$dish_id ,$esti_recv)
{   
    $sql_command = "SELECT make_order(? ,? ,?)";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    $statement->bind_param('iis' ,$user_id ,$dish_id ,$esti_recv);
    $statement->execute();
    $statement->bind_result($result);
    
    if($statement->fetch())
        return $result;
    else throw new Exception("Unable to fetch data from server.");
}

?>