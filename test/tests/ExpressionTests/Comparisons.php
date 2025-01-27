<?php

return new class extends ExpressionTest {
    public $expressions = [
        "5=5" => 1,
        "4<5" => 1,
        "6>4" => 1,
        "5<>6" => 1,
        "5>=5" => 1,
        "5<=5" => 1,
        "5<>5" => 0,
        "4>5" => 0,
        "6<4" => 0,
        "5=6" => 0,
        '2=2' => 1,
        '2=3' => 0,
        '2<>2' => 0,
        '2<>3' => 1,
        '2<=2' => 1,
        '2<=2=1=(2=2)' => 1,
        '2=2=1' => 1,
        '2=2=2' => 0,
        '2=1=0' => 1,
        '2<>1=0' => 0,

    ];
};
