
<?php

$user = unserialize($_SESSION['user']);
if ($user->user_id == -1 or $user->user_name == "" or $user->previleges == 0) die("error");
$prev_name = $user->get_prev_string();
$ip = user::get_ip();

echo "當前使用者編號: " . $user->user_id . ",<br>
        當前使用者名稱: " . $user->user_name . ",<br>
        當前使用者權限: " . $prev_name . "<br>
        <br> 該使用者的ip位置: [" . $ip . "].....伺服器已經在紀錄本用戶.<br>";


if($redirect == true) echo '<br><a href="../frontend/">回到首頁......</a>';
    
?>
