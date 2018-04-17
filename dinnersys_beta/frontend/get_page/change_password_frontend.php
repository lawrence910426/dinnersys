<?php
session_start();
require_once(__DIR__ . "/../../backend/user/user.php");

$user = unserialize($_SESSION['user']);
$user_id = $user->user_id;
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <style>
            .phone_view {
                transform-origin:left top;
                -ms-transform: scale(2.5); /* IE 9 */
                -webkit-transform: scale(2.5); /* Safari 3-8 */
                transform: scale(2.5); 
            }
            
            body{
                width: 100%;
                height:100%;
                background:#333333;
            }
            
            .content {
                width:97%;
                background:#99d6ff;
                border: 1px solid black;
                margin: 0 auto;
                text-align: center;
            }
        </style>
    </head>
    
    <body>
        <div class="content">
            <form action="../../backend/backend.php" method="get">
                <h3> 請輸入你的密碼 </h3>
                <input type="password" name="old_pswd" id="old_pswd"/>
                
                <br /><br />
                <h3> 請輸入你的新密碼 </h3>
                <input type="text" name="new_pswd" id="new_pswd"/>
                
                <br /><br />
                <input type="submit" value="確認更改密碼"/>
                
                <input type="hidden" name="cmd" id="cmd" value="change_password"/>
            </form>
        </div>
    </body>

</html>