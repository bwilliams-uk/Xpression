<?php

use Williams\Xpression\Exceptions\FunctionException;

return new class extends ExpressionTest {
    public $expectedValue = FunctionException::class;
    public $expressions = [

        //Non existent function
        "FunctionNotExist(2)",
        
        //Disabled functions
        "AND(1,1)",
        "MIN(1,2)",
        "MAX(1,2)",
    ];

    public function setup($environment)
    {
        $environment->functions->disable('AND');
        $environment->functions->disable(['MIN','MAX']);
    }
};
