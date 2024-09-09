<?php

namespace Williams\Xpression\Expression\SubstringLocators;

use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Expression\Substrings\OperationSubstring;
use Williams\Xpression\Utilities\NumberFormatter;

class OperationLocator extends Locator
{
    public function locate(XpressionString $xprString, $operators): OperationSubstring | false
    {

        $operators = $this->formatOperatorsAsRegex($operators);
        $negativePrefix = preg_quote(NumberFormatter::getNegativePrefix());

        $regex = "/($negativePrefix?\d+(\.\d+)?)($operators)($negativePrefix?\d+(\.\d+)?)/";

        if ($match = $xprString->match($regex)) {
            $string = $match[0];
            $left = NumberFormatter::toNumber($match[1]);
            $right = NumberFormatter::toNumber($match[4]);
            $operator = $match[3];
            $onSubstitute = $this->createSubstitutionHandler($xprString,$string);
            return new OperationSubstring($onSubstitute, $operator, $left, $right);
        } else {
            return false;
        }
    }

    private function formatOperatorsAsRegex($operators)
    {
        if (is_string($operators)) {
            $operators = array($operators);
        }

        foreach ($operators as $i => $operator) {
            $operator = preg_quote($operator);
            $operator = str_replace('/', '\/', $operator);
            $operators[$i] = $operator;
        }
        $operators = join('|', $operators);
        return $operators;
    }
}
