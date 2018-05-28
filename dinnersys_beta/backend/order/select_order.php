<?php

function select_order($user_id ,$person ,$class ,$class_no ,$grade ,$yr)
{
    $vege = ($_REQUEST['vege'] === null ? null : $_REQUEST['vege'] == 'true');
    $usr = ($_REQUEST['usr'] === null ? null : $_REQUEST['usr'] == 'true');
    $dm = ($_REQUEST['dm'] === null ? null : $_REQUEST['dm'] == 'true');
    $cafet = ($_REQUEST['cafet'] === null ? null : $_REQUEST['cafet'] == 'true');
    $facto = ($_REQUEST['facto'] === null ? null : $_REQUEST['facto'] == 'true');
    $esti_start = ($_REQUEST['esti_start'] === null ? null : date_api::is_valid_time($_REQUEST['esti_start'])->format('Y/m/d-H:i:s'));
    $esti_end = ($_REQUEST['esti_end'] === null ? null : date_api::is_valid_time($_REQUEST['esti_end'])->format('Y/m/d-H:i:s'));
    $factory_id = $_REQUEST['factory_id'];
    
    #var_dump(get_defined_vars());
    
    $command = 
    "CALL select_order
        (? ,
        ? ,? ,? ,? ,
        ? ,? ,
        ? ,? ,? ,
        ? ,
        ? ,? ,?);";
    $mysqli = $_SESSION['sql_server'];
    $statement = $mysqli->prepare($command);
    
    $statement->bind_param('iiiiissiiiiiii', 
        $vege ,
        $usr ,$dm ,$cafet ,$facto ,
        $esti_start ,$esti_end ,
        $factory_id ,
        $user_id, $person , $class ,
        $class_no ,
        $grade ,$yr);

    $statement->execute();
    $statement->bind_result($id ,
                    $uid ,$seat_no ,$uname ,$class_no ,
                    $did ,$dname ,$dcharge ,
                    $mt_id ,$mt_charge ,
                    $esti_recv ,
                    $fid ,$fname ,
        $pid['u'] ,$paid['u'] ,$able_dt['u'] ,$paid_dt['u'] ,$freeze_dt['u'] ,     #u: user
        $pid['d'] ,$paid['d'] ,$able_dt['d'] ,$paid_dt['d'] ,$freeze_dt['d'] ,     #d: dinnerman
        $pid['c'] ,$paid['c'] ,$able_dt['c'] ,$paid_dt['c'] ,$freeze_dt['c'] ,     #c: cafeteria
        $pid['f'] ,$paid['f'] ,$able_dt['f'] ,$paid_dt['f'] ,$freeze_dt['f']);     #f: factory
    
    $result = []; 
    $cols = ['u' => 'user' ,'d' => 'dinnerman' ,'c' => 'cafeteria' ,'f' => 'factory'];
    while($statement->fetch())
    {
        $result[$id] = new order(
            $id ,
            new dish($did ,$dname ,$dcharge ,null ,null ,null ,
                new factory($fid ,$fname)) ,
            new user($uid ,$uname ,$class_no) ,
            $esti_recv
        );
        foreach($cols as $key => $value)
        {
            $result[$id]->payment[$value] = 
                new payment($pid[$key] ,
                $paid[$key] ,$able_dt[$key] ,$paid_dt[$key] ,$freeze_dt[$key] ,
                $value ,$mt_charge);
        }
    }
    return $result;
}

?>