<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class RoundFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->parameterCount(2);
    }

    public function execute($parameters) : int|float 
    {
        return round( $parameters[0] , $parameters[1]);
    }
}
