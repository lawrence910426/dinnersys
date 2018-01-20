<?php

function make_payment($order)
{
    require_once('order/order.php');

    if($_SESSION['user'] == null) die("haven't login yet. <br>");
    $prev = unserialize($_SESSION['user'])->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied. <br>");
    
    
    $today = date('Y-m-d');
    $sql_command = "UPDATE orders 
        SET	charge_paid = 1
        WHERE order_date = \"$today\"
    	AND user_id = ?
    	AND dish_id = ?
        AND charge_paid = 0
        
        LIMIT 1;";
    
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($sql_command);
    
    if($order->user->user_id == null)
        die("unable to make a payment. this payment will not be processed.");
    
    $statement->bind_param('dd',
        $order->user->user_id ,
        $order->dish->dish_id);

    $statement->execute() or die("unable to do the payment.");
    
    $order->paid = true;
    
    echo "本次繳款資訊 <br><br>";
    $order->show_order();
}




?>