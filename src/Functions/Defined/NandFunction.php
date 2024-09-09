<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class NandFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
        $validator->minParameters(1);
    }

    public function execute($parameters): int|float
    {
        foreach ($parameters as $value) {
            if (!$this->truthy($value)) {
                return 1;
            }
        }
        return 0;
    }
}
