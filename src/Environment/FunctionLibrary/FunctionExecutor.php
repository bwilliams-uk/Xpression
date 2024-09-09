<?php

namespace Williams\Xpression\Environment\FunctionLibrary;

use Williams\Xpression\Exceptions\ParameterException;
use Williams\Xpression\Extendable\FunctionBase;
use Williams\Xpression\Factories\ParameterListFactory;
use Williams\Xpression\Functions\Validators\ParameterListValidator;

class FunctionExecutor
{
    public function execute(FunctionLibrary $library, FunctionLibraryEntry $entry, array $parameters)
    {
        //Trigger Exceptions if function disabled.
        $entry->enabledOrFail();

        //Create an instance of the function class (See Extendable\FunctionBase)
        $fn = $entry->createClassInstance();

        //Set functions 'truthy' defintion to that of the library.
        $fn->truthy = $library->truthy;

        //Validate the parameters
        $this->validate($entry, $fn, $parameters);

        //Return result;
        return $fn->execute($parameters);
    }

    private function validate(FunctionLibraryEntry $entry, FunctionBase $fn, array $parameters)
    {
        $validator = $this->createParameterListValidator($parameters);
        try {
            $fn->validate($validator,$parameters);
        } catch (ParameterException $e) {
            throw $this->formatException($e, $entry);
        }
    }

    private function createParameterListValidator(array $parameters) : ParameterListValidator
    {
        $parameterList = ParameterListFactory::create($parameters);
        return new ParameterListValidator($parameterList);
    }

    //Prepends the function name of $entry to the Exception message of $e. Returning a new Exception.
    private function formatException(ParameterException $e, FunctionLibraryEntry $entry)
    {
        $name = strtoupper($entry->getName());
        $message = $e->getMessage();
        $message = "Function '$name': $message";
        return new ParameterException($message);
    }
}
