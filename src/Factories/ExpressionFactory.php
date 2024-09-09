<?php

namespace Williams\Xpression\Factories;

use Exception;
use Williams\Xpression\DataTypes\SanitizedXpressionString;
use Williams\Xpression\DataTypes\XpressionString;
use Williams\Xpression\Exceptions\SyntaxException;
use Williams\Xpression\Expression\Expression;
use Williams\Xpression\Expression\SubstringLocators\BracketLocator;
use Williams\Xpression\Expression\SubstringLocators\FunctionLocator;
use Williams\Xpression\Expression\SubstringLocators\OperationLocator;
use Williams\Xpression\Expression\SubstringLocators\VariableLocator;

class ExpressionFactory
{
	public static function create(string $text, $sanitizeInput = true)
	{
		if ($sanitizeInput) {
			$input = static::sanitizeInput($text);
		} else {
			$input = new XpressionString($text);
		}
		return new Expression(
			$input,
			new VariableLocator,
			new BracketLocator,
			new FunctionLocator,
			new OperationLocator
		);
	}

	private static function sanitizeInput($text)
	{
		try {
			return new SanitizedXpressionString($text);
		} catch (Exception $e) {
			$message = "Expression '" . $text . "' is invalid (" . $e->getMessage() . ").";
			throw new SyntaxException($message);
		}
	}
}
