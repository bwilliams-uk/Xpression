<?php

namespace Williams\Xpression\Factories;

use Williams\Xpression\Environment\Environment;
use Williams\Xpression\Expression\ExpressionSolver;
use Williams\Xpression\Expression\SolverComponents\ArithmeticSolver;
use Williams\Xpression\Expression\SolverComponents\ComparisonSolver;
use Williams\Xpression\Expression\SolverComponents\ComplexitiesSolver;
use Williams\Xpression\Expression\SolverComponents\VariableSubstitutor;


class ExpressionSolverFactory
{
    public static function create(Environment $environment)
    {

        return new ExpressionSolver(
            new VariableSubstitutor($environment),
            new ComplexitiesSolver($environment),
            new ArithmeticSolver($environment),
            new ComparisonSolver($environment)
        );
    }
}
