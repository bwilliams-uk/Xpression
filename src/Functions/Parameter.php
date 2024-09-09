<?php

namespace Williams\Xpression\Functions;

class Parameter
{
    public int|float $value;

    public function __construct(int|float $value)
    {
        $this->value = $value;
    }

    public function int()
    {
        return is_int($this->value);
    }

    public function equals($value)
    {
        return ($this->value == $value);
    }

    public function not($value)
    {
        return ($this->value != $value);
    }

    public function in(array $array)
    {
        return (in_array($this->value, $array));
    }

    public function notIn(array $array)
    {
        return (!in_array($this->value, $array));
    }

    public function lt($value)
    {
        return ($this->value < $value);
    }

    public function lte($value)
    {
        return ($this->value <= $value);
    }

    public function gt($value)
    {
        return ($this->value > $value);
    }

    public function gte($value)
    {
        return ($this->value >= $value);
    }

    public function between($min, $max)
    {
        return ($this->gte($min) && $this->lte($max));
    }
}
