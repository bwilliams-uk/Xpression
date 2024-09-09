<?php

namespace Williams\TestTube;

class ActiveRequest
{
    private static Request $request;

    public static function set(Request $request)
    {
        static::$request = $request;
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::$request, $name], $arguments);
    }
}
