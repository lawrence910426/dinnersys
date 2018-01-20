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
    "make_payment" => "make_payment" ,
    "change_password" => "change_password"
];

function __construct()
{
    require_once ('./user/login.php');
    require_once ("./menu/update_menu.php");
    require_once ('./order/get_orders.php');
    require_once ("./order/pay_order/make_order.php");
    require_once ("./order/pay_order/make_payment.php");
    require_once ("./order/order.php");
}

function process_order()
{
    $cmd = $_GET['cmd'];
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
            $this->check_valid($_GET['id']) 
            ,$_GET['password']);
    if($user == null) die("error login. <br>");
    $_SESSION['user'] = serialize($user);
    echo ($_SESSION['user'] != null ? "你已經成功登入" : "你尚未登入系統") . "<br>";
    unserialize($_SESSION['user'])->show_user(true);
}

function logout() 
{
    include('./user/logout.php');
    include('./../frontend/show_page/show_logged_out.php');
}

function show_menu()
{
    include('./../frontend/show_page/show_menu.php');
    if($_GET['no_redirect'] != "true") echo "<br> <a href=\"../frontend/\"> 回到首頁... </a> <br>";
}

function update_menu()
{
    $dish_id = $this->check_valid($_GET['dish_id']);
    $dish_name = $_GET['dish_name'];
    update_menu($dish_id ,$dish_name ,unserialize($_SESSION['user']));
    
    header('Location: ../backend/backend.php?cmd=show_menu');
}

function show_order()
{
    $user = unserialize($_SESSION['user']);
    if($_GET['type'] == "all") $_SESSION['orders'] = serialize(get_all_orders($user));
    if($_GET['type'] == "unpaid") $_SESSION['orders'] = serialize(get_unpaid_orders($user));
    if($_GET['type'] == "paid") $_SESSION['orders'] = serialize(get_paid_orders($user));
    if($_GET['type'] == "self") $_SESSION['orders'] = serialize(get_user_orders($user));
    include("./../frontend/show_page/show_orders.php");
    echo "<br> <a href=\"../frontend/\"> 回到首頁... </a> <br>";
}

function make_order()
{
    $dish_id = $this->check_valid($_GET['dish_id']);
    $dish = unserialize($_SESSION['menu'])[$dish_id];
    if($dish == null) die("wrong dish id <br> ");
    
    $order = make_order(
        unserialize($_SESSION['user'])  
        ,$dish);
}

function make_payment()
{   
    $dish_id = $this->check_valid($_GET['dish_id']);
    $user_id = $this->check_valid($_GET['user_id']);
    
    make_payment(new order(
            unserialize($_SESSION['menu'])[$dish_id]
            ,new user
                ($this->check_valid($user_id)
                ,"virtual user"
                ,-1)
            ,date('Y-m-d')
        ));
    
    $refer = $_SERVER["HTTP_REFERER"];
    echo "<br><br> <a href=\"$refer\"> 回到上一頁... </a> <br>";
    echo "<br> <a href=\"../frontend/\"> 回到首頁... </a> <br>";
}

function change_password()
{
    $user_id = $this->check_valid($_GET['user_id']);
    $old_pswd = $_GET['old_pswd'];
    $new_pswd = $_GET['new_pswd'];
    
    require_once("user/change_password.php");
    $result = change_password($user_id ,$new_pswd ,$old_pswd);
    $user_id = $result['user_id'];
    $password = $result['pswd'];
    
    header('Location: '. "backend.php?cmd=login&id=$user_id&password=$password");
}
    
    
    
    
    
}

?>