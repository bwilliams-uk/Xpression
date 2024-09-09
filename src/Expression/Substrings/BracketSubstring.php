<?php
namespace Williams\Xpression\Expression\Substrings;

use Williams\Xpression\Factories\ExpressionFactory;

class BracketSubstring extends ExpressionSubstring{

	private string $innerContent;

	public function __construct($onSubstitute,$innerContent)
	{
		parent::__construct($onSubstitute);
		$this->innerContent = $innerContent;
	}

	public function toExpression(){
		return ExpressionFactory::create($this->innerContent,false);
	}
}