# Testing

Xpression is developed with a suite of tests, built on the [TestTube Framework](http://github.com/bwilliams-uk/TestTube) to confirm expressions produce the expected result. Instructions for running and creating tests are provided below (intended for developers only).

## Running the Test Suite

From the terminal:

```bash
path/to/Williams/Xpression/test> php test
```

## Creating an Expression Test

Create a new test case at `path/to/Williams/Xpression/test/ExpressionTests/TestName.php`.

The file must return an anonymous class extending `ExpressionTest`:

```php
<?php
// TestName.php
return new class extends ExpressionTest{};
?>
```

**Adding expressions**

Set the `expressions` property with an associative array where the key is the expression and the value is the expected result:

```php
<?php
// TestName.php
return new class extends ExpressionTest{
    public $expressions = [
        '2+3' => 5,
        '10-4' => 6,
    ];
};
?>
```

Alternatively, if all expressions have the same expected value, you can set the `expectedValue` property:

```php
return new class extends ExpressionTest{
    public $expectedValue = 2;
    public $expressions = [
        '2+2',
        '10-6',
    ];
};
```

This is particularly useful for testing error cases, as the full name of the Exception class will be returned.

```php
return new class extends ExpressionTest{
    public $expectedValue = SyntaxException::class;
    public $expressions = [
        '2+5+',
        'six - five',
    ];
};
```

**The setup method**

An optional setup method is used to provide instructions for configuring the test environment. For instance if you need to include variables:

```php
return new class extends ExpressionTest{
    public $expressions = [
        '$a+$b' => 5,
    ];

    public function setup($xp){
        $xp->with([
            'a' => 3,
            'b' => 2,
        ]);
    }
};
```

## Debugging a failed expression test

If an expression is not successful in producing the expected result, the `explain` script may be used to print a breakdown of the workings of an expression.

**Usage**

```bash
path\to\Xpression\test>php explain "MAX(1,2,3)*4+MIN(5,6)"
```

**Output**

```
MAX(1,2,3)*4+MIN(5,6)
max(1,2,3)*4+min(5,6)
3*4+min(5,6)
3*4+5
12+5
17

No Exceptions were thrown. The expression evaluated to 17.
```