<?php

use Williams\Xpression\Environment\Environment;

class ExpressionTest extends XpressionBaseTest
{

    //Override these properties in Child Class
    protected $expressions = [];
    protected $expectedValue;


    //Test the Expressions and return a result object
    public function testExpressions(Environment $environment) : void
    {
        $this->formatExpressions();
        foreach ($this->expressions as $expression=>$expected) {
            $outcome = $this->tryExpression($environment,$expression);
            $onFailure = "Expression '$expression' : Expected $expected but resolved to $outcome.";
            $this->assertEquals($expected, $outcome, $onFailure);
        }
    }

    //Modifies expression array if list given instead of key-value pairs.
    private function formatExpressions() : void {
        if(array_is_list($this->expressions)){
            $indexedExpressions = [];
            foreach($this->expressions as $expression){
                $indexedExpressions[$expression] = $this->expectedValue;
            }
            $this->expressions = $indexedExpressions;
        }
    }
}
