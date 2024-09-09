<?php

use Williams\Xpression\Extendable\VariableResolver;

return new class extends ExpressionTest {
    public $expressions = [
        '$bar+$foo+$foo+$undefined+$zero' => 14,
    ];
    public function setup($environment){
        $resolver = new class extends VariableResolver{
            protected array $autocache = ['foo'];
            public function defineFoo(){ return 4;}
            public function defineBar(){return 4;}
            public function default($value){if($value == 'zero') return 0 ; return 2;}
        };
        $instance = new $resolver();
        $environment->use($instance);

        /* Using the with method: 
        $environment->with([
            'foo' => 4,
            'bar' => 2,
            'undefined' => 1,
        ]);
        //*/
    }
};