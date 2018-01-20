<?php

require_once('order.php');

function fetch_order($selection_criteria)
{
    $mysqli = $_SESSION['sql_server'];
    $today = date('Y-m-d');
    $sql = "SELECT * FROM orders WHERE order_date = \"$today\"" . $selection_criteria. ";";
    
    $statement = $mysqli->prepare($sql);

    $statement->execute();
    $statement->bind_result(
        $user_id, 
		$user_name, 
		$dish_id ,
		$order_date ,
		$charge ,
		$charge_paid);
    
    $orders = null;
    $counter = 0;
    
    while($statement->fetch())
    {
        $dish_name = unserialize($_SESSION['menu'])[$dish_id]->name;
        $order = new order(
                new dish(
                    $dish_name ,
                    $charge ,
                    $dish_id
                    ) ,
                new user(
                    $user_id
                    ,$user_name
                    ,-1
                ) ,
                $order_date
            );
        $order->paid = $charge_paid;
        $orders[$counter++] = $order;
    }
        
    return $orders;
}

?>