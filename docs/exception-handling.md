# Exception Handling

Sometimes Xpression will not be able to resolve the expression, for example if the user types it incorrectly. This will produce an exception which must be caught and handled by the program using the Xpression library.

## Types of Exception

All Exceptions thrown by Xpression extend a base exception class `Williams\Xpression\Exceptions\XpressionException`.

These are further categorised into four Exception types part of the same namespace:

- FunctionException
- ParameterException
- SyntaxException
- VariableException

## What might cause an Exception

Depending on the type of exception, the following situations may trigger an exception to be thrown. Details of an exception occurrance can be found by using `$exception->getMessage()`.

**FunctionException** 

- The expression attempts to call a function that has been disabled.
- The expression trys to call a function that does not exist.
- An attempt to register a function with an alias that already already exists and overriding is disabled.
- An attempt to register a function class that is not a valid class name or does not extend the `FunctionBase` class. 

**SyntaxException**

- There are unbalanced brackets in the expression.
- The expression could not be resolved to a numeric output.

**ParameterException**

- The expression uses a function which contains arguments that do not meet the validation criteria defined in the functions' class.

**VariableException**

- A variables type is not valid. All variables should be one of: an integer, a float, an array of integers or floats, a comma-separated list of integers or floats, or another valid expression.


## Handling Exceptions

It is recommended to wrap any calls to the methods `Environment::evaluate()` and `FunctionLibrary::register()` in try-catch blocks.

A minimal exception handling implementation:

```php
try{
    $xp->functions->register('custom',CustomFunction::class);
}
catch(FunctionException $e){
    //Handle failed function registration...
}

try{
    $xp->evaluate($expressionText);
}
catch(XpressionException $e){
    //Handle failed evaluation...
}
```