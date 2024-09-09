<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class ModFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
       $validator->parameterCount(2);
    }

    public function execute($parameters) : int|float 
    {
        return $parameters[0] % $parameters[1];
    }
}
