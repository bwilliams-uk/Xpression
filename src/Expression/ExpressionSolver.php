<?php

namespace Williams\Xpression\Expression;

use Williams\Xpression\Exceptions\SyntaxException;
use Williams\Xpression\Expression\SolverComponents\ArithmeticSolver;
use Williams\Xpression\Expression\SolverComponents\ComparisonSolver;
use Williams\Xpression\Expression\SolverComponents\ComplexitiesSolver;
use Williams\Xpression\Expression\SolverComponents\VariableSubstitutor;

class ExpressionSolver
{
	public function __construct(
		private VariableSubstitutor $variableSubstitutor,
		private ComplexitiesSolver $complexitiesSolver,
		private ArithmeticSolver $arithmeticSolver,
		private ComparisonSolver $comparisonSolver,
	)
	{}

	public function solve(Expression $expression)
	{
		$this->variableSubstitutor->process($expression);
		$this->complexitiesSolver->process($expression,$this); //Functions and Brackets
		$this->arithmeticSolver->process($expression);
		$this->comparisonSolver->process($expression);
		return $this->getExpressionValueOrFail($expression);
	}

	private function getExpressionValueOrFail(Expression $expression)
	{
		$value = $expression->toNumeric();
		if ($value === false) {
			throw new SyntaxException("The expression is not valid.");
		}
		return $value;
	}










}
