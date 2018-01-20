<?php 
session_start();
require_once('../../backend/user/user.php');

if($_SESSION['user'] == null) die("haven't login yet. <br>");
$prev = unserialize($_SESSION['user'])->get_prev_code();
if(!($prev['admin'] || $prev['dinnerman'] || $prev['normal'])) die("Access denied. <br>");

?>

<html>
    <body>
        <iframe src="../../backend/backend.php?cmd=show_menu&no_redirect=true" width="90%" height="50%">
            your browser doesn't support preview.
        </iframe>
        
        <form action="../../backend/backend.php">
            <h3>請輸入你想要點的那份餐的編號</h3>
            <h3>例如:我想要點蔥抓餅+蛋+雞排  那就可以在下面的輸入1(也就是蔥抓餅+蛋+雞排的編號)</h3>
            <input type="text" id="id" name="dish_id"/>
            
            <input type="submit"/>
            
            <input type="hidden" value="make_order" name="cmd" id="make_order"/>
        </form>
        
        <br /> <a href="../../frontend/"> 回到首頁... </a> <br />
    </body>
</html>