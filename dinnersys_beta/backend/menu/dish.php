<?php
class dish
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
    
    public function show_dish()
    {
        echo "餐點名稱: $this->name <br>
            餐點要價: $this->charge <br>
            餐點編號: $this->dish_id <br>";
    }
}
?>



