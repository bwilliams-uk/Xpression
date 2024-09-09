<?php

namespace Williams\Xpression\Environment\FunctionLibrary;

use Williams\Xpression\Exceptions\XpressionException;
use Williams\Xpression\Utilities\FileUtils;

class FunctionLibrary
{
    private FunctionRegister $functionRegister;
    private FunctionExecutor $functionExecutor;

    //function accepting 1 parameter which identifies value as true or false.
    public $truthy;

    //Whether a class alias can be overrided once registered.
    public bool $allowOverride = false;


    public function __construct(FunctionRegister $functionRegister, FunctionExecutor $functionExecutor)
    {
        $this->functionRegister = $functionRegister;
        $this->functionExecutor = $functionExecutor;
        $this->truthy = fn($value) => ($value != 0); //Default test for truthy values
    }

    // Define a function that may be used in an expression
    public function register(string $functionName, string $className): FunctionLibrary
    {
        $this->functionRegister->create($functionName,$className,$this->allowOverride);
        return $this;
    }

    public function execute($functionName,$parameters){
        $function = $this->functionRegister->get($functionName);
        return $this->functionExecutor->execute($this, $function, $parameters);
    }

    public function loadFromFile(string $path) : void
    {
       //Fail if path is not a function.
       $fn = FileUtils::returnsCallableOrFail($path,new XpressionException);
       // Call function with $this as parameter.
       $fn($this);
    }

    public function enable(string|array $names) : void
    {
        $names = (is_array($names)) ? $names : [$names];
        $names = array_map('strtolower',$names);
        foreach ($names as $name) {
            $this->functionRegister->get($name)->enable();
        }
    }

    public function disable(string|array $names) : void
    {
        $names = (is_array($names)) ? $names : [$names];
        $names = array_map('strtolower',$names);
        foreach ($names as $name) {
            $this->functionRegister->get($name)->disable();
        }
    }
}
