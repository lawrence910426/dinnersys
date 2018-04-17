<?php 
    session_start();
    
    require_once(__DIR__ . "/../backend/user/user.php");
    require_once(__DIR__ . "/check_mobile.php");
    if($_SESSION['user'] == null)
        header('Location: '. '../frontend/get_page/login_frontend.php');
?>

<html <?php if(check_mobile()) echo 'class="phone_view"'; ?>>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, height=device_height" />
        <link rel="stylesheet" type="text/css" href="css/theme.css" />
    </head>
    
    <body>
        <div class="content">
            <h1> 午餐系統 </h1>
            <br /> 
            
            <?php 
                if($_SESSION['user'] != null)
                {
                    $user = unserialize($_SESSION['user']);
                    echo "<br> <br>";
                    
                    echo '<a href="../backend/backend.php?cmd=show_menu&plugin=no"> 顯示菜單 </a> <br><br>';
                    
                    echo '<a href="../backend/backend.php?cmd=show_order&type=self&payment_filter=junk&date_filter=junk&person_filter=junk&plugin=no"> 點了什麼 </a> <br><br>';
                    
                    echo '<a href="../backend/backend.php?cmd=show_order&payment_filter=nothing&date_filter=week&person_filter=class&type=junk&plugin=no&class_no=-1"> 這周點了什麼 </a> <br><br>';
                    
                    echo '<a href="../backend/backend.php?cmd=show_class_order&payment_filter=nothing&date_filter=today&person_filter=class&type=junk&plugin=no&class_no=-1"> 全班點了什麼 </a> <br><br>';
                    
                    echo '<a href="../backend/backend.php?cmd=modify_menu"> 更新菜單 </a> <br><br>';
                    
                    echo '<a href="../backend/backend.php?cmd=logout"> 登出 </a> <br><br>';
                    
                    echo '<a href="../frontend/get_page/change_password_frontend.php"> 更改密碼 </a> <br><br>';
                }
            ?>
            
            <br /> <a href="https://play.google.com/store/apps/details?id=com.dinnersys.frontend.dinnersys_frontend"> 使用 Android App </a> <br />
            <br /> <a href="https://goo.gl/forms/uwCYSF4hBFRUCfjC2"> 登記 iOS App </a>
            
            <br /> <hr />
        </div>
    </body>
</html>