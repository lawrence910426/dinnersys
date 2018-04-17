<?php

class factory implements json_format
{
    public $id;
    public $name;
    
    public function __construct($id ,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function get_json()
    {
        $json = 
            '{"id":"' . json_output::filter($this->name) .
            '","name":"' . json_output::filter($this->id) . '"}';
        return $json;
    }
}
?>