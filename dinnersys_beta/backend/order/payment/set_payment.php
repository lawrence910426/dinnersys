<?php
function set_payment($ord_id ,$user_id ,$money_to ,$target ,$ip)
{
    $sql_command = "SELECT make_payment(? ,? ,? ,? ,?);";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    $statement->bind_param('iisis',$ord_id ,$user_id ,$money_to ,$target ,$ip);
    $statement->execute();
    
    $statement->bind_result($result);
    if($statement->fetch())
        if($result != 'success done')
            throw new Exception($result);
}

?>