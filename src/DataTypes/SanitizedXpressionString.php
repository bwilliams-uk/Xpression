<?php
//Extends XpressionString with sanitization so it can be successfully interpretted by ExpressionSolver.
// Sanitization is performed on construct.
//Construction will cause an Exception if sanitization is unsuccessful.

namespace Williams\Xpression\DataTypes;

use Exception;
use Williams\Xpression\Utilities\NumberFormatter;
use Williams\Xpression\Utilities\Operators;

class SanitizedXpressionString extends XpressionString
{
    public function __construct(string $text)
    {
        parent::__construct($text);

        //Sanitized string must contain equal open/close parentheses
        $this->balancedBracketsOrFail();

        //Sanitized string must not contain forbidden strings
        $this->withoutForbiddenStringsOrFail();

        //Sanitized string must be lower case
        $this->lowercase();

        //Sanitized string must not contain whitespace
        $this->removeWhitespace();

        //Sanitized string must use the designated negative number prefix in place of '-'.
        $this->prefixNegatives();
    }

    private function balancedBracketsOrFail()
    {
        if ($this->hasBalancedBrackets()) {
            throw new Exception("Text contains unbalanced brackets.");
        }
    }

    // Check open/close bracket counts match
    private function hasBalancedBrackets()
    {
        $open = $this->substringCount('(');
        $close = $this->substringCount(')');
        return ($open != $close);
    }

    private function withoutForbiddenStringsOrFail()
    {
        foreach ($this->getForbiddenStrings() as $forbidden) {
            if ($this->substringCount($forbidden) > 0) {
                throw new Exception("Text contains forbidden string '$forbidden'.");
            }
        }
    }

    private function getForbiddenStrings()
    {
        $forbiddenStrings = [
            NumberFormatter::getNegativePrefix()
        ];
        return $forbiddenStrings;
    }

    private function prefixNegatives()
    {
        $this->prefixLeadingNegative();
        $this->prefixNegativesAfterOperators();
    }

    private function prefixLeadingNegative()
    {
        if ($this->currentText()[0] == '-') {
            $this->replaceFirst('-', NumberFormatter::getNegativePrefix());
        }
    }

    private function prefixNegativesAfterOperators()
    {
        foreach (Operators::keys() as $operator) {
            $this->replaceAll($operator . '-', $operator . NumberFormatter::getNegativePrefix());
        }
    }
}
