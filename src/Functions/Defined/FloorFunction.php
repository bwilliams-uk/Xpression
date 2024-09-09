<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class FloorFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->parameterCount(1);
    }

    public function execute($parameters) : int|float 
    {
        return floor($parameters[0]);
    }
}
