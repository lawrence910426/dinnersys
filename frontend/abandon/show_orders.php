
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    
    
    <body>
        <table style="width:90%">
            <tr>
                <th>餐點的菜名</th>
                <th>餐點要價</th> 
                <th>餐點編號</th>
                <th>購買者名稱</th>
                <th>購買者編號</th>
                <th>點餐日期</th>
                <th>繳款狀況</th>
                <th>繳款按鈕</th>
            </tr>
            
<?php
    $counter = 0;
    $orders = unserialize($_SESSION['orders']);
    $charge_sum = 0;
    
    foreach($orders as $ord)
    {
        $dish_name = $ord->dish->name;
        $dish_charge = $ord->dish->charge;
        $dish_id = $ord->dish->dish_id;
        $user_name = $ord->user->user_name;
        $user_id = $ord->user->user_id;
        $date = $ord->order_date;
        $paid = ($ord->paid == true ? "已經成功付清" : "尚未付清");
        
        if($counter == 5) 
        {
            echo "<tr>
                <style> td{ color:black; } </style>
                <td>------------</td>
                <td>------------</td> 
                <td>------------</td>
                <td>------------</td>
                <td>------------</td> 
                <td>------------</td>
                <td>------------</td>
                </tr>";
            $counter = 0;
        }
        
        echo "<tr>
                <style>td{color: black}</style>
                <td>$dish_name</td>
                <td>$dish_charge</td> 
                <td>$dish_id</td>
                <td>$user_name</td>
                <td>$user_id</td> 
                <td>$date</td>
                <td>$paid</td>
                "
                . ($ord->paid == false ?
                    "<td><button onclick=\"location.href = '../backend/backend.php?cmd=make_payment&user_id=$user_id&dish_id=$dish_id&recv_date=" 
                    . date("Y-m-d") . "&order_date=" . date("Y-m-d") . "';\"> 繳費 </button>"
                    : "<td>已繳費<td>")
        . "</tr>";
        
        $counter += 1;
        
        $charge_sum += $dish_charge;
    }
    
    echo "<h3> 本頁面中餐點金額總和: $charge_sum </h3>"

?>
            
        </table>
    <a href="../frontend/"> 回到首頁... </a>
    </body>
</html>