<?php

namespace Williams\Xpression\Expression\SolverComponents;

use Williams\Xpression\Expression\Expression;

class ComparisonSolver extends OperationSolver
{
    public function process(Expression $expression)
    {
        $this->solveOperations($expression, ['=', '<>', '<', '<=', '>', '>=']);
    }
}
