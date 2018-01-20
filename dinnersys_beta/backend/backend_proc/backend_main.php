<?php

class backend_main
{
    public $order_handler;
    
    function __construct()
    {
        header("Content-Type:text/html; charset=utf-8");
        require_once('order_handler.php');
        $this->order_handler = new order_handler();
    }
    
    function init_serv()    #start a new connection.
    {
        $server_connection = new mysqli("localhost", "root", "2rjurrru", "dinnersys");
        mysqli_set_charset($server_connection ,"utf8");
        $_SESSION['sql_server'] = $server_connection;
    }
    
    function check_login()
    {
        if($_SESSION['user'] == null) return -1;
        return unserialize($_SESSION['user']);
    }
    
    function menu_session()
    {
        require_once ('menu/get_menu.php');
        $_SESSION['menu'] = serialize(get_menu());
    }
    
    function run()
    {
        session_start();
        $this->init_serv();
        $user = $this->check_login();
        if($user === -1 && $_GET['cmd'] == 'login')
            $this->order_handler->process_order();
        if(!($user === -1))
        {
            $this->menu_session();
            $this->order_handler->process_order();
        }
    }
}

?>