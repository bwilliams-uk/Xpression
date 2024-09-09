<?php

namespace Williams\Xpression\Environment\Variables;

use Williams\Xpression\Extendable\VariableResolver;
use Williams\Xpression\Exceptions\VariableException;

class VariablesService
{
    private string $prefix = '$';
    private string $suffix = '';
    private  VariableDictionary $variableDictionary;
    private VariableResolver $resolver;

    public function __construct(VariableDictionary $variableDictionary)
    {
        $this->variableDictionary = $variableDictionary;
    }

    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setSuffix(string $suffix)
    {
        $this->suffix = $suffix;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function setResolver(VariableResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function addToDictionary(array $variables): void
    {
        $this->variableDictionary->add($variables);
    }

    public function lookup(string $varName)
    {
        $value = $this->variableDictionary->lookup($varName);
        if (is_null($value) && $resolver = $this->getResolver()) {
            $value = $resolver->resolve($varName);
        }
        if ($value === false || is_null($value)) {
            throw new VariableException("Variable '$varName' is undefined.");
        }
        return $value;
    }

    private function getResolver()
    {
        return (isset($this->resolver)) ? $this->resolver : null;
    }
}
