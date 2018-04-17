<?php

class announce implements json_format
{
    public $id;
    public $msg;
    public $anno_type;
    public $esti_dt;
    public $device_id;
    
    public function __construct($id ,$msg ,$anno_type ,$esti_dt ,$device_id)
    {
        $this->id = $id;
        $this->msg = $msg;
        $this->anno_type = $user;
        $this->esti_dt = $esti_dt;
        $this->device_id = $device_id;
    }
    
    public function get_json()
    {
         $data = 
             '{"id" : "' . json_output::filter($this->id) . 
             '","msg" : "' . json_output::filter($this->msg) . 
             '","anno_type" : "' . json_output::filter($this->anno_type) .  
             '","esti_datetime" : "' . json_output::filter($this->esti_dt) . 
             '","device_id" : "' . json_output::filter($this->device_id) . '"}';
         return $data;
    }

}



?>