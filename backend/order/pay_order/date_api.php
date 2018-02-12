<?php

class date_api
{
    public static function is_valid_time($date)
    {
        $monday = strtotime("last monday" ,strtotime("tomorrow"));
        $last_day = $monday + 7 * 24 * 60 * 60;
        $time_stamp = (new DateTime($date))->getTimestamp();
        
        if($monday <= $time_stamp && $time_stamp < $last_day)
            return $date;
        die("Invalid date");
    }
    
    public static function get_date_array()
    {
        $monday = strtotime("last monday" ,strtotime("tomorrow"));
        $date_arr = [
            "Monday" => date('Y-m-d' ,$monday) ,
            "Tuesday" => date('Y-m-d' ,strtotime("+1 day" ,$monday)) ,
            "Wednesday" => date('Y-m-d' ,strtotime("+2 day" ,$monday)) ,
            "Thursday" => date('Y-m-d' ,strtotime("+3 day" ,$monday)) ,
            "Friday" => date('Y-m-d' ,strtotime("+4 day" ,$monday)) ,
        ];
        return $date_arr;
    }
    
    public static function get_weekday_array()
    {
        $monday = strtotime("last monday" ,strtotime("tomorrow"));
        $date_arr = [
            date('Y-m-d' ,$monday) => "Monday" ,
            date('Y-m-d' ,strtotime("+1 day" ,$monday)) => "Tuesday" ,
            date('Y-m-d' ,strtotime("+2 day" ,$monday)) => "Wednesday" ,
            date('Y-m-d' ,strtotime("+3 day" ,$monday)) => "Thursday" ,
            date('Y-m-d' ,strtotime("+4 day" ,$monday)) => "Friday" ,
        ];
        return $date_arr;
    }
}

?>