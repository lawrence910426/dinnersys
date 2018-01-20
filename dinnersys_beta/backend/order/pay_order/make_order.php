<?php
require_once('order/order.php');

function make_order($user ,$dish)
{
    if($user == null) die("Access denied.");
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'] || $prev['normal'])) die("Access denied.");
    
    $today = date("Y-m-d");
    $sql_command = "
    INSERT INTO orders (
        user_id, 
		user_name, 
		dish_id ,
		order_date ,
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
    $statement->bind_param('dsdsd'
        ,$user->user_id
        ,$user->user_name
        ,$dish->dish_id
        ,$today
        ,$dish->charge);

    $statement->execute() or die("Error making order. Please contact lawrence, 0975192145");

    $statement->close();
    
    echo "<br>你已經點餐成功<br><br>";
    $ord = new order($dish ,$user ,$today);
    $ord->show_order();
    echo "<br><br> <a href=\"../frontend/\"> 回到首頁... </a>";
    return $ord;
}

?>