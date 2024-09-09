<?php

namespace Williams\Xpression\Functions\Defined;
use Williams\Xpression\Extendable\FunctionBase;

class RandBetweenFunction extends FunctionBase
{
    public function validate($validator, $parameters): void
    {
       $validator->parameterCount(2);
       $validator->onlyIntegers();
       $validator
       ->validateParameter(1)
       ->withMessage("Second parameter must be greater than or equal to first parameter.")
       ->gte($parameters[0]);
    }

    public function execute($parameters): int|float
    {
        return random_int($parameters[0], $parameters[1]);
    }
}
