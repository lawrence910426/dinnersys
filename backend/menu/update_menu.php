<?php

function update_menu($dish_id_old ,$dish_name_new ,$user)   //because of encoding problem. This function is abonded. I will change the menu by myself.
{
    $sql_command = "
        UPDATE	    menu
        SET	        name = ?
        WHERE       dish_id = ?
        LIMIT       1;
        ";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied.");
    
    $statement->bind_param('sd' ,
        $dish_name_new,
        $dish_id_old);

    $statement->execute() or die("unable to update menu. this process will not be proceed. <br>");
}

?>