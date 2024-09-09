<?php
namespace Williams\Xpression\Extendable;

use Williams\Xpression\Functions\Validators\ParameterListValidator;

abstract class FunctionBase{

    //Override in Child Classes
    abstract public function validate(ParameterListValidator $validator, array $parameters);
    abstract public function execute(Array $parameters);

    public $truthy; //Function to check if a value is truthy. Inserted by FunctionLibrary Class.

    protected function truthy($value) : bool {
        $fn = $this->truthy;
        return $fn($value);
    }
}