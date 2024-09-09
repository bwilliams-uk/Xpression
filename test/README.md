# TestTube: Unit Testing Framework

TestTube is a lightweight and extensible unit testing framework for PHP. Originally built to support the [Xpression](http://github.com/bwilliams-uk/xpression) library, its design prioritizes flexibility, making it suitable for small to medium-sized projects.

## Requirements

- **Composer** must be installed.

## Installation

1. Create a new TestTube project (you can replace 'example' with your desired directory name):

```bash
composer create-project williams/testtube example
```

2. Configure `composer.json` to autoload the PHP libraries you want to test:

```json
"autoload": {
    "psr-4": {
        "Namespace\\Of\\Library\\" : "path/to/library/"
    }
}
```

3. Regenerate autoload files:

```bash
composer dump-autoload
```

## Writing Your First Test

Let’s create a simple test for a `Calculator` class.

1. Inside the `tests` directory, create a folder to group your test files (e.g., `demo`). Create a PHP file for your tests, such as `calculator.php`:

```php
//tests/demo/calculator.php

return new class extends BaseTest{
};
```

2. Define a `boot` method to instantiate the object(s) required for your tests:

```php
use Demo\Calculator;

return new class extends BaseTest{

    public function boot(){
        return new Calculator;
    }
};
```

If more than one object is required, return an array containing the objects:

```php
return [ new Foo, new Bar ];
```

3. Create a test method. Each test method should take as parameters the objects returned by the `boot` method. By default, test method names must be camel-cased and start with 'test':

```php
use Demo\Calculator;

return new class extends BaseTest{

    public function boot(){
        return new Calculator;
    }

    public function testAdd($calculator){

    }

};
```

4. Define the body of the test, using an appropriate `assert` method:

```php
   public function testAdd($calculator){
       $output = $calculator->add(2,3);
       $this->assertEquals(5,$output);
   }
```

5. Run your tests from the project's root directory

```bash
php test
```

Example Output:

```
1 test file found.
1 test (1 assertion). 1 Passed, 0 Failed.
```

5. Modify the expected value to simulate a failed test:

```php
$this->assertEquals(6, $result); // Intentionally wrong
```

Re-running the tests will produce:

```
1 test file found.
1 test (1 assertion). 0 Passed, 1 Failed.

The following assertions were unsuccessful:

[demo/calculator.php] Failed to assert 6 equals 5.
```

> Once a test file contains more than one test, the output will show both the filename and method name to help pinpoint failures.

## Advanced Features

### Assertions

TestTube includes several `assert` methods:

- `assertEquals($expected, $actual, $failureMessage = null)`
- `assertTrue($boolean, $failureMessage = null)`
- `assertFalse($boolean, $failureMessage = null)`

The `$failureMessage` parameter is optional, and a default message will be generated if omitted.

### Custom Test Method Names

If you need non-standard test method names, you can declare them using the `$useMethods` property. You can also disable automatic detection of test methods starting with "test" by setting `$useTestMethods` to `false`:

```php
return new class extends BaseTest {
    protected $useMethods = ['customTest'];
    protected $useTestMethods = false;

    public function customTest() {
        // This is a valid test method.
    }

    public function testExample() {
        // This method will not be treated as a test due to $useTestMethods being false.
    }
};
```

### Templates

To follow the DRY (Don't Repeat Yourself) principle, TestTube allows you to extend from templates stored in the `templates` directory. For example, to share a `boot` method across multiple test files:

1. Create a reusable template:

```php
// templates/CalculatorBaseTest.php

use Demo\Calculator;

class CalculatorBaseTest extends BaseTest{

    public function boot(){
        return new Calculator;
    }
}
```

2. In your test file, extend this template:

```php
// tests/demo/calculator.php

return new class extends CalculatorBaseTest{

    public function testAdd($calculator){
        $output = $calculator->add(2,3);
        $this->assertEquals(5,$output);
    }
};
```

### The `setup` Method

The `setup` method helps to maintain a separation of concerns between object creation and configuration. It allows for any further customisation of the objects returned by the `boot` method before each test. Like test methods, it must accept each object returned by `boot` as a parameter:

```php
return new class extends CalculatorBaseTest {
    public function setup($calculator) {
        $calculator->useRadians();
        $calculator->roundDecimalPlaces(2);
    }
};
```