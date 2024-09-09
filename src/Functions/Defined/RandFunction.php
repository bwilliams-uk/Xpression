<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class RandFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(1);
    }

    public function execute($parameters): int|float
    {
        $index = random_int(0, count($parameters) - 1);
        return $parameters[$index];
    }
}
