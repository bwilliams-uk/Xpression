# Custom Functions

## Creating a Function Class

Begin by creating a new class for the function:

```php
//FunctionName.php

use Williams\Xpression\Extendable\FunctionBase;

class FunctionName extends FunctionBase{
    public function validate($validator, $parameters)
    {
    }
    public function execute($parameters)
    {
    }
}

```

The `validate` method is responsible for ensuring the given parameters are valid and, if not, triggering an Exception. A `$validator` object is used to simplify commonly used validation methods.

The `execute` method is called immediately after `validate` and is responsible for returning the function's output value.



## Implementing the Validate Method

**Validating Parameter Counts**

The `validator` object can be used to ensure a function is given an appropriate number of parameters:

- `$validator->minParameters(2)` - Ensure the function receives at least two parameters.

- `$validator->maxParameters(4)` - Ensure the function receives at most four parameters.

- `$validator->parameterCount(3)` - Ensures the function receives exactly three parameters.



**Validating Parameter Types**

- `$validator->onlyIntegers()` - Ensure the function receives parameters of an integer type only.



**Validating Individual Parameters**

Use the `index` method to select a specific parameter you wish to validate. The first parameter has an index of `0`.

```php
public function validate($validator, $parameters){
    $validator
    ->index(1)
    ->withMessage('First and second parameters cannot be equal.')
    ->not($parameters[0]);
}
```

The `ParameterValidator` object returned by the `index` method has the following available methods:

- `int()`
- `equals($value)`
- `not($value)`
- `in($array)`
- `notIn($array)`
- `lt($value)`  *(less than)*
- `lte($value)` *(less than or equal)*
- `gt($value)` *(greater than)*
- `gte($value)` *(greater than or equal)*
- `between($min,$max)`

These can be method chained to check multiple criteria.

## Complete Example

This example creates a simple function that adds the parameters together. 

```php
// add.php

use Williams\Xpression\Extendable\FunctionBase;

class Add extends FunctionBase{
    public function validate($validator, $parameters)
    {
        $validator->minParameters(1);
    }
    public function execute($parameters)
    {
        return array_sum($parameters);
    }
}
```

**Registering and using the function**

```php
//Include the class
include('add.php');
//Register the class
$xp->functions->register('add', Add::class);
//Use the function
echo $xp->evaluate('ADD(4,5,6)'); // 15
```

> **Tip:** To change the name used to reference a function within a formula, you only need to modify the first parameter given to the `register` method and not the class name.



## Overriding existing functions

If you wish to be able to override existing functions with custom ones, you must enable overriding:

```php
$xp->functions->allowOverride = true;
```