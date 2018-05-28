<?php

class check_valid
{
    public static $white_list_pattern = "ABCDEGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890 _";
    public static $only_number = "1234567890";
    public static $phone_regex = "/^09[0-9]{2}-[0-9]{3}-[0-9]{3}$/";
    public static $email_regex = '/^[a-zA-Z0-9.!#$%&¡¦*+=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
    public static $vege_adapt = [
        'PURE' => 2 ,
        'VEGE' => 1 ,
        'MEAT' => 0
    ];
    public static $gen_adapt = [
        'MALE' => 'MALE' ,
        'FEMALE' => 'FEMALE' ,
        'OTHER' => 'OTHER'
    ];
    
    function white_list($string ,$pattern ,$auto_remove = false)
    {
        search:
        {
            for($i = 0;$i != strlen($string);$i += 1)
            {
                if(strpos($pattern ,$string[$i]) === false)
                    if($auto_remove)
                    {
                        $string = str_replace($string[$i] ,"" ,$string);
                        goto search;
                    }
                    else throw new Exception("Invalid string.");
            }
        }
        return $string;
    }
    
    function regex_check($string ,$regex)
    {
        if(preg_match($regex ,$string)) return $string;
        throw new Exception("Invalid string.");
    }
    
    function gen_check($gender)
    {
        $ret = self::$gen_adapt[$gender];
        if($ret === null) throw new Exception("Invalid gen code.");
        return $ret;
    }
    
    function vege_check($vege)
    {
        $ret = self::$vege_adapt[$vege];
        if($ret === null) throw new Exception("Invalid vege code.");
        return $ret;
    }
    
    function pswd_check($password)      # at least four characters.
    {
        $password = self::white_list($password ,self::$white_list_pattern);
        if(strlen($password) < 4) throw new Exception("password too short.");
        return $password;
    }
}


?>