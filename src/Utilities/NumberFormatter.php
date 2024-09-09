<?php

namespace Williams\Xpression\Utilities;

class NumberFormatter
{

    /* To avoid complications of both subtraction operations and negative 
    numbers having the same character representing them, this class defines 
    an alternative prefix to designate negative values.*/
    
    private static string $negativePrefix = '!';

    public static function getNegativePrefix()
    {
        return static::$negativePrefix;
    }

    // Converts a string-formatted number back to an appropriate type 
    public static function toNumber(string $string): int|float|false
    {
        $string = static::decodeNegative($string);
        if (!is_numeric($string)) {
            return false;
        }
        return static::stringToIntOrFloat($string);
    }

    // Converts a numeric to internal string format
    public static function toString($number): string
    {
        $number = (string) $number;
        return static::encodeNegative($number);
    }

    // Replaces negative sign with $negativePrefix
    private static function encodeNegative(string $string) : string
    {
        if ($string[0] == '-') {
            return substr_replace($string, static::$negativePrefix, 0, 1);
        }
        return $string;
    }

    //Converts a prefix back to a negative sign.
    private static function decodeNegative(string $string) : string
    {
        if (static::startsWithNegativePrefix($string)) {
            return substr_replace($string, '-', 0, strlen(static::$negativePrefix));
        }
        return $string;
    }

    // Returns TRUE if the given string starts with the negative prefix.
    private static function startsWithNegativePrefix(string $string) : bool
    {
        return (substr($string, 0, strlen(static::$negativePrefix)) === static::$negativePrefix);
    }

    //Returns TRUE if the given float is an integer.
    private static function floatIsInteger(float $float) : bool
    {
        return ($float == floor($float));
    }

    //Converts a numeric string to Int (if appropriate) or Float
    private static function stringToIntOrFloat(string $string) : int|float
    {
        $floatVal = floatval($string);
        if (static::floatIsInteger($floatVal)) {
            return intval($string);
        }
        return $floatVal;
    }
}
