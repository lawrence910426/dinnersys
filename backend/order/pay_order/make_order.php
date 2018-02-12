<?php
require_once(__DIR__ . '/../order.php');

function make_order($order)
{
    $user = $order->user;
    $dish = $order->dish;
    
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'] || $prev['normal'])) die("Access denied.");
    
    $sql_command = "
    INSERT INTO orders (
        user_id, 
		dish_id ,
		order_date ,
        receive_date ,
		charge ,
		charge_paid)
    VALUES (
        ?			
        ,?
    	,?
    	,?	
        ,?			
    	,0
    );
    ";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    $statement->bind_param('ddssd'
        ,$user->user_id
        ,$dish->dish_id
        ,$order->order_date
        ,$order->receive_date
        ,$dish->charge);

    $statement->execute() or die("Error making order. Please contact lawrence, 0975192145");

    $statement->close();

    return $order;
}

?>