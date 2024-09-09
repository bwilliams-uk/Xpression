# Supported Functions

### Function Reference

The following examples demonstrate each function with numeric arguments for simplicity, it is also possible to use variables, nested expressions or other functions inside a function.

**ABS**

Gets the absolute value of a number.

```php
"ABS(-4)" // 4
```

**AND**

Returns 1 if all values are true, otherwise 0.

```php
"AND(1,1,1)" // 1
"AND(0,1,1)" // 0
```

**AVG**

Gets the mean average of the parameters given.

```php
"AVG(2,3,4)" // 3
```

**CEIL**

Rounds a number up to the next integer.

```php
"CEIL(4.2)" // 5
```

**COUNT**

Counts the number of parameters.

```php
"COUNT(2,2,2)" // 3
```

**COUNTIF**

Counts the number of times the first parameter appears in subsequent parameters.

```php
"COUNTIF(5,4,2,5,5,2,4)" // 2
```

> Note COUNTIF can only accept integer values. A ParameterException will be thrown if given a float value.

**COUNTNOT**

Counts the number of subsequent parameters which are not equal to the first parameter.

```php
"COUNTNOT(1,1,1,2,2,3,4)" // 4
```

**EQUAL**

Returns 1 if all parameters are equal, otherwise 0.

```php
"EQUAL(2,2,2,2)" // 1
"EQUAL(2,2,5,2)" // 0
```

**FLOOR**

Rounds a number down to the previous integer.

```php
"FLOOR(6.7)" // 6
```

**IF**

If the first parameter is true the second parameter is returned, otherwise the third parameter is returned.

```php
"IF(1,2,3)" // 2
"IF(0,2,3)" // 3
```

**INDEX**

Treats the first parameter as index *n*. Gets the *nth* subsequent parameter.

```php
"INDEX(3,5,6,7,8,9)" // 7
```

**LARGE**
Treats the first parameter as *n*. Returns the *nth* largest of subsequent parameters.

```php
"LARGE(2,1,3,5,7)" // 5
```

**MAX**

Returns the maximum value of the parameters given.

```php
"MAX(2,3,4)" // 4
```

**MIN**

Returns the minimum value of the parameters given.

```php
"MIN(2,3,4)" // 2
```

**MOD**

Returns the remainder after dividing the first parameter by the second parameter.

```php
"MOD(8,3)" // 2
```

**NAND**

Returns 0 when all parameters are true, otherwise 1.

```php
"NAND(1,1,1)" // 0
"NAND(1,1,0)" // 1
```

**NOR**

Returns 1 when all parameters are false, otherwise 1.

```php
"NOR(0,0)" // 1
"NOR(0,1)" // 0
```

**NOT**

Returns 1 when the supplied parameter is false and 0 when it is true.

```php
"NOT(1)" // 0
"NOT(0)" // 1
```

**OR**

Returns 1 when any value is true, otherwise 0.

```php
"OR(0,1,0)" // 1
"OR(0,0,0)" // 0
```

**RAND**

Returns a parameter at random.

```php
"RAND(1,2,3)" // Perhaps 1, 2 or 3.
```

**RANDBETWEEN**

Returns a random integer between parameter 1 and parameter 2 inclusive.

```php
"RANDBETWEEN(2,4)" // Perhaps 2,3 or 4.
```

**ROUND**

Rounds a number (parameter 1) to the specified precision (parameter 2).

```php
"ROUND(2.4321,2)" // 2.43
"ROUND(87,-1)"  // 90
```

**SMALL**
Treats the first parameter as *n*. Returns the *nth* smallest of subsequent parameters.

```php
"SMALL(2,1,3,5,7)" // 3
```

**SUM**

Returns the sum of parameters.

```php
"SUM(2,3,5)" // 10
```

**XOR**

Returns 1 if exactly one parameter is true, otherwise 0.

```php
"XOR(1,0,0)" // 1
"XOR(1,0,1)" // 0
```

### Modifying Function Behaviour

**Changing the defintion of TRUE**

A number of functions such as `AND` and `OR` require testing whether a value is regarded as true or false.

By default Xpression treats any non-zero value as true. However, a custom function can be supplied to test whether a value is true or false:

```php
// TRUE is defined as being greater than 0.
$xp->functions->truthy = fn($value)=>($value > 0);

// TRUE is defined as being equal to 1.
$xp->functions->truthy = fn($value)=>($value == 1);
```

### Disabling a built-in function

If you do not wish for certain built-in functions to be available in your application they can be disabled:

```php
$xp->functions->disable('IF');
```

Attempting to use the disabled function in an expression will throw a `FunctionException`.

**To reverse the disable action:**

```php
$xp->functions->enable('IF');
```
