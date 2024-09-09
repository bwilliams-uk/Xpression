<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class CountFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
    }

    public function execute($parameters) : int|float 
    {
        return count($parameters);
    }
}
