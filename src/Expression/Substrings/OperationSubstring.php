<?php
namespace Williams\Xpression\Expression\Substrings;

class OperationSubstring extends ExpressionSubstring{
	public string $operator;
	public int|float $left;
	public int|float $right;
	
	public function __construct($onSubstitute, string $operator, int|float $left, int| float $right){
		parent::__construct($onSubstitute);
		$this->operator = $operator;
		$this->left = $left;
		$this->right = $right;
	}
}