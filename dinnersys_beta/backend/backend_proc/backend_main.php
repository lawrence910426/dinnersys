<?php

class backend_main
{
    public $order_handler;
    
    function __construct()
    {
        require_once (__DIR__ . '/order_handler.php');
        require_once (__DIR__ . '/date_api.php');
        require_once (__DIR__ . '/check_valid.php');
        
        require_once (__DIR__ . '/../other/get_able_oper.php');
        require_once (__DIR__ . '/../other/make_log.php');
        
        require_once (__DIR__ . '/../user/login.php');
        require_once (__DIR__ . '/../user/register.php');
        require_once (__DIR__ . '/../user/change_password.php');
        require_once (__DIR__ . '/../user/logout.php');
        
        require_once (__DIR__ . '/../food/get_food.php');
        require_once (__DIR__ . '/../food/menu/update_menu.php');
        require_once (__DIR__ . '/../food/menu/menu.php');
        require_once (__DIR__ . '/../food/factory/factory.php');
        require_once (__DIR__ . '/../food/factory/get_factory_info.php');
        require_once (__DIR__ . '/../food/dish/update_dish.php');
        require_once (__DIR__ . '/../food/dish/get_custom_dish_id.php');
        require_once (__DIR__ . '/../food/dish/dish.php');
        
        require_once (__DIR__ . '/../json/json_format.php'); 
        require_once (__DIR__ . '/../json/json_output.php'); 
        require_once (__DIR__ . '/../json/json_adjust.php');
        
        require_once (__DIR__ . '/../order/select_order.php');
        require_once (__DIR__ . '/../order/make_order.php');
        require_once (__DIR__ . '/../order/payment/payment.php');
        require_once (__DIR__ . '/../order/payment/set_payment.php');
        require_once (__DIR__ . '/../order/delete_order.php');
        require_once (__DIR__ . '/../order/order.php');
        require_once (__DIR__ . '/../order/check_recv.php');
        
        require_once (__DIR__ . '/../order/announce/announce.php');
        require_once (__DIR__ . '/../order/announce/handle_announce.php');
    }
    
    function init_serv()    #start a new connection.
    {
        $server_connection = new mysqli("localhost", "root", "2rjurrru", "dinnersys");
        mysqli_set_charset($server_connection ,"utf8");
        $_SESSION['sql_server'] = $server_connection;
    }
    
    function run()
    {
        session_start();
        header("Content-Type:text/html; charset=utf-8");
        
        $this->init_serv();
        $this->order_handler = new order_handler();
        $this->order_handler->process_order();
    }
}

?>