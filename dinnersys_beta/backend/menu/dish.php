<?php

require_once (__DIR__ . "/../json/json_format.php");
class dish implements json_format
{
    public $name = "";
    public $charge = 0;
    public $dish_id = 0;
    
    public function __construct($name ,$charge ,$dish_id)
    {
        $this->name = $name;
        $this->charge = $charge;
        $this->dish_id = $dish_id;
    }
    
    public function show_dish() #a temporary way to show the dish.
    {
        echo "餐點名稱: $this->name <br>
            餐點要價: $this->charge <br>
            餐點編號: $this->dish_id <br>";
    }
    
    public function get_json()
    {
        $json = 
            '{"dish_name":"' . json_output::filter($this->name) .
            '","dish_id":"' . json_output::filter($this->dish_id) . 
            '","dish_cost":"' . json_output::filter($this->charge) . '"}';
        return $json;
    }

}
?>