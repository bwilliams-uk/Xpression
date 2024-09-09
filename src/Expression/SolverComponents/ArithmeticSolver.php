<?php

namespace Williams\Xpression\Expression\SolverComponents;

use Williams\Xpression\Expression\Expression;

class ArithmeticSolver extends OperationSolver
{
    public function process(Expression $expression)
    {
        $this->solveOperations($expression, '^');
        $this->solveOperations($expression, ['*', '/']);
        $this->solveOperations($expression, ['+', '-']);
    }
}
