<?php 
    session_start();
        
    require_once("../backend/user/user.php");
    if($_SESSION['user'] == null)
        header('Location: '. '../frontend/get_page/login_frontend.php');
?>

<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    
    <body>
        <h1> 午餐系統 2.0版本 </h1>
        <br />
        
        <?php 
            if($_SESSION['user'] != null)
            {
                $user = unserialize($_SESSION['user']);
                $user->show_user(false);
                echo "<br> <br>";
                
                $prev = $user->get_prev_code();
                
                echo '<a href="../backend/backend.php?cmd=show_menu"> 顯示菜單 </a> <br><br>';
                
                if($prev['normal'] || $prev['dinnerman'] || $prev['admin']) echo '<a href="../backend/backend.php?cmd=show_order&type=self"> 顯示你點了什麼 </a> <br><br>';
                else echo '<br>';
                
                if($prev['dinnerman'] || $prev['admin']) echo '<a href="../backend/backend.php?cmd=show_order&type=paid"> 顯示哪些餐點已經付清 </a> <br><br>';
                else echo '<br>';
                
                if($prev['dinnerman'] || $prev['admin']) echo '<a href="../backend/backend.php?cmd=show_order&type=unpaid"> 顯示哪些餐點尚未付清 </a> <br><br>';
                else echo '<br>';
                
                if($prev['dinnerman'] || $prev['admin']) echo '<a href="../backend/backend.php?cmd=show_order&type=all"> 顯示所有的點餐紀錄 </a> <br><br>';
                else echo '<br>';
                
                if($prev['admin']) echo '<a href="../frontend/get_page/update_menu_frontend.php"> 更改餐點名稱 </a> <br><br>';
                else echo '<br>';
                
                echo '<a href="../frontend/get_page/make_order_frontend.php"> 點餐 </a> <br><br>';
                
                echo '<a href="../backend/backend.php?cmd=logout"> 登出 </a> <br><br>';
                
                echo '<a href="../frontend/get_page/change_password_frontend.php"> 更改密碼 </a> <br><br>';
            }
        ?>
    
    
    </body>
</html>