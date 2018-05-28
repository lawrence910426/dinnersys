<?php

class date_api
{
    public static function is_valid_time($date)
    {
        $date_obj = DateTime::createFromFormat('Y/m/d-H:i:s', $date);
        if($date_obj === false) throw new Exception("Invalid format.");
        if($date_obj->getTimestamp() <= 0) throw new Exception("Over unix timestamp.");
        return $date_obj;
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
    
    public static function check_recv_time($time)
    {
        $time = self::is_valid_time($time); 
        $time = $time->getTimestamp() - 6 * 60 * 60;                        # timezone accurate. IDK why.
        $week = 7 * 24 * 60 * 60;
        $start_of_week = (floor($time / $week) * $week) + (4 * 24 * 60 * 60);   # 1970 ,Jan ,01 (Thu) 00:00:00.
                
        $invalid_lower_bound = $start_of_week + 5 * 24 * 60 * 60;
        $invalid_upper_bound = $start_of_week + 7 * 24 * 60 * 60;
        
        #echo $start_of_week . ' ' . $invalid_lower_bound . ' ' . $time . ' ' . $invalid_upper_bound . '<br>';
        
        if($invalid_lower_bound < $time && $time < $invalid_upper_bound)
            throw new Exception("六日無法點餐");
        
        return date('Y/m/d-H:i:s', $time + 6 * 60 * 60);    # make the timezone right again.
    }
    
    public static function get_datetime_array() 
    {
        $period = strtotime("last monday" ,strtotime("tomorrow"));
        $week = 7 * 24 * 60 * 60;
        $start_of_week = (floor($period / $week) * $week) + (4 * 24 * 60 * 60);   # 1970 ,Jan ,01 (Thu) 00:00:00.
        $lower_bound = time() + 30 * 60;
        return [ 
            'order_lower_bound' => $lower_bound ,
            'week_start' => $start_of_week ,
            'friday_end' => $start_of_week + 5 * 24 * 60 * 60 ,
            'Monday' => date('Y/m/d-H:i:s', $start_of_week      + 0 * 24 * 60 * 60 - 2 * 60 * 60) ,     # the fucking timezone accurate.
            'Tuesday' => date('Y/m/d-H:i:s', $start_of_week     + 1 * 24 * 60 * 60 - 2 * 60 * 60) ,
            'Wednesday' => date('Y/m/d-H:i:s', $start_of_week   + 2 * 24 * 60 * 60 - 2 * 60 * 60) ,
            'Thursday' => date('Y/m/d-H:i:s', $start_of_week    + 3 * 24 * 60 * 60 - 2 * 60 * 60) ,
            'Friday' => date('Y/m/d-H:i:s', $start_of_week      + 4 * 24 * 60 * 60 - 2 * 60 * 60) ,
            'Saturday' => date('Y/m/d-H:i:s', $start_of_week    + 5 * 24 * 60 * 60 - 2 * 60 * 60) ,
            'Sunday' => date('Y/m/d-H:i:s', $start_of_week      + 6 * 24 * 60 * 60 - 2 * 60 * 60)
        ];
    }
}

?>