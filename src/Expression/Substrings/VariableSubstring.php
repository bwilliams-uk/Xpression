<?php
namespace Williams\Xpression\Expression\Substrings;

class VariableSubstring extends ExpressionSubstring{
	public string $name;
	
	public function __construct($onSubstitute, string $name){
		parent::__construct($onSubstitute);
		$this->name = $name;
	}
}