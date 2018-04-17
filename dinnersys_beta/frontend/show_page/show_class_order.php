<?php

$prev = unserialize($_SESSION['user'])->get_prev_code();
if(!($prev['dinnerman'] || $prev['factory'] || $prev['admin'])) die("Access denied."); 

$orders = unserialize($_SESSION['orders']);
$menu = unserialize($_SESSION['menu']);
$data = array();
foreach($menu as $value) $data[$value->dish_id] = array($value);

$sum = 0;$paid_sum = 0;
foreach($orders as $ord) array_push($data[$ord->dish->dish_id] ,$ord);
$user_id = unserialize($_SESSION['user'])->user_id;

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" type="text/css" href="../frontend/css/theme.css" />
    </head>
    <body>
        <?php $show_order = false; include(__DIR__ . '/show_order_filter.php'); ?>
        <div class="content">
            <table style="width: 90%">
                <tr>
                    <th>餐名</th>
                    <?php if($prev['dinnerman'] || $prev['admin']) echo '<th>微調</th>'; ?>
                    <?php if($prev['dinnerman'] || $prev['admin']) echo '<th>已付</th> '; else echo '<th>人數</th> '; ?>   
                    <?php if($prev['dinnerman'] || $prev['admin']) echo '<th>全體</th> '; ?>     
                </tr>
                
                <?php
                    $counter = -1;
                    foreach($menu as $dish)
                    {
                        if(++$counter == 5)
                        {
                            echo '<tr> <td align="center"> -------------------- </td> </tr>';    
                            $counter = 0;
                        }
                        
                        $name = "";
                        $more_href = "";
                        $less_href = "";
                        $payment_href = "";
                        $rvspay_href = "";
                        $sum = 0;
                        $paid_sum = 0;
                        foreach($data[$dish->dish_id] as $value)
                        {
                            if(get_class($value) == "order")
                            {
                                $sum += 1;
                                if($value->paid) $paid_sum += 1; 
                            }
                            if(get_class($value) == "dish")
                            {
                                $name = $value->name . ' ' . $value->charge . '$';
                                $more_href = "backend.php?cmd=make_order&dish_id=" . $value->dish_id . "&date=" . date("Y-m-d");
                                $less_href = "backend.php?cmd=delete_order&dish_id=" . $value->dish_id . "&recv_date=" . date("Y-m-d") . "&order_date=" . date("Y-m-d");
                                $payment_href = "backend.php?cmd=make_payment&dish_id=" . $value->dish_id . "&user_id=" . $user_id . "&recv_date=" . date("Y-m-d") . "&order_date=" . date("Y-m-d");
                                $rvspay_href = "backend.php?cmd=reverse_payment&dish_id=" . $value->dish_id . "&user_id=" . $user_id . "&recv_date=" . date("Y-m-d") . "&order_date=" . date("Y-m-d");
                            }
                        }
                        if($prev['admin'] || $prev['dinnerman'])
                            echo 
                            '<tr>
                                <td> <p>' . $name . '</p> </td>
                                <td> 
                                    <button onclick="location.href = \'' . $more_href . '\';">增加</button> 
                                    <button onclick="location.href = \'' . $less_href . '\';">減少</button> <br />
                                    <button onclick="location.href = \'' . $payment_href . '\';">繳款</button> 
                                    <button onclick="location.href = \'' . $rvspay_href . '\';">退款</button> 
                                </td>
                                
                                <td> <p style="color: red;">' . $paid_sum . '</p> </td>
                                <td> <p style="color: green;">' . $sum . '</p> </td>
                            </tr>';
                        else
                            echo 
                            '<tr>
                                <td> <p align="center">' . $name . '</p> </td>
                                <td> <p style="color: red;" align="center">' . $paid_sum . '</p> </td>
                            </tr>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>


<!--
             
                
                    

             