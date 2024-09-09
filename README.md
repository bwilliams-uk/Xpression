# Xpression

Xpression is a versatile PHP library designed to evaluate string-formatted mathematical expressions, enabling applications to process user-defined formulas similar to those used in spreadsheet applications.

Key features:

- **BODMAS rule support**, with full handling of nested brackets for complex expressions.
- **Variable substitution**, allowing dynamic input and flexible formula construction.
- **Comparison operators** for evaluating expressions with logical conditions.
- **A comprehensive mathematical and logical functions library**, easily extendable with custom functions to suit specific application needs.

Xpression empowers developers to integrate advanced formula evaluation seamlessly, making it ideal for finance, engineering, or other domains requiring dynamic calculations.

## Installation

Using Composer:

```bash
composer require williams/xpression
```

## Usage

### Getting Started

A simple example showing how Xpression can resolve an expression with just a few lines of code:

```php
require('vendor/autoload.php');
use Williams\Xpression\Xpression;

$xp = Xpression::new();
echo $xp->evaluate('2*3+4'); // 10
```

### Operators

Xpression offers support for common mathematic and comparison operators.

**Mathematical Operators**

```php
$maths = [
    "4^2", // 16 - Powers
    "9/3", // 3  - Division
    "7*5", // 35 - Multiplication
    "5+2", // 7  - Addition
    "4-3", // 1  - Subtracton
];
```

**Comparison Operators**

Comparison operators return either `1` (True) or `0` (False).

```php
$comparisons = [
    "2=2",  // 1  - Equal to
    "4<3",  // 0  - Less Than
    "5>2",  // 1  - Greater Than
    "7<=7", // 1  - Less Than or Equal To
    "8>=9", // 0  - Greater Than or Equal to
    "2<>6", // 1  - Not Equal To
];
```

### Variables

Xpression provides two ways for using variables in expressions. The `with` method allows setting of variable values with an associative array. Alternatively, an on-the-fly lookup can be achieved by using a [Variable Resolver](docs/variable-resolvers.md).

Using the `with` method to set variables:

```php
// Example using variables:
$xp->with([
 'a' => 7,
 'b' => 5
]);

echo $xp->evaluate('$a-$b'); // 2
```

The `affix` method can be used to change how variables are denoted. Supply one parameter to define a prefix:

```php
$xp->affix('%');
echo $xp->evaluate('%a-%b');
```

Alternatively, supply two parameters for encapsulation:

```php
$xp->affix('{','}');
echo $xp->evaluate('{a}-{b}');
```

### Functions

A number of [built-in functions](docs/supported-functions.md) are available. Below is an example using the `MIN` function:

```php
echo $xp->evaluate('MIN($a,$b)'); // 5
```

 If further functionality is required, you can define your own [custom functions](docs/custom-functions.md).

## Further Topics

- [Operator Precedence](docs/operator-precedence.md)

- [Exception Handling](docs/exception-handling.md)

- [Testing](docs/testing.md)
