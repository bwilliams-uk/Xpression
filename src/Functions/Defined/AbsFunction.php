<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class AbsFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
       $validator->parameterCount(1);
    }

    public function execute($parameters) : int|float 
    {
        return abs($parameters[0]);
    }
}
