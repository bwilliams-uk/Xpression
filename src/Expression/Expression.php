<?php

namespace Williams\Xpression\Expression;

use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Expression\SubstringLocators\BracketLocator;
use Williams\Xpression\Expression\SubstringLocators\FunctionLocator;
use Williams\Xpression\Expression\SubstringLocators\OperationLocator;
use Williams\Xpression\Expression\SubstringLocators\VariableLocator;
use Williams\Xpression\Expression\Substrings\BracketSubstring;
use Williams\Xpression\Expression\Substrings\FunctionSubstring;
use Williams\Xpression\Expression\Substrings\OperationSubstring;
use Williams\Xpression\Expression\Substrings\VariableSubstring;
use Williams\Xpression\Utilities\NumberFormatter;

class Expression
{

    public function __construct(
        private XpressionString $text,
        private VariableLocator $variableLocator,
        private BracketLocator $bracketLocator,
        private FunctionLocator $functionLocator,
        private OperationLocator $operationLocator,
        ){}


    public function currentText()
    {
        return $this->text->currentText();
    }

    public function history()
    {
        return $this->text->history();
    }

    public function toNumeric()
    {
        return NumberFormatter::toNumber($this->currentText());
    }

    public function nextVariable($prefix, $suffix): VariableSubstring | false
    {
        return $this->variableLocator->locate($this->text,$prefix,$suffix);
    }

    public function nextBracket(): BracketSubstring | false
    {
        return $this->bracketLocator->locate($this->text);
    }

    public function nextFunction(): FunctionSubstring | false
    {
        return $this->functionLocator->locate($this->text);
    }
    
    public function nextOperation($operators): OperationSubstring | false
    {
        return $this->operationLocator->locate($this->text,$operators);
    }

}
