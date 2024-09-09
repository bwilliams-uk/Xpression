<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class XorFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(1);
    }

    public function execute($parameters): int|float
    {
        $trueCount = 0;
        foreach ($parameters as $value) {
            if ($this->truthy($value)) {
                $trueCount++;
            }
        }
        return ($trueCount == 1) ? 1 : 0;
    }
}
