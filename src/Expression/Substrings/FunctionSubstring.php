<?php
namespace Williams\Xpression\Expression\Substrings;

use Williams\Xpression\Factories\ExpressionFactory;

class FunctionSubstring extends ExpressionSubstring{
	public string $name;
	private array $parameters;
	public function __construct($onSubstitute, string $name, array $parameters){
		parent::__construct($onSubstitute);
		$this->name = $name;
		$this->parameters = $parameters;
	}
	
	public function countParameters(){
		return count($this->parameters);
	}
	public function getParameterAsExpression($index){
		if(isset($this->parameters[$index])){
			return ExpressionFactory::create($this->parameters[$index], false);
		}
		return false;
	}
}