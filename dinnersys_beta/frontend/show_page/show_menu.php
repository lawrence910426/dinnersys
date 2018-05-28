
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    
    
    <body>
        <table style="width:90%">
            <tr>
                <th>餐點名稱</th>
                <th>餐點要價</th> 
                
                <th>取餐時間</th>      
            </tr>
            
<?php
    $menu = unserialize($_SESSION['menu']);
    $dates = date_api::get_date_array();
    
    $mon = $dates['Monday'];
    $tue = $dates['Tuesday'];
    $wed = $dates['Wednesday'];
    $thu = $dates['Thursday'];
    $fri = $dates['Friday'];
    
    foreach($menu as $m)
    {
        $id = $m->dish_id;        
        echo "<tr>
                <td>$m->name</td>
                <td>$m->charge</td> 
                
                <td> <a href=\"backend.php?cmd=make_order&dish_id=$id&date=$mon\"> 禮拜一送到 </a> </td> 
                <td> <a href=\"backend.php?cmd=make_order&dish_id=$id&date=$tue\"> 禮拜二送到 </a> </td> 
                <td> <a href=\"backend.php?cmd=make_order&dish_id=$id&date=$wed\"> 禮拜三送到 </a> </td>  
                <td> <a href=\"backend.php?cmd=make_order&dish_id=$id&date=$thu\"> 禮拜四送到 </a> </td>
                <td> <a href=\"backend.php?cmd=make_order&dish_id=$id&date=$fri\"> 禮拜五送到 </a> </td>  
        </tr>";
    }

?>
            
        </table>
        
        
        
        
<?php
if($_REQUEST['no_redirect'] != "true") echo "<br> <a style=\"float :right\" href=\"../frontend/\">回到首頁</a> <br>";
?>
    </body>
</html>