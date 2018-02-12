<?php
session_start();
require_once(__DIR__ . "/../../backend/user/user.php");

$user = unserialize($_SESSION['user']);
$user_id = $user->user_id;
?>

<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    
    <body>
        <form action="../../backend/backend.php" method="get">
            <h3> 請輸入你的密碼 </h3>
            <input type="password" name="old_pswd" id="old_pswd"/>
            
            <br /><br />
            <h3> 請輸入你的新密碼 </h3>
            <input type="text" name="new_pswd" id="new_pswd"/>
            
            <br /><br />
            <input type="submit" value="確認更改密碼"/>
            
            <input type="hidden" name="cmd" id="cmd" value="change_password"/>
            <?php echo "<input type=\"hidden\" name=\"user_id\" id=\"user_id\" value=\"$user_id\"/>"?>
        </form>

    </body>

</html>