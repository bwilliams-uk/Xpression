<?php

namespace Williams\TestTube;

use Williams\TestTube\ITest;

class TestIterator
{
    private int $methodCursor = 0;
    private ITest $instance;

    public function __construct(ITest $instance)
    {
        $this->instance = $instance;
    }

    // Creates a TestAdapter Object for the next test in the file.
    public function next()
    {
        $method = $this->nextMethodName();
        if ($method) {
            return new TestAdapter($method, $this->instance);
        }
        return false;
    }

    // Gets the next test method name in a test and increments the cursor. Returns FALSE at end.
    private function nextMethodName()
    {
        $methods = $this->instance->useMethods();
        if (isset($methods[$this->methodCursor])) {
            $method = $methods[$this->methodCursor];
            $this->methodCursor++;
            return $method;
        } else {
            $this->methodCursor = 0;
            return false;
        }
    }
}
