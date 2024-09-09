<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class CountIfFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(1);
        $validator->onlyIntegers();
    }

    public function execute($parameters) : int|float 
    {
        $search = array_shift($parameters);
        $counts = array_count_values($parameters);
        return $counts[$search] ?? 0;
    }
}
