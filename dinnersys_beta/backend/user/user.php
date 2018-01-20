<?php


class user
{
    public $user_id = -1;
    public $user_name = "";
    public $previleges = 0;

    public $prev_code = [1 => "guest", 2 => "normal", 4 => "dinnerman", 8 => "admin"];
    public $prev_code_length = 4;


    function __construct($id, $name, $prev)
    {
        $this->user_id = $id;
        $this->user_name = $name;
        $this->previleges = $prev;
    }

    public function show_user($redir)
    {
        $redirect = $redir;
        include('show_user.php');
    }

    public function get_prev_string()     //output: [guest ,normal]
    {
        if($this->previleges == -1) return "virtual user";
        
        $prev_name = "";
        $tmp = $this->previleges;
        for ($i = $this->prev_code_length - 1; $i != -1; $i--)
            if ($tmp - pow(2 ,$i) >= 0) {
                $prev_name .= $this->prev_code[pow(2 ,$i)] . ", ";
                $tmp -= pow(2 ,$i);
            }
        
        $prev_name = str_replace("admin" ,"系統管理員" ,$prev_name);
        $prev_name = str_replace("dinnerman" ,"管午餐的人" ,$prev_name);
        $prev_name = str_replace("normal" ,"普通人" ,$prev_name);
        $prev_name = str_replace("guest" ,"訪客" ,$prev_name);
        return $prev_name;
    }
    
    public function get_prev_code()     //output:   $arr['admin'] = true
    {
        if($this->previleges == -1) 
            return array(1 => false ,2 => false ,3 => false ,4 => false);
        
        $prevs = null;
        $tmp = $this->previleges;
        for ($i = $this->prev_code_length - 1; $i != -1; $i--)
            if ($tmp - pow(2 ,$i) >= 0) 
            {
                $prevs[$this->prev_code[pow(2 ,$i)]] = true;
                $tmp -= pow(2 ,$i);
            }
            else
                $prevs[$this->prev_code[pow(2 ,$i)]] = false;
        return $prevs;
    }
    
    public function get_order()
    {
        require_once('/../order/get_orders.php');
        return get_user_orders($this);
    }
    
    function get_ip()
    {
        $ip = "";
        if (!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }else{
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        return $ip;
    }

}

?>