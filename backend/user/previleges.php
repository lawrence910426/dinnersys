<?php

class previleges
{
    private $prev_code = 
        [1 => "guest",
         2 => "normal", 
         4 => "dinnerman",
          8 => "admin"];
    private $translate = 
        ["guest" => "訪客" ,
         "normal" => " 使用者",
         "dinnerman" => "管午餐的人",
         "admin" => "系統管理員"];
    private $prev_code_length = 4;
    public $previleges;
    public $prev;
    
    function __construct($prev_number)
    {
        $this->previleges = $prev_number;
        $this->init_prev_code();
    }
    
    public function get_prev_string()     //output: [guest ,normal]
    {
        if($this->previleges == -1) return "virtual user";
        
        $prev_name = "";
        $tmp = $this->previleges;
        for ($i = $this->prev_code_length - 1; $i != -1; $i--)
            if ($tmp - pow(2 ,$i) >= 0) 
            {
                $prev_english = $this->prev_code[pow(2 ,$i)];
                $prev_name .= $this->translate[$prev_english] . ", ";
                $tmp -= pow(2 ,$i);
            }
        return $prev_name;
    }
    
    private function init_prev_code()     //output:   $prev['admin'] = true
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
        $this->prev = $prevs;
    }
    
    public function get_prev_code()
    {
        return $this->prev;
    }
}

?>