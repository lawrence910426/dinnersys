<?php
    require_once(__DIR__ . "/../../backend/backend_proc/date_api.php");
    require_once(__DIR__ . "/../../backend/order/order.php");
    
    $orders = unserialize($_SESSION['orders']);
    $date_array = date_api::get_weekday_array();

    $catagorized = [
        "Monday" => [] ,
        "Tuesday" => [] ,
        "Wednesday" => [] ,
        "Thursday" => [] ,
        "Friday" => []
    ];
    foreach($orders as $key => $value)
    {
        $weekday = $date_array[$value->receive_date];
        if($weekday == null) continue;
        array_push($catagorized[$weekday] ,serialize($value));
    }
    
    $prev = unserialize($_SESSION['user'])->get_prev_code();
    $having_auth = $prev['admin'] || $prev['dinnerman'];
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" type="text/css" href="../frontend/css/theme.css" />
    </head>
    <body>
        <?php $show_order = true; include(__DIR__ . '/show_order_filter.php'); ?>
        <hr />
        <?php
            $week_sum = 0;
            foreach($catagorized as $weekday => $data)
            {
                echo '<div class="content">';
                echo "<h1> $weekday </h1> <br />";
                echo '<table style="width:100%"> <tr> <th>座號</th> <th>餐點</th> <th>繳款</th> <th>取消</th> </tr>';
                $counter = 0; $charge_sum = 0;
                foreach($data as $key => $value)
                {
                    if($counter == 5)
                    {
                        echo "<tr> <td>------------------</td> </tr>";
                        $counter = 0;
                    }
                    $counter += 1;
                    
                    $value = unserialize($value);
                    $user_id = $value->user->user_id;
                    $user_name = $value->user->user_name;
                    $dish_id = $value->dish->dish_id;
                    $dish_name = $value->dish->name;
                    $dish_charge = $value->dish->charge;
                    $charge_sum += $value->dish->charge;
                    
                    $recv_date = $value->receive_date;
                    $order_date = $value->order_date;
                    
                    $payment = ($having_auth ?
                        ($value->paid == false ? " <a href=\"backend.php?cmd=make_payment&dish_id=$dish_id&user_id=$user_id&recv_date=$recv_date&order_date=$order_date\"> 付款 </a> " 
                                        : " <a href=\"backend.php?cmd=reverse_payment&dish_id=$dish_id&user_id=$user_id&recv_date=$recv_date&order_date=$order_date\"> 取消付款 </a> ") :
                        ($value->paid ? "已經付款" : "尚未付款"));
                        
                    if($user_id == unserialize($_SESSION['user'])->user_id)
                    {
                        if($value->paid == false) $reverse = " <a href=\"backend.php?cmd=delete_order&recv_date=$recv_date&order_date=$order_date&dish_id=$dish_id\"> 取消此點單 </a> ";
                        else $reverse = "請先取消付款";
                    }
                    else $reverse = "他點了這份餐。 :)";
                        
                    echo "<tr> <td>$user_id</td> <td>$dish_name $dish_charge\$</td> <td>$payment</td> <td>$reverse</td> </tr>";
                }
                echo "</table> <h2 align=\"right\">Σ $weekday $charge_sum</h2> <hr />";
                $week_sum += $charge_sum;
                echo '</div>';
            }
        ?>
    </body>
</html>