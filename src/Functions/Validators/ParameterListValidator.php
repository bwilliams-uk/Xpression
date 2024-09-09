<?php

namespace Williams\Xpression\Functions\Validators;

use Williams\Xpression\Functions\ParameterList;

class ParameterListValidator extends Validator
{
    private ParameterList $parameterList;

    public function __construct(ParameterList $parameterList){
        $this->parameterList = $parameterList;
    }

    //Throw an Exception if number of parameters is not $n.
    public function parameterCount($n): self
    {
        if ($this->parameterList->count() != $n) {
            $this->fail("Must accept exactly $n parameters.");
        }
        return $this;
    }

    //Throw an Exception if number of parameters is below $n.
    public function minParameters($n): self
    {
        if ($this->parameterList->count() < $n) {
            $this->fail("Must accept a minimum of $n parameters.");
        }
        return $this;
    }

    //Throw an Exception if number of parameters is above $n.
    public function maxParameters($n): self
    {
        if ($this->parameterList->count() > $n) {
            $this->fail("Must accept a maximum of $n parameters.");
        }
        return $this;
    }

    //Throw an Exception if any parameter is not an integer
    public function onlyIntegers(): self
    {
        foreach ($this->parameterList->parameters() as $param) {
            if (!$param->int()) {
                $this->fail("Can only accept integer parameters.");
            }
        }
        return $this;
    }

    public function validateParameter($i): ParameterValidator
    {
        $parameter = $this->parameterList->parameter($i);
        return new ParameterValidator($parameter,$i,$this->exceptionMessage);
    }
}
