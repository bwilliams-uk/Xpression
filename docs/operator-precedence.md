### Operator Precedence

Xpression resolves expressions in the following order of operations:

1. **Brackets and Functions**
2. **Powers**
3. **Multiplication and Division** (evaluated left to right)
4. **Addition and Subtraction** (evaluated left to right)
5. **Comparisons** (evaluated left to right)

#### Important Note on Multiple Comparisons

When using multiple comparison operators, keep in mind that each comparison evaluates to either `1` (true) or `0` (false). This can affect subsequent comparisons. Consider the following example:

```php
2 = 2 = 2
```

Here’s how it is resolved step by step:

1. **First comparison**: `2 = 2` evaluates as true (`1`).
   
   Now the expression is:
   
   ```php
   (1) = 2
   ```

2. **Second comparison**: `1 = 2` evaluates as false (`0`).

So, the final result is `0`.
