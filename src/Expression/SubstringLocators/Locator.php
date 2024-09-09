<?php

namespace Williams\Xpression\Expression\SubstringLocators;

use Closure;
use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Utilities\NumberFormatter;

class Locator
{

    /*Creates a Closure that accepts one argument ($value) 
    which replaces the first occurence of $substring in $expressionText.*/

    protected function createSubstitutionHandler(XpressionString $expressionText, string $substring): Closure
    {
        $handler = function (int|float|XpressionString $value) use ($expressionText, $substring) {
            if (in_array(gettype($value), ['integer', 'double'])) {
                $value = NumberFormatter::toString($value);
            } else {
                $value = $value->currentText();
            }
            $expressionText->replaceFirst($substring, $value);
        };
        return $handler;
    }
}
