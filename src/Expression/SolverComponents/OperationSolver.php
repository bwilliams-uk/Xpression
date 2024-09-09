<?php

namespace Williams\Xpression\Expression\SolverComponents;

use Williams\Xpression\Expression\Expression;
use Williams\Xpression\Expression\Substrings\OperationSubstring;
use Williams\Xpression\Utilities\Operators;

class OperationSolver
{
    protected function solveOperations(Expression $expression, $operators)
    {
        while ($operation = $expression->nextOperation($operators)) {
            $this->solveOperation($operation);
        }
    }

    protected function solveOperation(OperationSubstring $operation)
    {
        $value = Operators::evaluate($operation->operator, $operation->left, $operation->right);
        $operation->substitute($value);
    }
}
