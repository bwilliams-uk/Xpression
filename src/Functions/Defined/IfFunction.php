<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class IfFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->parameterCount(3);
    }

    public function execute($parameters) : int|float 
    {
        $boolean = $this->truthy($parameters[0]);
        return ($boolean) ? $parameters[1] : $parameters[2];
    }
}
