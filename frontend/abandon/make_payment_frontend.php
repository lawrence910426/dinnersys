<?php
session_start();
require_once('/../backend/user/user.php');

if($_SESSION['user'] == null) die("haven't login yet. <br>");
$prev = unserialize($_SESSION['user'])->get_prev_code();
if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied. <br>");
?>

<html>
    <body>
        <iframe src="query_order.php" width="90%" height="50%">
            your browser doesn't support iframe tag.
        </iframe>

        <br />
        
        <form action="../backend/backend.php">
            <h3>請輸入要繳款的人的座號</h3>
            <input type="text" id="user_id" name="user_id"/>
            
            <br />
            <h3>請輸入他點的餐的編號</h3>
            <input type="text" id="dish_id" name="dish_id"/>
            
            <input type="submit"/>
            
            <input type="hidden" value="make_payment" name="cmd" id="cmd"/>
        </form>
    </body>
</html>