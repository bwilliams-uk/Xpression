<?php

namespace Williams\Xpression\Expression\Substrings;

use Closure;
use Williams\Xpression\DataTypes\XpressionString;

class ExpressionSubstring
{


	public function __construct(
		private Closure $substitutionHandler
	) {}

	public function substitute(int|float|XpressionString $value)
	{
		($this->substitutionHandler)($value);
	}
}
