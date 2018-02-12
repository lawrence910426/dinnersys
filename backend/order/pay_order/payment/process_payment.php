<?php

require_once (__DIR__ . "/set_payment.php");

function make_payment($order)
{
    return set_payment($order ,"SET charge_paid = 1" ,"AND charge_paid = 0");
}


function reverse_payment($order)
{
    return set_payment($order ,"SET charge_paid = 0"  ,"AND charge_paid = 1");
}

?>