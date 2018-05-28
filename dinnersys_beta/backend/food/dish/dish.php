<?php

class dish implements json_format
{
    public $id;
    public $name;
    public $charge;
    
    public $factory;
    public $ingre = [];
    
    public $is_custom;
    public $is_idle;
    
    public function __construct($id ,$name ,$charge ,$is_idle ,$is_custom ,$ingre ,$factory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->charge = $charge;
        $this->factory = $factory;
        $this->is_idle = $is_idle;
        $this->is_custom = $is_custom;
        foreach($ingre as $ingredient) 
            array_push($this->ingre ,$ingredient);
    }
    
    public function get_json()
    {
        $json = 
            '{"dish_name":"' . json_output::filter($this->name) .
            '","dish_id":"' . json_output::filter($this->id) . 
            '","dish_cost":"' . json_output::filter($this->charge) .
            '","is_custom":"' . json_output::filter($this->is_custom) . 
            '","is_idle":"' . json_output::filter($this->is_idle) . 
            '","ingre":' . json_output::array_to_json($this->ingre) . 
            ($this->factory != null ? ',"factory":' . $this->factory->get_json() : '') . '}';
        return $json;
    }
}

?>