<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class IndexFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(2);
        $validator
        ->validateParameter(0)
        ->withMessage("Parameter 1 must be between 1 and count of parameters.")
        ->int()
        ->between(1, count($parameters) - 1);
    }

    public function execute($parameters) : int|float 
    {
        $index = array_shift($parameters);
        return $parameters[$index - 1];
    }
}
