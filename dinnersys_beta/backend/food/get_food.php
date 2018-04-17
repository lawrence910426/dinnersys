<?php

function get_dish($factory_id)
{
    $user = unserialize($_SESSION['user']);
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL show_dish(? ,?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('ii' ,unserialize($_SESSION['user'])->id ,$factory_id);
    $statement->execute();
    
    $statement->bind_result($dish_id ,$dish_name ,$dish_charge ,$facto_id ,$facto_name);
    
    $result = [];
    while($statement->fetch())
    {
        $result[$dish_id] = new dish($dish_id ,$dish_name ,$dish_charge ,
            new factory($facto_id ,$facto_name));
    }
    
    return $result;
}

function get_menu($factory_id)
{
    $user = unserialize($_SESSION['user']);
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL show_menu(? ,?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('ii' ,unserialize($_SESSION['user'])->id ,$factory_id);
    $statement->execute();
    
    $statement->bind_result($mid ,$mname ,$mcharge ,
        $dish_able ,$ingre_able ,$is_idle ,
        $fid ,$fname);
    
    $result = [];
    while($statement->fetch())
    {
        $result[$mid] = new menu($mid ,$mname ,$mcharge ,
            $dish_able ,$ingre_able ,$is_idle ,
            new factory($fid ,$fname));
    }
    
    return $result;
}

?>