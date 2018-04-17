<?php

function update_dish($id ,$ingres)
{
    asort($ingres);
    $tmp = []; $counter = 0;
    foreach($ingres as $value)    
        $tmp[$counter++] = $value;
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "CALL update_dish(? ,
        ? ,? ,? ,? ,? ,
        ? ,? ,? ,? ,?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('iiiiiiiiiii' ,$id 
        ,$tmp[0] ,$tmp[1] ,$tmp[2] ,$tmp[3] ,$tmp[4]
        ,$tmp[5] ,$tmp[6] ,$tmp[7] ,$tmp[8] ,$tmp[9]);
    $statement->execute();
}

?>