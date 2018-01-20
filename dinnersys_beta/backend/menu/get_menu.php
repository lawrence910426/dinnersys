<?php

require_once("dish.php");
require_once("./user/user.php");

function get_menu()
{
    $user = unserialize($_SESSION['user']);
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "SELECT * FROM menu;";
    
    $prev = $user->get_prev_code();
    if($user == null || 
        !($prev['admin'] || $prev['dinnerman'] || $prev['normal'] || $prev['guest'])) die("Access denied.");
    
    $statement = $mysqli->prepare($sql);

    $statement->execute();
    $statement->bind_result($dish_name ,$charge ,$dish_id);
    
    $menu_array;
    while($statement->fetch())
        $menu_array[$dish_id] = new dish($dish_name ,$charge ,$dish_id);

    return $menu_array;
}


?>