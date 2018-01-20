<?php
require_once('fetch_order.php');
require_once('./user/user.php');

function get_paid_orders($user)
{
    if($user == null) die("Access denied");
    $criteria = " AND charge_paid = 1";
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied");
    return fetch_order($criteria);
}

function get_unpaid_orders($user)
{
    if($user == null) die("Access denied");
    $criteria = " AND charge_paid = 0";
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied");
    return fetch_order($criteria);
}

function get_user_orders($user)
{
    if($user == null) die("Unable to search the user");
    $criteria = " AND user_id = $user->user_id";
    $prev = unserialize($_SESSION['user'])->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'] || $prev['normal'])) die("Access denied");
    return fetch_order($criteria);
}

function get_all_orders($user)
{
    if($user == null) die("Access denied");
    $criteria = "";
    $prev = $user->get_prev_code();
    if(!($prev['admin'] || $prev['dinnerman'])) die("Access denied");
    return fetch_order($criteria);
}
?>