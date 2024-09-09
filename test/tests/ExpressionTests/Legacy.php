<?php

return new class extends ExpressionTest {
    public $expressions = [
        // Variable Substitution
        '$a+$b' => 3,
        '$c-$b' => 1,
        '$aa^$b' => 100,

        //Functions
        'max($a,$aa)' => 10,
        'max(2+2,$aa,($b*$c*$aa))' => 60,
        'avg($b,$c,4,5,6)' => 4,
        'and($b*3=$c*2,$aa=$a+9)' => 1,

        // Operator Precedence
        "2+3*4" => 14,       // Multiplication before addition
        "6/2+5" => 8,        // Division before addition
        "5+6/2" => 8,        // Division before addition
        "2*3-4" => 2,        // Multiplication before subtraction

        // Parenthesis Handling
        "(2+3)*4" => 20,     // Parenthesis before multiplication
        "6/(1+2)" => 2,      // Parenthesis before division
        "(8-3)*(2+3)" => 25, // Parenthesis before multiplication
        "3*(3+4)/7" => 3,    // Mixed operations with parenthesis

        // Exponentiation
        "2^3" => 8,
        "3^2+4" => 13,
        "2^(1+1)" => 4,
        "(2+2)^3" => 64,

        // Nested Expressions
        "(2*(3+4))^2" => 196,
        "((1+2)*3)^2" => 81,
        "(2+3)*(4+5)" => 45,
        "((2+3)*2)^(1+1)" => 100,

        // Mixed Operations
        "3+5*2-8/4" => 11,
        "10-2*(3+4)/2" => 3,
        "(4+2)/(1+1)^2" => 1.5,
        "5*(2+(3*4))/2" => 35,

        // Division and Remainder
        "10/2" => 5,
        "20/4*3" => 15, // Division and multiplication
        "15/(7-2)" => 3, // Division with subtraction
        "16/(2^2)" => 4, // Division with exponentiation

        // Complex Nested Operations
        "2^((3+1)*2)" => 256,
        "((2+3)*2)^(2-1)" => 10,
        "4^(3-1)+(6/2)" => 19,
        "((5+3)*(2^2))/(4-2)" => 16,

        // Handling Zero
        "0+0" => 0,
        "0*5" => 0,
        "10*0+5" => 5,
        "0^5" => 0,   // Zero exponent
        "5^0" => 1,   // Zero as the exponent

        // More Complex Operations
        "(1+2)^(3*2)" => 729,
        "((8/4)+2)^(2+1)" => 64,
        "3^3+2*2-5/5" => 30,
        "(7+3)/(1+1)^(2-1)" => 5,

        // Edge Cases
        "1/(2/(2+1))" => 1.5, // Division with nested fraction
        "(2+2)^0" => 1,       // Any number to the power of 0
        "(5^2-4*2)+3" => 20,  // Mixed operations with subtraction
        "((3*3)+2)^(2-1)" => 11, // Complex expression with exponentiation

        // Large Numbers
        "1000/5+200*3" => 800,
        "2^10" => 1024,
        "9999*0+1" => 1,
        "1000/(2^3)" => 125,
    ];

    public function setup($environment)
    {
        $environment->with([
        "a" => 1,
        "b" => 2,
        "c" => 3,
        "aa" => 10
        ]);
    }
};
