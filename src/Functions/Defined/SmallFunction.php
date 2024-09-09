<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class SmallFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
       $validator->minParameters(1);
       $validator
       ->validateParameter(0)
       ->withMessage("Parameter 1 must be between 1 and count of parameters.")
       ->int()
       ->between(1, count($parameters) - 1);
    }

    public function execute($parameters) : int|float 
    {
        $n = array_shift($parameters);
        sort($parameters);
        return $parameters[$n - 1];
    }
}
