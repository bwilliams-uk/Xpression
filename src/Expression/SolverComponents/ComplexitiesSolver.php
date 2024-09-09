<?php

namespace Williams\Xpression\Expression\SolverComponents;

use Williams\Xpression\Expression\Expression;
use Williams\Xpression\Expression\ExpressionSolver;
use Williams\Xpression\Expression\Substrings\FunctionSubstring;

class ComplexitiesSolver extends SolverComponent
{
    private ExpressionSolver $parent;

    public function process(Expression $expression, ExpressionSolver $parent)
    {
        $this->parent = $parent;
        do {
            $previous = $expression->currentText();
            $this->resolveFunctions($expression);
            $this->resolveNextBracket($expression);
        } while ($previous != $expression->currentText());
    }

    private function resolveFunctions(Expression $expression)
    {
        while ($function = $expression->nextFunction()) {
            $this->resolveFunction($function);
        }
    }

    private function resolveFunction(FunctionSubstring $function)
    {
        $parameters = $this->makeFunctionParameterArray($function);
        $resolution = $this->environment->functions->execute($function->name,$parameters);
        $function->substitute($resolution);
    }

    private function makeFunctionParameterArray(FunctionSubstring $function)
    {
        $parameterCount = $function->countParameters();
        $values = [];
        for ($i = 0; $i < $parameterCount; $i++) {
            $values[] = $this->parent->solve($function->getParameterAsExpression($i));
        }
        return $values;
    }

    private function resolveNextBracket(Expression $expression)
    {
        $bracket = $expression->nextBracket();
        if (!$bracket) return;
        $resolution = $this->parent->solve($bracket->toExpression());
        $bracket->substitute($resolution);
    }
}
