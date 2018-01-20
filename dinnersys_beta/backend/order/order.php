<?php

require_once ("./user/user.php");
require_once ("./menu/dish.php");

class order
{
    public $dish;
    public $user;
    public $paid = false;
    public $date = "";

    public function __construct($dish, $user ,$date)
    {
        $this->dish = $dish;
        $this->user = $user;
        $this->paid = false;
        $this->date = $date;
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

    public function show_order()
    {
        echo "使用者資訊--------------------------- <br>";
        $this->user->show_user(false);
        
        echo "<br>餐點資訊--------------------------- <br>";
        $this->dish->show_dish();
        
        echo "<br>繳款資訊--------------------------- <br>";
        echo ($this->paid == true ? "你已經繳清" : "你尚未繳清") . "<br>";
    }
}
?>