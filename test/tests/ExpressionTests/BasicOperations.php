<?php

return new class extends ExpressionTest {
    public $expressions = [
        "20+5" => 25,
        "35-10" => 25,
        "5*5" => 25,
        "5^2" => 25,
        "125/5" => 25,
        "1+1" => 2,
        "2*3" => 6,
        "10-4" => 6,
        "8/2" => 4,
    ];
};
