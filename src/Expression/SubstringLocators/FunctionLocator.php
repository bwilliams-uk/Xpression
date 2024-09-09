<?php

namespace Williams\Xpression\Expression\SubstringLocators;

use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Expression\Substrings\FunctionSubstring;

class FunctionLocator extends Locator
{
    public function locate(XpressionString $xprString): FunctionSubstring | false
    {
        // matches functionName(parameters) so long as no parentheses are present in parameters.
        if (!$match = $xprString->match("/([A-Za-z0-9_]+)\(([^()]*)\)/")) {
            return false;
        }
        $string = $match[0];
        $name = $match[1];
        $parameterText = $match[2];
        if ($parameterText == '') {
            $parameters = [];
        } else {
            $parameters = explode(',', $parameterText);
        }
        $onSubstitute = $this->createSubstitutionHandler($xprString,$string);
        return new FunctionSubstring($onSubstitute, $name, $parameters);
    }
}
