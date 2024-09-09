<?php

namespace Williams\Xpression\Functions\Validators;

use Williams\Xpression\Functions\Parameter;

class ParameterValidator extends Validator
{
    private Parameter $parameter;
    private int $index;

    public function __construct(Parameter $parameter, $index, $exceptionMessage)
    {
        $this->parameter = $parameter;
        $this->index = $index;
        $this->withMessage($exceptionMessage);
    }

    public function int()
    {
        if (!$this->parameter->int()) $this->fail("Must be an integer.");
        return $this;
    }

    public function equals($value)
    {
        if (!$this->parameter->equals($value)) $this->fail("Must equal $value.");
        return $this;
    }

    public function not($value)
    {
        if (!$this->parameter->not($value)) $this->fail("Must not be $value.");
        return $this;
    }

    public function in($array)
    {
        $imploded = implode(',',$array);
        if (!$this->parameter->in($array)) $this->fail("Must be in $imploded.");
        return $this;
    }


    public function notIn($array)
    {
        $imploded = implode(',',$array);
        if (!$this->parameter->notIn($array)) $this->fail("Must not be in $imploded.");
        return $this;
    }

    public function lt($value)
    {
        if (!$this->parameter->lt($value)) $this->fail("Must be less than $value.");
        return $this;
    }

    public function lte($value)
    {
        if (!$this->parameter->lte($value)) $this->fail("Must be less than or equal to $value.");
        return $this;
    }

    public function gt($value)
    {
        if (!$this->parameter->gt($value)) $this->fail("Must be greater than $value.");
        return $this;
    }

    public function gte($value)
    {
        if (!$this->parameter->gte($value)) $this->fail("Must be greater than or equal to $value.");
        return $this;
    }

    public function between($min, $max)
    {
        if (!$this->parameter->between($min, $max)) $this->fail("Must be between $min and $max.");
        return $this;
    }

    protected function fail($message){
        $parameterNumber = $this->index + 1;
        $message = "Parameter $parameterNumber: $message";
        parent::fail($message);
    }
}
