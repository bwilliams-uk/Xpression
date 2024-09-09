<?php

namespace Williams\TestTube;

use Williams\TestTube\IAssertionResultHandler;
use Williams\TestTube\ITest;

class TestBase implements ITest
{

    protected $useMethods = []; //Define which methods are tests.
    protected $useTestMethods = true; // Automatically include methods structured like 'testCamelCase' as tests. 
    protected IAssertionResultHandler $result; //IAssertionResultHandler ensures object has methods: recordPass, recordFail

    public function boot() {}

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }

    // Returns an array of methods which are 'Tests'.
    public function useMethods(): array
    {
        $methods = $this->useMethods;
        if ($this->useTestMethods) {
            $methods = array_merge($methods, $this->getTestMethods());
        }
        return array_unique($methods);
    }

    //Returns an array of camel-case methods beginning with 'test'.
    private function getTestMethods()
    {
        $methods = get_class_methods($this);
        $filter = function ($item) {
            return preg_match("/^test[A-Z]/", $item);
        };
        return array_filter($methods, $filter);
    }

    protected function assertEquals($expected, $actual, $failMessage = null)
    {
        if ($actual == $expected) {
            $this->result->recordPass();
        } else {
            $failMessage = $failMessage ?? "Failed to assert $actual equals $expected.";
            $this->result->recordFail($failMessage);
        }
    }

    protected function assertTrue($value, $failMessage = null)
    {
        if ($value === TRUE) {
            $this->result->recordPass();
        } else {
            $failMessage = $failMessage ?? "Failed to assert $value as TRUE.";
            $this->result->recordFail($failMessage);
        }
    }

    protected function assertFalse($value, $failMessage = null)
    {
        if ($value === FALSE) {
            $this->result->recordPass();
        } else {
            $failMessage = $failMessage ?? "Failed to assert $value as FALSE.";
            $this->result->recordFail($failMessage);
        }
    }
}
