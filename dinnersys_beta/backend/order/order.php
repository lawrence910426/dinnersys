<?php

require_once (__DIR__ . "/../user/user.php");
require_once (__DIR__ . "/../menu/dish.php");
require_once (__DIR__ . "/../json/json_format.php");

class order implements json_format
{
    public $dish;
    public $user;
    public $paid = false;
    public $order_date = "";
    public $receive_date = "";

    public function __construct($dish, $user, $ord_date = NULL ,$recv_date = NULL)
    {
        $this->dish = $dish;
        $this->user = $user;
        $this->paid = false;
        $this->order_date = ($ord_date == NULL ? date('Y-m-d') : $ord_date);
        $this->receive_date = ($recv_date == NULL ? date('Y-m-d') : $recv_date);
    }

    public function do_payment()
    {
        if ($dish != null && $user != null && $paid != null)
            if ($paid == false) {
                $paid = true;
                return "finished payment";
            } else
                if ($paid == true) {
                    return "already paid. your money would be refund.";
                }
    }

    public function show_order() #a temporary way to show the order.
    {
        echo "使用者資訊--------------------------- <br>";
        $this->user->show_user(false);
        
        echo "<br>餐點資訊--------------------------- <br>";
        $this->dish->show_dish();
        
        echo "<br>繳款資訊--------------------------- <br>";
        echo ($this->paid == true ? "你已經繳清" : "你尚未繳清") . "<br>";
    }
    
    public function get_json()
    {
         $data = 
             '{"user_id" : "' . json_output::filter($this->user->user_id) . 
             '","user_name" : "' . json_output::filter($this->user->user_name) . 
             '","dish_id" : "' . json_output::filter($this->dish->dish_id) . 
             '","dish_name" : "' . json_output::filter($this->dish->name) . 
             '","dish_charge" : "' . json_output::filter($this->dish->charge) . 
             '","paid_status" : "' . ($this->paid == true ? "您已經成功付款" : "您尚未付款") . 
             
             '","user" : '  . $this->user->get_json() .  
             ',"dish" : ' . $this->dish->get_json() .
             
             ',"recv_date" : "' . json_output::filter($this->receive_date) .
             '","order_date" : "' . json_output::filter($this->order_date) . '"}';
         return $data;
    }

}
?>