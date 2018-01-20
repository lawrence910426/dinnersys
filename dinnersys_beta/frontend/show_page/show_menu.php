
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    
    
    <body>
        <table style="width:90%">
            <tr>
                <th>餐點的菜名</th>
                <th>餐點要價</th> 
                <th>餐點編號</th>
            </tr>
            
<?php
    $counter = 0;
    $menu = unserialize($_SESSION['menu']);
    
    foreach($menu as $m)
    {
        if($counter == 5)
        {
            $counter = 0;
            echo "<tr>
                <td>-----------------</td>
                <td>-----------------</td> 
                <td>-----------------</td>
            </tr>";
        }
        echo "<tr>
                <td>$m->name</td>
                <td>$m->charge</td> 
                <td>$m->dish_id</td>
        </tr>";
        
        $counter += 1;
    }

?>
            
        </table>
    </body>
</html>