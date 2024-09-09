<?php

namespace Williams\Xpression\Functions;

use Williams\Xpression\Exceptions\ParameterException;

class ParameterList
{
    public function __construct(
        protected array $parameters
    ) {}

    public function count()
    {
        return count($this->parameters);
    }

    public function parameters(){
        return $this->parameters;
    }

    public function parameter($index){
        if(!isset($this->parameters[$index])){
            throw new ParameterException("No parameter at index $index.");
        }
        return $this->parameters[$index];
    }
}
