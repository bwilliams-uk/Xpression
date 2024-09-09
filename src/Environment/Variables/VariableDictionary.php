<?php

namespace Williams\Xpression\Environment\Variables;

use Williams\Xpression\Exceptions\VariableException;

class VariableDictionary
{
    private array $variables = [];

    //Adds an associative array of variable values to the dictionary.
    public function add($variables)
    {
        foreach ($variables as $key => $value) {
            $formatted = $this->format($value);
            if($formatted === false){
                throw new VariableException("Variable '$key' is an unsupported type.");
            }
            $this->variables[$key] = $formatted;
        }
    }

    //Looks up a specified variable name from the dictionary. Returns NULL if undefined.
    public function lookup($variableName)
    {
        if (!isset($this->variables[$variableName])) {
            return null;
        }
        return $this->variables[$variableName];
    }

    //Formats a value for insertion into the dictionary. Returns FALSE on failure.
    private function format($value)
    {
        switch (gettype($value)) {
            // For integers, floats and strings: return the value.
            case 'integer':
            case 'double':
            case 'string':
                return $value;
                break;
            // For arrays: return a comma separated list of values.
            case 'array':
                if(!$this->isImplodable($value)) return false;
                return implode(',', $value);
                break;
            // Other types: return false (failure)
            default:
                return false;
                break;
        }
    }

    // Returns TRUE if a given array consists only of integers, floats and strings.
    private function isImplodable(array $array)
    {
        $allowedTypes = ['integer', 'double', 'string'];
        $types = array_unique(array_map('gettype', $array));
        $diff = array_diff($types, $allowedTypes);
        return (empty($diff));
    }
}
