<?php

class dish implements json_format
{
    public $id;
    public $name;
    public $charge;
    public $factory;
    
    public function __construct($id ,$name ,$charge ,$factory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->charge = $charge;
        $this->factory = $factory;
    }
    
    public function get_json()
    {
        $json = 
            '{"dish_name":"' . json_output::filter($this->name) .
            '","dish_id":"' . json_output::filter($this->id) . 
            '","dish_cost":"' . json_output::filter($this->charge) . '"' .
            ($this->factory != null ? ',"factory":' . $this->factory->get_json() : '') . '}';
        return $json;
    }
}

?>