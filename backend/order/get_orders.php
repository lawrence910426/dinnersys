<?php
require_once(__DIR__ . '/fetch_order.php');
require_once(__DIR__ . '/../user/user.php');

class get_orders
{
    public $criteria = array();
    public $criteria_auth = [
        'time' => [
            'week' => ['normal' ,'dinnerman' ,'admin'] ,
            'today' => ['normal' ,'dinnerman' ,'admin'] ,
            'nothing' => ['normal' ,'dinnerman' ,'admin']
        ] ,
        'person' => [
            'self' => ['normal' ,'dinnerman' ,'admin'] ,
            'class' => ['dinnerman' ,'admin'] ,
            'everyone' => ['admin'] ,
        ] ,
        'payment' => [
            'unpaid' => ['normal' ,'dinnerman' ,'admin'] ,
            'paid' => ['normal' ,'dinnerman' ,'admin'] ,
            'nothing' => ['normal' ,'dinnerman' ,'admin']
        ] ,
        'other' => [
            'join statement' => ['guest' ,'normal' ,'dinnerman' ,'admin'] 
        ]
    ];
    
    function __construct()
    {
        $date_array = date_api::get_date_array();
        $criteria = array();
        
        $whole_week_criteria = ""; $first_clause = true;
        foreach($date_array as $key => $value)
        {
            if($first_clause)
            {
                $whole_week_criteria .= " datediff(orders.receive_date ,'$value') = 0 ";
                $first_clause = false;
            }
            else
                $whole_week_criteria .= " OR datediff(orders.receive_date ,'$value') = 0 ";
        }
        
        $user_id = unserialize($_SESSION['user'])->user_id;
        $user_class = unserialize($_SESSION['user'])->class_no;
        $today = date('Y-m-d');
        
        $criteria = [
            'time' => [
                'week' => " ($whole_week_criteria) " ,
                'today' => " (datediff(orders.receive_date ,'$today') = 0) ",
                'nothing' => " (TRUE) "
            ] ,
            'person' => [
                'self' => " (orders.user_id = $user_id) " ,
                'class' => " (users.class = $user_class) ",
                'everyone' => " (TRUE) " ,
                'nothing' => " (TRUE) "
            ] ,
            'payment' => [
                'unpaid' => " (charge_paid = 1) " ,
                'paid' => " (charge_paid = 0) " ,
                'nothing' => " (TRUE) "
            ] ,
            'other' => [
                'join statement' => " (orders.user_id = users.user_id) "
            ]
        ];
        
        $this->criteria = $criteria;
    }
    
    function get_orders($time_filter ,$person_filter ,$payment_filter)
    {
        $criteria_auth = $this->criteria_auth;
        $criteria = $this->criteria;
        
        if($criteria_auth['time'][$time_filter] == null) die("wrong time filter. <br>");
        if($criteria_auth['person'][$person_filter] == null) die("wrong person filter. <br>");
        if($criteria_auth['payment'][$payment_filter] == null) die("wrong payment filter. <br>");
        
        $prev = unserialize($_SESSION['user'])->get_prev_code();
        $time_auth = false; $person_auth = false; $payment_auth = false;
        foreach($criteria_auth['time'][$time_filter] as $key => $value)
            $time_auth |= $prev[$value];
        foreach($criteria_auth['person'][$person_filter] as $key => $value)
            $person_auth |= $prev[$value];
        foreach($criteria_auth['payment'][$payment_filter] as $key => $value)
            $payment_auth |= $prev[$value];
        if(!($time_auth && $person_auth && $payment_auth)) die("Access denied.");
        
        $criteria_clause = ' WHERE ' . $criteria['time'][$time_filter] . 
                            " AND " . $criteria['person'][$person_filter] . 
                            " AND " . $criteria['payment'][$payment_filter] .
                            " AND " . $criteria['other']['join statement'];
                            
        $_SESSION['orders'] = serialize(fetch_order($criteria_clause));
        return $_SESSION['orders'];
    }
}

?>