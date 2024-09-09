<?php

namespace Williams\Xpression\Environment\FunctionLibrary;

use Williams\Xpression\Exceptions\FunctionException;
use Williams\Xpression\Extendable\FunctionBase;
use Williams\Xpression\Utilities\ClassUtils;

class FunctionRegister
{

    //Array where key is the function alias and value a 'FunctionLibaryEntry' object.
    private array $functions = [];

    public function create(string $name, string $class, bool $override)
    {
        $functionName = strtolower($name);

        //Trigger Exception if $className is not a valid class.
        ClassUtils::existsOrFail($class, FunctionException::class);

        //Trigger Exception if class does not extend FunctionBase.
        ClassUtils::extendsOrFail($class, FunctionBase::class, FunctionException::class);

        if (!$override) {
            // Triggers an Exception if the function already exists.
            $this->notExistsOrFail($functionName);
        }

        // Add the class to the functions register.
        $this->functions[$functionName] = new FunctionLibraryEntry($functionName, $class);
    }

    public function get($name): FunctionLibraryEntry
    {
        $name = strtolower($name);
        $this->existsOrFail($name);
        return $this->functions[$name];
    }

    private function notExistsOrFail($name): void
    {
        if (isset($this->functions[$name])) {
            throw new FunctionException("Function '$name' has already been defined.");
        }
    }

    private function existsOrFail($name): void
    {
        if (!isset($this->functions[$name])) {
            throw new FunctionException("Function '$name' does not exist.");
        }
    }
}
