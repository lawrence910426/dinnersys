<?php

function logout()
{
    $cmd = "CALL logout(?);";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($cmd);
    $statement->bind_param('i' ,unserialize($_SESSION['user'])->id);
    $statement->execute();
    
    $_SESSION['user'] = null;
}
    
?>