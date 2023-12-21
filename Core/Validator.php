<?
namespace Core;
class Validator { 

    public static function string($value, $min = 1, $max = INF) {

        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;

    }

    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function phone($phoneNumber) : bool {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
    
        if (strlen($phoneNumber) >= 10 && strlen($phoneNumber) <= 11) 
            if (ctype_digit($phoneNumber)) 
                return true;

        return false;
    }    

    public static function name($name) : bool {
        return (preg_match('/^[A-Za-z\-\. ]+$/', trim($name))) ? true : false;
    }

}