
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, height=device_height" />
        <link rel="stylesheet" type="text/css" href="../frontend/css/theme.css" />
    </head>
    
    
    <body>
    
        <table class="content">
            <tr>
                <th>名稱</th>
                <th>要價</th> 
                <th>時間</th>      
            </tr>
            <?php
                $menu = unserialize($_SESSION['menu']);
                $dates = date_api::get_date_array();
                
                $mon = $dates['Monday'];
                $tue = $dates['Tuesday'];
                $wed = $dates['Wednesday'];
                $thu = $dates['Thursday'];
                $fri = $dates['Friday'];
                
                $counter = 0;
                foreach($menu as $m)
                {
                    if($counter == 5)
                    {
                        $counter = 0;
                        echo "<tr> <td>----------------------------------</td> </tr>";
                    }
                    $counter += 1;
                    
                    $id = $m->dish_id;        
                    echo "<tr>
                            <td>$m->name</td>
                            <td>$m->charge</td> 
                            
                            <td> <select onchange=\"this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);\">  
                                <option value=\"\">尚未選擇</option> 
                                <option value=\"backend.php?cmd=make_order&dish_id=$id&date=$mon\">禮拜一送到</option>
                                <option value=\"backend.php?cmd=make_order&dish_id=$id&date=$tue\">禮拜二送到</option>
                                <option value=\"backend.php?cmd=make_order&dish_id=$id&date=$wed\">禮拜三送到</option>
                                <option value=\"backend.php?cmd=make_order&dish_id=$id&date=$thu\">禮拜四送到</option>
                                <option value=\"backend.php?cmd=make_order&dish_id=$id&date=$fri\">禮拜五送到</option>
                            </select> </td>
                    </tr>";
                }
            ?>
        </table>
        
        <hr />
        <div class="content" style="height:25px;">
            <a href="../frontend/index.php" style="float:right;font-size:20px"> 回到首頁    </a>
        </div>
    </body>
</html>