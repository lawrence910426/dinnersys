<?php

require_once (__DIR__ . "/../json/json_format.php");
require_once (__DIR__ . "/previleges.php");

class user implements json_format
{
    public $user_id = -1;
    public $user_name = "";
    public $class_no = -1;
    public $prev;

    function __construct($id, $name, $prev ,$class_no)
    {
        $this->user_id = $id;
        $this->user_name = $name;
        $this->class_no = $class_no;
        $this->prev = new previleges($prev);
    }

    public function show_user($redir) #a temporary way to show the user.
    {
        $redirect = $redir;
        include('show_user.php');
    }
    
    public function get_order()
    {
        require_once('/../order/get_orders.php');
        return get_user_orders($this);
    }
    
    public function get_ip()
    {
        $ip = "";
        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else
            $ip = $_SERVER["REMOTE_ADDR"];
        
        return $ip;
    }
    
    public function get_json()
    {
        $data = 
            '{"user_id":"' . json_output::filter($this->user_id) . 
            '","user_name":"' . json_output::filter($this->user_name) .
            '","class":"' . json_output::filter($this->class_no) .
            '","previleges":"' . json_output::filter($this->prev->get_prev_string()) . 
            '","ipaddress":"' . json_output::filter($this->get_ip()) .'"}';

        return $data;
    }
    
    public function get_prev_string() { return $this->prev->get_prev_string(); }
    public function get_prev_code() { return $this->prev->get_prev_code(); }
}

?>