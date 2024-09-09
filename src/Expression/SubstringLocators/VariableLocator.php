<?php
namespace Williams\Xpression\Expression\SubstringLocators;

use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Expression\Substrings\VariableSubstring;

class VariableLocator extends Locator{
    public function locate(XpressionString $xprString, string $prefix, string $suffix): VariableSubstring | false
    {
        $name = "([a-z0-9_]+)"; // 1 or more permitted characters (a-z, 0-9 and '_')
        $excludeFunctions = '(?!\()'; // Negative lookahead, exlude open bracket
        $prefix = preg_quote($prefix);
        $suffix = preg_quote($suffix);
        $regex = '/' . $prefix . $name . $suffix . $excludeFunctions . '/';
        if (!$match = $xprString->match($regex)) {
            return false;
        }
        $string = $match[0];
        $name = $match[1];

        $onSubstitute = $this->createSubstitutionHandler($xprString,$string);
        return new VariableSubstring($onSubstitute, $name);
    }
}