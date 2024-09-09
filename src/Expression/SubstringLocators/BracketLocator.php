<?php

namespace Williams\Xpression\Expression\SubstringLocators;

use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Expression\Substrings\BracketSubstring;

class BracketLocator extends Locator
{
    public function locate(XpressionString $xprString): BracketSubstring | false
    {
        if ($match = $xprString->match("/\([^()]+\)/")) {
            $string = $match[0];
            $innerContent = trim($string,'()');
            $onSubstitute = $this->createSubstitutionHandler($xprString,$string);

            return new BracketSubstring($onSubstitute, $innerContent);
        }
        return false;
    }
}
