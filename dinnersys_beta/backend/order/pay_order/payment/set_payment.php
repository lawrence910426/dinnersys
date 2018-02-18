<?php
require_once(__DIR__ . '/../../order.php');

function set_payment($order ,$set_parameter ,$charge_criteria)
{
    if($_SESSION['user'] == null) die("haven't login yet. <br>");
    $prev = unserialize($_SESSION['user'])->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied. <br>");
    
    $sql_command = "UPDATE orders   
        $set_parameter   
        WHERE datediff(order_date ,?) = 0  
        AND user_id = ?  
    	AND dish_id = ?  
        AND datediff(receive_date ,?) = 0  
        $charge_criteria  
        LIMIT 1;";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    if($order->user->user_id == null)
        die("unable to make a payment. this payment will not be processed.");
    
    $statement->bind_param('sdds',
        $order->order_date ,
        $order->user->user_id ,
        $order->dish->dish_id ,
        $order->receive_date);

    $statement->execute() or die("unable to do the payment.");
    
    $order->paid = ($set_parameter == "SET charge_paid = 1" ? true : false);
    
    return $order;
}




?>