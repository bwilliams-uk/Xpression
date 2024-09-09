<?php
use Williams\Xpression\Exceptions\ParameterException;

return new class extends ExpressionTest {
    public $expectedValue = ParameterException::class;
    public $expressions = [

        //Invalid number of parameters
        "ROUND(1.1)",
        "IF(1,2,3,44)",    
    ];
};
