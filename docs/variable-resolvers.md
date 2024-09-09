# Variable Resolvers

Variable Resolvers in Xpression provide an alternative method for defining variable values by calculating the value dynamically when the variable is encountered, rather than requiring it to be predefined. This approach can improve performance, especially in scenarios with numerous potential variables or complex calculations.

## Creating a Variable Resolver

Create a new class with the following structure:

```php
// Resolver.php

use Williams\Xpression\Extendable\VariableResolver;
class Resolver extends VariableResolver{}
```

For each variable, create a method which is the variable's name prefixed by `define`. Within the method, include the necessary code to obtain and then return the variable's value:

```php
public function defineFoo(){
    return 10;
}
```

A `default` method can be used to handle variables which do not have their own method specified. The method accepts one parameter which is the lowercase name of the requested variable:

```php
public function default($var){
    return 0;
}
```

> Use `return false;` to trigger a VariableException with an undefined variable message. 



## Using the Resolver class

Simply instantiate the `Resolver` class  and register it with the `use` method:

```php
$resolver = new Resolver();
$xp->use($resolver);
```

The variables are now available to be used in expressions:

```php
$xp->evaluate('$foo'); // 10
```

## Additional features

### Caching

The `VariableResolver` class provides built-in caching functionality to avoid recalculating the same value multiple times. For example:

```php
public function defineFoo(){
    if($this->cacheHas('foo')){
        return $this->cache('foo');
    }
    $value = getFooValue();
    $this->cache('foo',$value);
    return $value;
}
```

In this code, if the value for 'foo' is already cached, it is returned directly. Otherwise, the value is computed, stored in the cache, and then returned.

**Autocache**

You can simplify the above example using the `autocache` property:

```php
protected array $autocache = ['foo'];
public function defineFoo(){
    // Logic to get $foo value.
    return $foo;
}
```

By adding 'foo' to the `autocache` array, Xpression automatically checks the cache each time the 'foo' variable is encountered. If 'foo' is already cached, the cached value is returned. If not, `defineFoo` is called to compute the value, which is then automatically cached for future use.