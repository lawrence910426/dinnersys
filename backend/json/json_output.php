<?php

# This file require a BOM header to let IOS plugin run.

class json_output
{
    public static $filter_string =
        ['\\' => '\\\\' ,
          '"' => '\"'];
    
    public static function filter($string)
    {
        foreach(self::$filter_string as $key => $value)
            $string = str_replace($key ,$value ,$string);
            
        return $string;
    }
    
    public static function array_to_json($var)
    {
        $json = "[";
        $has_run = false;
        $counter = 1;

        foreach ($var as $key => $value)
        {
            if ($has_run == true)
                $json .= ',';
            else
                $has_run = true;

            if (class_implements($value)['json_format'] == 'json_format')
            {
                $obj_data = $value->get_json();
                $json .= $obj_data;
            } else
            {
                $json .= "{}";
            }
        }

        $json .= "]";
        return $json;
    }

    public static function output($var) //$var must be an array.
    {
        $json = '';
        if (is_array($var))
            $json .= json_output::array_to_json($var);
        else
        {
            if (class_implements($var)['json_format'] == 'json_format')
                $json .= $var->get_json();
            else
                $json .= "{}";
        }
        
        echo $json;
    }
}

?>