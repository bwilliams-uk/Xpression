<?php

use Williams\Xpression\Environment\FunctionLibrary\FunctionLibrary;
use Williams\Xpression\Functions\Defined\AbsFunction;
use Williams\Xpression\Functions\Defined\AndFunction;
use Williams\Xpression\Functions\Defined\CeilFunction;
use Williams\Xpression\Functions\Defined\CountFunction;
use Williams\Xpression\Functions\Defined\CountIfFunction;
use Williams\Xpression\Functions\Defined\CountNotFunction;
use Williams\Xpression\Functions\Defined\EqualFunction;
use Williams\Xpression\Functions\Defined\FloorFunction;
use Williams\Xpression\Functions\Defined\IfFunction;
use Williams\Xpression\Functions\Defined\IndexFunction;
use Williams\Xpression\Functions\Defined\LargeFunction;
use Williams\Xpression\Functions\Defined\MaxFunction;
use Williams\Xpression\Functions\Defined\MeanFunction;
use Williams\Xpression\Functions\Defined\MinFunction;
use Williams\Xpression\Functions\Defined\ModFunction;
use Williams\Xpression\Functions\Defined\NandFunction;
use Williams\Xpression\Functions\Defined\NorFunction;
use Williams\Xpression\Functions\Defined\NotFunction;
use Williams\Xpression\Functions\Defined\OrFunction;
use Williams\Xpression\Functions\Defined\RandBetweenFunction;
use Williams\Xpression\Functions\Defined\RandFunction;
use Williams\Xpression\Functions\Defined\RoundFunction;
use Williams\Xpression\Functions\Defined\SmallFunction;
use Williams\Xpression\Functions\Defined\SumFunction;
use Williams\Xpression\Functions\Defined\XorFunction;

//Function to register built-in functions.
return function (FunctionLibrary $library) {

    $library
    ->register('min', MinFunction::class)
    ->register('max', MaxFunction::class)
    ->register('avg', MeanFunction::class)
    ->register('if', IfFunction::class)
    ->register('and', AndFunction::class)
    ->register('or', OrFunction::class)
    ->register('rand', RandFunction::class)
    ->register('randbetween', RandBetweenFunction::class)
    ->register('equal', EqualFunction::class)
    ->register('floor', FloorFunction::class)
    ->register('ceil', CeilFunction::class)
    ->register('abs', AbsFunction::class)
    ->register('mod', ModFunction::class)
    ->register('round', RoundFunction::class)
    ->register('xor', XorFunction::class)
    ->register('countif',CountIfFunction::class)
    ->register('not',NotFunction::class)
    ->register('nor',NorFunction::class)
    ->register('nand',NandFunction::class)
    ->register('index',IndexFunction::class)
    ->register('sum',SumFunction::class)
    ->register('small',SmallFunction::class)
    ->register('large',LargeFunction::class)
    ->register('count',CountFunction::class)
    ->register('countnot',CountNotFunction::class);
};
