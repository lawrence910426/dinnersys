<?php
class order_handler
{


function __construct()
{
    if($_SESSION['user'] == null)
    {
        $user = login('guest' ,'guest' ,"NULL");
        $user->init_serv();
        $_SESSION['user'] = serialize($user);
    }
}

function process_order()
{
    $cmd = $_REQUEST['cmd'];
    $func = unserialize($_SESSION['able_serv'])[$cmd];
    $user = unserialize($_SESSION['user']);
    make_log($user->id ,$func ,$_SERVER['REQUEST_URI'] ,$user->get_ip());
    $this->$func();                     # A very danger way to call a function. #
}

function login()
{
    try
    {
        $id = check_valid::white_list($_REQUEST['id'] ,check_valid::$white_list_pattern);
        $pswd = check_valid::white_list($_REQUEST['password'] ,check_valid::$white_list_pattern);
        if($id == 'guest' && $pswd == 'guest') die("Not allow guest login.");
        $device_id = check_valid::white_list($_REQUEST['device_id'] ,check_valid::$white_list_pattern);
        $user = login($id ,$pswd ,$device_id);
        $user->init_serv();
        $_SESSION['menu'] = serialize(get_dish(null ,null));
    }
    catch(Exception $e) { die($e->getMessage()); }
    
    $_SESSION['user'] = serialize($user);
    json_output::output(unserialize($_SESSION['user']));
}

function logout() 
{
    logout();
    die("Successfully logout.");
}

function show_food()
{
    $id = ($_REQUEST['factory_id'] == null ? null : check_valid::white_list($_REQUEST['factory_id'] ,check_valid::$only_number));
    if($_REQUEST['cmd'] == 'show_dish') {
        $is_custom = ($_REQUEST['is_custom'] == null ? null : $_REQUEST['is_custom'] == 'true');
        $result = get_dish($id ,$is_custom);
    }
    if($_REQUEST['cmd'] == 'show_menu') $result = get_menu($id);
    json_output::output($result);
}

function update_food()
{
    try
    {
        if($_REQUEST['cmd'] == "update_menu")
        {
            $id = check_valid::white_list($_REQUEST['id'] ,check_valid::$only_number);
            $charge = check_valid::white_list($_REQUEST['charge'] ,check_valid::$only_number);
            $name = htmlspecialchars($_REQUEST['name']);
            $ingre_able = ($_REQUEST['ingre_able'] == 'true' ? true : false);
            $dish_able = ($_REQUEST['dish_able'] == 'true' ? true : false);
            $vege = check_valid::vege_check($_REQUEST['vege']);
            $idle = ($_REQUEST['idle'] == 'true' ? true : false);
            update_menu($id ,$charge ,$name ,$ingre_able ,$dish_able ,$vege ,$idle);
        }
        if($_REQUEST['cmd'] == "update_dish")
        {
            $id = check_valid::white_list($_REQUEST['id'] ,check_valid::$only_number);
            $ingre_id = $_REQUEST['ingres'];
            $is_idle = $_REQUEST['is_idle'] == 'true';
            update_dish($id ,$is_idle ,$ingre_id);
        } 
    }catch(Exception $e) {die($e->getMessage()); }
    die("Successfully updated food.");
}

function show_order()
{
    $user_id = unserialize($_SESSION['user'])->id;
    $person = $class = $grade = $yr = $class_no = null;
    
    try
    {
        switch($_REQUEST['cmd'])
        {
            case 'select_self':
                $person = true;
                break;
            case 'select_class':
                $class = true;
                break;
            case 'select_other':
                $user_id = ($_REQUEST['uid'] == null ? null : intval(check_valid::white_list($_REQUEST['uid'] ,check_valid::$only_number)));
                $person = $_REQUEST['person'] == 'true';
                $class = $_REQUEST['class'] == 'true';
                $class_no = ($_REQUEST['class_no'] == null ? null : intval(check_valid::white_list($_REQUEST['class_no'] ,check_valid::$only_number)));
                $grade = ($_REQUEST['grade'] == null ? null : intval(check_valid::white_list($_REQUEST['grade'] ,check_valid::$only_number)));
                $yr = ($_REQUEST['year'] == null ? null : intval(check_valid::white_list($_REQUEST['year'] ,check_valid::$only_number)));
                break;
            case 'select_everyone':
                break;
            default:
                throw new Exception();    
        }
        $result = select_order($user_id ,$person ,$class ,$class_no ,$grade ,$yr);
    }catch(Exception $e) {die($e->getMessage());}
    
    json_output::output($result);
}

function make_order()
{
    try
    {
        $dish_id = check_valid::white_list($_REQUEST['dish_id'] ,check_valid::$only_number);
        $dish = unserialize($_SESSION['menu'])[$dish_id];
        $recv = date_api::check_recv_time($_REQUEST['time']);
        if($dish == null) throw new Exception("Invalid dish id.");
        echo make_order(unserialize($_SESSION['user'])->id ,$dish_id ,$recv);
    }
    catch(Exception $e) { die($e->getMessage()); }
}

function set_payment()
{   
    try
    {
        $order_id = check_valid::white_list($_REQUEST['order_id'] ,check_valid::$only_number);
        $target = $_REQUEST['target'] == 'true';
        $ip = unserialize($_SESSION['user'])->get_ip();
        $user_id = unserialize($_SESSION['user'])->id;
        switch($_REQUEST['cmd'])
        {
            case 'payment_dm':
                $money_to = 'dm';
                break;
            case 'payment_cafet':
                $money_to = 'cafet';
                break;
            case 'payment_facto':
                $money_to = 'fact';
                break;
        }
        set_payment($order_id ,$user_id ,$money_to ,$target ,$ip);
    }catch(Exception $e){ die($e->getMessage()); }
    die("Successfully set payment.");
}

function change_password()
{
    try
    {
        $old_pswd = check_valid::white_list($_REQUEST['old_pswd'] ,check_valid::$white_list_pattern);
        $new_pswd = check_valid::pswd_check($_REQUEST['new_pswd']);
        $id = unserialize($_SESSION['user'])->id;
        change_password($id ,$old_pswd ,$new_pswd);
    }catch(Exception $e){die($e->getMessage());}
    die("Successfully changed password.");
}
    
function delete_order()
{
    try
    {
        $id = check_valid::white_list($_REQUEST['order_id'] ,check_valid::$only_number); 
        delete_order($id);
    }catch(Exception $e) {die($e->getMessage());}
    die("Succesfully deleted order.");
}

function get_date()
{
    if($_REQUEST['cmd'] == 'get_date')
        echo json_output::date_to_json(date_api::get_date_array());
    if($_REQUEST['cmd'] == 'get_datetime')
        echo json_output::date_to_json(date_api::get_datetime_array());
}

function register()
{
    try
    {
        $usr_name = htmlspecialchars($_REQUEST['user_name']);
        $phone_num = check_valid::regex_check($_REQUEST['phone_number'] ,check_valid::$phone_regex);
        $is_vege = check_valid::vege_check($_REQUEST['is_vege']);
        $gen = check_valid::gen_check($_REQUEST['gen']);
        $email = check_valid::regex_check($_REQUEST['email'] ,check_valid::$email_regex);
        $usr_login_id = check_valid::white_list($_REQUEST['login_id'] ,check_valid::$white_list_pattern);
        $pswd = check_valid::white_list($_REQUEST['password'] ,check_valid::$white_list_pattern);
        register($usr_name ,$phone_num ,$is_vege ,$gen ,$email ,$usr_login_id ,$pswd);
    }catch(Exception $e) {die($e->getMessage());}
    die("Succesfully registered user.");
}

function get_custom_dish_id()
{
    try
    {
        $id = $_REQUEST['id'];
        $tmp = []; $counter = 0;
        foreach($id as $value)
            $tmp[$counter++] = check_valid::white_list($value ,check_valid::$only_number);
        if($counter == 0) throw new Exception("Hasn't input id.");
            echo get_custom_dish_id($tmp);
        $_SESSION['menu'] = serialize(get_dish(null ,null));
    }catch(Exception $e) {die($e->getMessage());}    
}

function check_recv()
{
    try
    {
        $id = $_REQUEST['order_id'];
        check_recv($id);
    }catch(Exception $e) {die($e->getMessage());}
    die("Successfully checked receive.");  
}

function announce_handle()
{
    if($_REQUEST['cmd'] == 'get_announce')
    {
        $start = ($_REQUEST['start'] == null ? null : 
            date('Y/m/d-H:i:s' ,date_api::is_valid_time($_REQUEST['start'])->getTimestamp()));
        $end = ($_REQUEST['end'] == null ? null : 
            date('Y/m/d-H:i:s' ,date_api::is_valid_time($_REQUEST['end'])->getTimestamp()));
        $result = get_announce($start ,$end);
        json_output::output($result);
    }
    if($_REQUEST['cmd'] == 'done_announce')
    {
        $id = check_valid::white_list($_REQUEST['id'] ,check_valid::$only_number);
        $device_id = check_valid::white_list($_REQUEST['device_id'] ,check_valid::$only_number);
        done_announce($id ,$device_id);
        die('Succesfully recorded to server.');
    }
}

function show_factory()
{
    $id = ($_REQUEST['id'] == null ? null : intval(check_valid::white_list($_REQUEST['id'] ,check_valid::$only_number)));
    $result = get_factory_info($id);
    json_output::output($result);
}

}

?>