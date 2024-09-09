<?php

return new class extends ExpressionTest {
    public $expressions = [
        'MIN($a,$b,$c)' => 1,
        'MAX($a,$b,$c)' => 3,
        'AVG($a,$b,$c)' => 2,
        '$a+$b+$c' => 6,
        'MAX($array)' => 5,
        '$x_min*$x_sum'=> 22,
        '$neg^2' => 25,
        '10-$neg' => 15,

    ];
    public function setup($environment){
        $environment->with([
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'array' => [2,4,5],
            'x_min' => 'MIN(2,7)',
            'x_sum' => 'SUM(2,4,5)',
            'neg' => -5,
        ]);
    }
};
