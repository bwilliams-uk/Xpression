<?php

namespace Williams\Xpression\Factories;

use Williams\Xpression\Functions\Parameter;
use Williams\Xpression\Functions\ParameterList;

class ParameterListFactory
{
    public static function create(array $parameterValues)
    {
        $parameters = [];
        foreach ($parameterValues as $p) {
            $parameters[] = new Parameter($p);
        }

        return new ParameterList($parameters);
    }
}
