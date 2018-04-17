<?php

require_once (__DIR__ . "/../json/json_format.php");

class order implements json_format
{
    public $id;
    public $user;
    public $dish;
    public $payment;        // $payment['usr'] = paymemt info;
    
    public $esti_recv;
    
    public function __construct($id ,$dish, $user, $recv_date)
    {
        $this->id = $id;
        $this->dish = $dish;
        $this->user = $user;
        $this->esti_recv = $recv_date;
    }
    
    public function get_json()
    {
         $data = 
             '{"id" : "' . json_output::filter($this->id) . 
             '","user" : ' . $this->user->get_json() . 
             ',"dish" : ' . $this->dish->get_json() .  
             ',"payment" : ' . json_output::array_to_json($this->payment) . 
             ',"recv_date" : "' . json_output::filter($this->esti_recv) . '"}';
         return $data;
    }

}
?>