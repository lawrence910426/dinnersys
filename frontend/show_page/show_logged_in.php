<?php

echo ($_SESSION['user'] != null ? "你已經成功登入" : "你尚未登入系統") . "<br>";
unserialize($_SESSION['user'])->show_user(true);

?>