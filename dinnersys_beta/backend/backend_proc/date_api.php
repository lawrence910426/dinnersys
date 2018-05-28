<?php

class date_api
{
    public static function is_valid_time($date)
    {
        $date_obj = DateTime::createFromFormat('Y/m/d-H:i:s', $date);
        if($date_obj === false) throw new Exception("Invalid date.");
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
        $start_of_week = strtotime("last monday" ,strtotime("tomorrow"));
        $start_of_week = floor($start_of_week / 24 / 60 / 60) * 24 * 60 * 60;
        $time = self::is_valid_time($time); $time = $time->getTimestamp() - 6 * 60 * 60;        # timezone accurate. IDK why.
        $lower_bound = time() + 30 * 60;                                                        # at least 30 minutes. For the factory to make the dish.
        $upper_bound = $start_of_week + 5 * 24 * 60 * 60 - 8 * 60 * 60;                         # timezone accurate.
        
        echo $lower_bound . ' ' . $time . ' ' . $upper_bound . '<br>';
        
        if($lower_bound <= $time && $time < $upper_bound)
            return date('Y/m/d-H:i:s', $time + 6 * 60 * 60);                                    # make the timezone right again.
        else
            throw new Exception("Invalid datetime.");
    }
    
    public static function get_datetime_array()
    {
        $start_of_week = strtotime("last monday" ,strtotime("tomorrow"));
        $start_of_week = floor($start_of_week / 24 / 60 / 60) * 24 * 60 * 60;
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