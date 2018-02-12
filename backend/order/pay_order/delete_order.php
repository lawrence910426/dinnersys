<?php

function delete_order($order)       //only allows to delete the order that made by the user itself.
{
    $prev = unserialize($_SESSION['user'])->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'] || $prev['normal'])) die("Access denied. <br>");
    
    $sql_command = "DELETE FROM orders 
        WHERE receive_date = ?
    	AND user_id = ?
    	AND dish_id = ?
        AND charge_paid = 0
        AND order_date = ?
        LIMIT 1;";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    $statement->bind_param('sdds',
        $order->receive_date ,
        $order->user->user_id ,
        $order->dish->dish_id ,
        $order->order_date);

    $statement->execute() or die("Unable to delete the payment.");
    return true;
}

?>