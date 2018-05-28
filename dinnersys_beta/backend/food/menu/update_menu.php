<?php

function update_menu($id ,$charge ,$name ,$ingre ,$dish ,$vege ,$idle)
{
    $sql_command = "CALL update_menu(? ,? ,? ,? ,? ,? ,?);";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);    
    
    $statement->bind_param('iisiiii' ,$id ,$charge ,$name ,$ingre ,$dish ,$vege ,$idle);
    $statement->execute();
}

?>