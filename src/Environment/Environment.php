<?php

namespace Williams\Xpression\Environment;

use Williams\Xpression\Environment\FunctionLibrary\FunctionLibrary;
use Williams\Xpression\Environment\Variables\VariablesService;
use Williams\Xpression\Extendable\VariableResolver;
use Williams\Xpression\Factories\ExpressionFactory;
use Williams\Xpression\Factories\ExpressionSolverFactory;

class Environment
{
	public FunctionLibrary $functions;
	public VariablesService $variables;

	public function __construct(FunctionLibrary $functions, VariablesService $variables)
	{
		$this->functions = $functions;
		$this->variables = $variables;
	}

	// Set the prefix/suffix strings for variables
	public function affix(string $prefix, string $suffix = ''): void
	{
		$this->variables->setPrefix($prefix);
		$this->variables->setSuffix($suffix);
	}

	// Sets the instance of VariableResolver to use to determine variable values.
	public function use(VariableResolver $resolver)
	{
		$this->variables->setResolver($resolver);
	}

	// Set the variables that may be referenced in the expression
	public function with(array $variables): void
	{
		$this->variables->addToDictionary($variables);
	}

	// Evaulate an Expression
	public function evaluate($text): int|float
	{
		$expression = ExpressionFactory::create($text);
		$expressionSolver = ExpressionSolverFactory::create($this);
		$result = $expressionSolver->solve($expression);
		return $result;
	}
}
