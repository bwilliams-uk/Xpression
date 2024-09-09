<?php

namespace Williams\Xpression\Expression\SolverComponents;

use Exception;
use Williams\Xpression\DataTypes\SanitizedXpressionString;
use Williams\Xpression\Exceptions\VariableException;
use Williams\Xpression\Expression\Expression;
use Williams\Xpression\Expression\Substrings\VariableSubstring;

class VariableSubstitutor extends SolverComponent{

    public function process(Expression $expression)
	{
		$prefix = $this->environment->variables->getPrefix();
		$suffix = $this->environment->variables->getSuffix();
		while ($var = $expression->nextVariable($prefix, $suffix)) {
			$value = $this->getSanitizedVariableValue($var);
			$var->substitute($value);
		}
	}

	private function getSanitizedVariableValue(VariableSubstring $var)
	{
		$value = $this->environment->variables->lookup($var->name);
		if (is_string($value)) {
			try {
				$value = new SanitizedXpressionString($value);
			} catch (Exception $e) {
				$message = "Variable '" . $var->name . "' is invalid (" . $e->getMessage() . ").";
				throw new VariableException($message);
			}
		}
		return $value;
	}
}
