<?php

function update_dish($id ,$idle ,$ingres)
{
    $data = []; $tmp = []; $counter = 0;
    foreach($ingres as $value)    
        $tmp[check_valid::white_list($value ,check_valid::$only_number)] = true;
    
    ksort($tmp);
    foreach($tmp as $key => $value) 
        $data[$counter++] = $key;
        
    
    $mysqli = $_SESSION['sql_server'];
    $sql = "SELECT update_dish(? ,?,
        ? ,? ,? ,? ,? ,
        ? ,? ,? ,? ,?)";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('iiiiiiiiiiii' ,$id ,$idle
        ,$data[0] ,$data[1] ,$data[2] ,$data[3] ,$data[4]
        ,$data[5] ,$data[6] ,$data[7] ,$data[8] ,$data[9]);
    $statement->execute();
    
    $statement->bind_result($result);
    if($statement->fetch()){
        if($result != "success") {
            throw new Exception($result);
        }
    } else {
        throw new Exception("Unable to fetch data from server.");   
    }    
}

?>