<?php

class menu implements json_format
{
    public $id;
    public $name;
    public $charge;
    
    public $dish_able;
    public $ingre_able;
    public $is_idle;
    
    public $factory;
    
    public function __construct(
        $id ,$name ,$charge ,
        $dish_able ,$ingre_able ,$is_idle ,
        $factory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->charge = $charge;
        
        $this->dish_able = $dish_able;
        $this->ingre_able = $ingre_able;
        $this->is_idle = $is_idle;
        
        $this->factory = $factory;
    }
    
    public function get_json()
    {
        $json = 
            '{"dish_name":"' . json_output::filter($this->name) .
            '","dish_id":"' . json_output::filter($this->id) . 
            '","dish_cost":"' . json_output::filter($this->charge) .
            '","dish_able":"' . ($this->dish_able ? 'true' : 'false') .
            '","ingre_able":"' . ($this->ingre_able ? 'true' : 'false') .
            '","is_idle":"' . ($this->is_idle ? 'true' : 'false') . '"' .
            ($this->factory != null ? ',"factory":' . $this->factory->get_json() : '') . '}';
        return $json;
    }
}

?>