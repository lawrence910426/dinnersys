<?php

class backend_main
{
    public $order_handler;
    
    function __construct()
    {
        require_once (__DIR__ . '/order_handler.php');
        require_once (__DIR__ . '/../menu/get_menu.php');
        require_once (__DIR__ . '/../user/login.php');
        require_once (__DIR__ . '/../menu/update_menu.php');
        require_once (__DIR__ . '/../order/get_orders.php');
        require_once (__DIR__ . '/../order/fetch_order.php');
        require_once (__DIR__ . '/../order/pay_order/make_order.php');
        require_once (__DIR__ . '/../order/pay_order/date_api.php');
        require_once (__DIR__ . '/../order/pay_order/payment/process_payment.php'); 
        require_once (__DIR__ . '/../order/pay_order/payment/set_payment.php');
        require_once (__DIR__ . '/../order/pay_order/delete_order.php');
        require_once (__DIR__ . '/../order/order.php');
        require_once (__DIR__ . '/../json/json_format.php'); 
        require_once (__DIR__ . '/../json/json_output.php'); 
        require_once (__DIR__ . '/../user/logout.php');
        $this->order_handler = new order_handler();
        
    }
    
    function init_serv()    #start a new connection.
    {
        $server_connection = new mysqli("localhost", "root", "2rjurrru", "dinnersys");
        mysqli_set_charset($server_connection ,"utf8");
        $_SESSION['sql_server'] = $server_connection;
    }
    
    function check_user()
    {
        if($_SESSION['user'] == null) return -1;
        $user = unserialize($_SESSION['user']);
        return unserialize($_SESSION['user']);
    }
    
    function menu_session()
    {
        $_SESSION['menu'] = serialize(get_menu());
    }
    
    function run()
    {
        session_start();
        header("Content-Type:text/html; charset=utf-8");
        
        $this->init_serv();
        $user = $this->check_user();
        
        if($user === -1 && $_REQUEST['cmd'] == 'login')
            $this->order_handler->process_order();
        if(!($user === -1))
        {
            $this->menu_session();
            $this->order_handler->process_order();
            
        }
    }
}

?>