<?php

use Williams\Xpression\Exceptions\SyntaxException;

return new class extends ExpressionTest {
    public $expectedValue = SyntaxException::class;
    public $expressions = [

        //Unbalanced Brackets
        "MIN(1,2,3",
        "MAX(1,SUM(2,3,4)",
        
        //Invalid Operations
        "2**2",
        "2+5-2-"

    ];
};
