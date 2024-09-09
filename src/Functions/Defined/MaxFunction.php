<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class MaxFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
    }

    public function execute($parameters) : int|float 
    {
        if(empty($parameters)) return 0;
        return max($parameters);
    }
}
