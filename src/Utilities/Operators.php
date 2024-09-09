<?php

namespace Williams\Xpression\Utilities;

class Operators
{
    public static function keys(): array
    {
        return array_keys(static::definitions());
    }

    public static function evaluate($operator,$left,$right){
        return static::definitions()[$operator]($left,$right);
    }

    private static function definitions(): array
    {
        return [
            '*' => fn($l, $r) => $l * $r,
            '/' => fn($l, $r) => $l / $r,
            '+' => fn($l, $r) => $l + $r,
            '-' => fn($l, $r) => $l - $r,
            '^' => fn($l, $r) => pow($l, $r),
            '=' => fn($l, $r) => ($l == $r) ? 1 : 0,
            '<>' => fn($l, $r) => ($l != $r) ? 1 : 0,
            '<' => fn($l, $r) => ($l < $r) ? 1 : 0,
            '>' => fn($l, $r) => ($l > $r) ? 1 : 0,
            '<=' => fn($l, $r) => ($l <= $r) ? 1 : 0,
            '>=' => fn($l, $r) => ($l >= $r) ? 1 : 0,
        ];
    }
}
