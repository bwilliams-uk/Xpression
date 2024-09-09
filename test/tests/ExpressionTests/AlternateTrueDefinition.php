<?php

return new class extends ExpressionTest {
    public $expressions = [
        'IF(-1,1,0)'=>1,
        'IF(1,1,0)'=>0,
        'IF(0,1,0)'=>0,
        'IF(-2,1,0)'=>0,
        'IF(2,1,0)'=>0,

    ];
    public function setup($environment){
        // Only -1 is TRUE
        $environment->functions->truthy = fn($val)=>($val===-1);
    }
};
