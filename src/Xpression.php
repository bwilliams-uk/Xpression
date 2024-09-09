<?php
namespace Williams\Xpression;

use Williams\Xpression\Environment\Environment;
use Williams\Xpression\Environment\FunctionLibrary\FunctionExecutor;
use Williams\Xpression\Environment\FunctionLibrary\FunctionLibrary;
use Williams\Xpression\Environment\FunctionLibrary\FunctionRegister;
use Williams\Xpression\Environment\Variables\VariableDictionary;
use Williams\Xpression\Environment\Variables\VariablesService;

class Xpression{
    public static function new(){
        $functions = new FunctionLibrary(
            new FunctionRegister,
            new FunctionExecutor,
        );
        $variables = new VariablesService(
            new VariableDictionary,
        );
        $functions->loadFromFile(__DIR__ . '/Functions/DefaultFunctionRegister.php');
        return new Environment($functions,$variables);
    }
}