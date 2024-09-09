<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class EqualFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
    }

    public function execute($parameters): int|float
    {
        return (count(array_unique($parameters)) == 1) ? 1 : 0;
    }
}
