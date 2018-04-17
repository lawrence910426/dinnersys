<?php

class payment implements json_format
{
    public $id;
    public $paid;
    
    public $able_dt;
    public $paid_dt;
    public $freeze_dt;
    
    public $name;
    public $charge;
    
    function __construct($id ,$paid ,$able_dt ,$paid_dt ,$freeze_dt ,$name ,$charge)
    {
        $this->id = $id;
        $this->paid = $paid;
        $this->able_dt = $able_dt;
        $this->paid_dt = $paid_dt;
        $this->freeze_dt = $freeze_dt;
        $this->name = $name;
        $this->charge = $charge;
    }
    
    public function get_json()
    {
        $data = 
             '{"id" : "' . json_output::filter($this->id) . 
             '","paid" : "' . ($this->paid ? 'true' : 'false') . 
             '","able_dt" : "' . json_output::filter($this->able_dt) . 
             '","paid_dt" : "' . json_output::filter($this->paid_dt) . 
             '","freeze_dt" : "' . json_output::filter($this->freeze_dt) . 
             '","name" : "' . json_output::filter($this->name) .
             '","charge" : "' . json_output::filter($this->charge) . '"}';
         return $data;
    }
}

?>