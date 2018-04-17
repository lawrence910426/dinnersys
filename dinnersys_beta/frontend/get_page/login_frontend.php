<?php 
    session_start();
    require_once(__DIR__ . "/../check_mobile.php");
?>

<html <?php if(check_mobile()) echo 'class="phone_view"'; ?>>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, height=device_height" />
        <link rel="stylesheet" type="text/css" href="../css/theme.css" />
    </head>
    
    <body>
        <div class="content">
            <form action="../../backend/backend.php">
                <h3>請輸入你的座號 ex.[11707]</h3>
                <input type="text" id="id" name="id"/>
                
                <br />
                <h3>請輸入你的密碼 ex.[1234] </h3>
                <h3> ps.預設密碼是1234</h3>
                <input type="password" id="password" name="password"/>
                
                <br /> <br />
                
                <input type="submit" value="登入"/>
                
                <input type="hidden" value="login" name="cmd" id="login"/>
            </form>
        </div>
    </body>
</html>