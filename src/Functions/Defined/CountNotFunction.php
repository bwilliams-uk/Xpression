<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class CountNotFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(1);
    }

    public function execute($parameters) : int|float 
    {
        $search = array_shift($parameters);
        $callback = fn($value)=>($value != $search);
        $filtered = array_filter($parameters,$callback);
        return count($filtered);
    }
}
