<?php
# 這只是一些中文字，避免檔案被存成ANSI碼。

require_once(__DIR__ . '/order.php');

function fetch_order($selection_criteria)
{
    $mysqli = $_SESSION['sql_server'];
    $sql = "SELECT * FROM orders ,users " . $selection_criteria. 
    " ORDER BY orders.user_id, orders.receive_date;";
    
    $statement = $mysqli->prepare($sql);

    $statement->execute();
    $statement->bind_result(
        $user_id, 
		$dish_id ,
		$order_date ,
		$charge ,
		$charge_paid ,
        $receive_date ,
        
        $user_id_key ,
        $user_name ,
        $password ,
        $previleges ,
        $class_no);
    
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
                    ,$previleges
                    ,$class_no
                ) ,
                $order_date,
                $receive_date
            );
        $order->paid = $charge_paid;
        $order->receive_date = $receive_date;
        $order->order_date = $order_date;
        $orders[$counter++] = $order;
    }
        
    return $orders;
}

?>