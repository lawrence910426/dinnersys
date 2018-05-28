<?php

class factory implements json_format
{
    public $id;
    public $name;
    public $lower_bound;
    public $prepare_time;
    public $upper_bound;
    public $disabled;
    
    public function __construct($id ,$name ,
        $lower_bound = null ,$prepare_time = null ,$upper_bound = null ,$disabled = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lower_bound = $lower_bound;
        $this->prepare_time = $prepare_time;
        $this->upper_bound = $upper_bound;
        $this->disabled = $disabled;
    }
    
    public function get_json()
    {
        $json = 
            '{"id":"' . json_output::filter($this->id) .
            '","name":"' . json_output::filter($this->name) .
            '","lower_bound":"' . json_output::filter($this->lower_bound) .
            '","prepare_time":"' . json_output::filter($this->prepare_time) .
            '","upper_bound":"' . json_output::filter($this->upper_bound) .
            '","disabled":"' . json_output::filter($this->disabled) . '"}';
        return $json;
    }
}
?>