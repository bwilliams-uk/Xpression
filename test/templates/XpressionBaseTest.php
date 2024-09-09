<?php
use Williams\Xpression\Environment\Environment;
use Williams\Xpression\Xpression;

class XpressionBaseTest extends BaseTest
{
    public function boot()
    {
        // Tests will be passed one parameter: Environment.
        return Xpression::new();
    }

    // Returns either the resolved expression value or the class name of the thrown Exception.
    protected function tryExpression(Environment $xp, string $expression) : mixed
    {
        try {
            $resolution = $xp->evaluate($expression);
        } catch (Exception $e) {
            $resolution = get_class($e);
        }
        return $resolution;
    }
}
