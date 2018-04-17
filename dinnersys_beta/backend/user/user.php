<?php

require_once (__DIR__ . "/../json/json_format.php");

class user implements json_format
{
    public $id;
    public $name = "";
    public $class_no;
    public $able_serv;
    
    function __construct($usr_id ,$name ,$class_no)
    {
        $this->id = $usr_id;
        $this->name = $name;
        $this->class_no = $class_no;
    }
    
    public function init_serv()
    {
        $services = get_able_oper($this->id);
        $_SESSION['able_serv'] = serialize($services);
        foreach($services as $key => $value)
            $this->able_serv[$key] = true;
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
            '{"id":"' . json_output::filter($this->id) . 
            '","name":"' . json_output::filter($this->name) .
            '","class_no":"' . json_output::filter($this->class_no) .
            '","valid_oper":' . json_output::array_to_json($this->able_serv) . '}';

        return $data;
    }
}

?>