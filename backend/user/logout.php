<?php

function logout()
{
    $_SESSION['user'] = null;
    include (__DIR__ . "/../../frontend/show_page/show_logged_out.php");
}
    
?>