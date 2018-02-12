<?php

class order_handler
{

public $services = [
    "login" => "login" ,
    "logout" => "logout" ,
    "show_menu" => "show_menu" ,
    "update_menu" => "update_menu" ,
    "show_order" => "show_order" ,
    "make_order" => "make_order" ,
    "make_payment" => "set_payment" ,
    "reverse_payment" => "set_payment" ,
    "change_password" => "change_password" ,
    "delete_order" => "delete_order"
];

function process_order()
{
    $cmd = $_REQUEST['cmd'];
    $func = $this->services[$cmd];
    $this->$func();                     # A very danger way to call a function. #
}

function check_valid($id)
{
    if(!preg_match("/^[0-9]*$/" ,$id)) die("Access denied.");
    else return $id;
}

function login()
{
    $user = login(
            $this->check_valid($_REQUEST['id']) 
            ,$_REQUEST['password']);
    if($user == null) die("error login. <br>");
    $_SESSION['user'] = serialize($user);
    
    if($_REQUEST['plugin'] == "yes")
        json_output::output(unserialize($_SESSION['user']));
    else
        include (__DIR__ . '/../../frontend/show_page/show_logged_in.php');
}

function logout() 
{
    logout();
}

function show_menu()
{
    if($_REQUEST['plugin'] == "yes")
        json_output::output(unserialize($_SESSION['menu']));
    else
        include('./../frontend/show_page/show_menu.php');
}

function update_menu()
{
    $dish_id = $this->check_valid($_REQUEST['dish_id']);
    $dish_name = $_REQUEST['dish_name'];
    update_menu($dish_id ,$dish_name ,unserialize($_SESSION['user']));
    
    header('Location: ../backend/backend.php?cmd=show_menu');
}

function show_order()
{
    $person_filter = $_REQUEST['person_filter'];
    $date_filter = $_REQUEST['date_filter'];
    $payment_filter = $_REQUEST['payment_filter'];
    $handler = new get_orders();
    
    if($_REQUEST['type'] == "self") $handler->get_orders("week" ,"self" ,"nothing");       # For supporting the old versions.
    else $handler->get_orders($date_filter ,$person_filter ,$payment_filter);
    
    if($_REQUEST['plugin'] == "yes")
        json_output::output(unserialize($_SESSION['orders']));
    else 
        include(__DIR__ . "/../../frontend/show_page/show_week_order.php");
}

function make_order()
{
    $dish_id = $this->check_valid($_REQUEST['dish_id']);
    $dish = unserialize($_SESSION['menu'])[$dish_id];
    if($_REQUEST['date'] == null) $recv_date = date('Y-m-d'); # For supporting the old versions.
    else $recv_date = date_api::is_valid_time($_REQUEST['date']);
    if($dish == null) die("invalid dish id <br> ");
    
    $order = make_order(new order(
        $dish, unserialize($_SESSION['user']) ,
        date('Y-m-d') ,$recv_date
    ));
    
    if($_REQUEST['plugin'] == "yes")
        json_output::output((array) $order);
    else
    {
        $_SESSION['order'] = serialize($order);
        include(__DIR__ . "/../../frontend/show_page/show_finished_order.php");
    }
}

function set_payment()      //handles "make payment" and "reverse payment"
{   
    $dish = unserialize($_SESSION['menu'])[$this->check_valid($_REQUEST['dish_id'])];
    $user_id = $this->check_valid($_REQUEST['user_id']);
    $recv_date = date_api::is_valid_time($_REQUEST['recv_date']);
    $order_date = date_api::is_valid_time($_REQUEST['order_date']);
    if($dish == null) die("invalid dish id <br> ");
    
    $recipt = null;
    if($_REQUEST['cmd'] == "make_payment")
        $recipt = make_payment (new order(
            $dish ,new user ($user_id ,"unknown" ,-1 ,-1)
            ,$order_date ,$recv_date
        ));
    if($_REQUEST['cmd'] == "reverse_payment")
        $recipt = reverse_payment (new order(
            $dish ,new user ($user_id ,"unknown" ,-1 ,-1)
            ,$order_date ,$recv_date
        ));
    
    if($_REQUEST['plugin'] == "yes")
        json_output::output((array) $recipt);
    else
    {
        $_SESSION['recipt'] = serialize($recipt);
        include(__DIR__ . "/../../frontend/show_page/show_finished_payment.php");
    }
}

function change_password()
{
    $user_id = $this->check_valid($_REQUEST['user_id']);
    $old_pswd = $_REQUEST['old_pswd'];
    $new_pswd = $_REQUEST['new_pswd'];
    
    require_once("user/change_password.php");
    $result = change_password($user_id ,$new_pswd ,$old_pswd);
    $user_id = $result['user_id'];
    $password = $result['pswd'];
    
    header('Location: '. "backend.php?cmd=login&id=$user_id&password=$password");
}
    
function delete_order()
{
    $dish_id = $this->check_valid($_REQUEST['dish_id']);
    $recv_date = date_api::is_valid_time($_REQUEST['recv_date']);
    $order_date = date_api::is_valid_time($_REQUEST['order_date']);
    $order = new order(
        unserialize($_SESSION['menu'])[$dish_id],
        unserialize($_SESSION['user']),
        $order_date,
        $recv_date);
    if(delete_order($order)) include(__DIR__ . "/../../frontend/show_page/show_finished_delete_order.php");
    else echo "Failed to delete order <br>.";
}
    
}

?>