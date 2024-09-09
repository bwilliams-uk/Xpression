<?php

namespace Williams\TestTube;

use Williams\TestTube\IAssertionCounter;

class ResultAggregator
{
    private array $results = [];

    //Get the number of tests sent to the aggregator
    public function testCount()
    {
        return count($this->results);
    }

    //Get TestResult objects for passed tests.
    public function passed()
    {
        return array_filter($this->results, fn($result) => $result->pass());
    }

    // Get TestResult objects for failed tests.
    public function failed()
    {
        return array_filter($this->results, fn($result) => (!$result->pass()));
    }

    // Get the count of failed tests.
    public function failCount()
    {
        return count($this->failed());
    }

    //Get the count of passed tests.
    public function passCount()
    {
        return count($this->passed());
    }

    //Get the number of files which the tests were contained in.
    public function fileCount()
    {
        return count($this->getMethodCounts());
    }

    //Get the number of assertions in all tests.
    public function assertionCount()
    {
        return $this->sumResultMethod('assertions');
    }

    //Get the number of successful assertions in all tests.
    public function assertionPassCount()
    {
        return $this->sumResultMethod('passCount');
    }

    //Get the number of unsuccessful asssertions in all tests.
    public function assertionFailCount()
    {
        return $this->sumResultMethod('failCount');
    }

    /* Returns an array of failure messages from all tests.
    Includes a prefix consisting of the relevant file and  
    test method. If the test method is the sole test within
    that class, then it is omitted. */
    public function failureMessages()
    {
        $methodCounts = $this->getMethodCounts();
        $messages = [];
        foreach ($this->results as $result) {
            $file = $result->getFilename();
            $method = $result->getMethod();

            if ($methodCounts[$file] > 1) {
                $key = "$file:$method";
            } else {
                $key = $file;
            }

            foreach ($result->failureMessages() as $message) {
                $messages[] = "[$key] $message";
            }
        }
        return $messages;
    }

    //Send a test result to the aggregator
    public function send(IAssertionCounter $result)
    {
        $this->results[] = $result;
    }

    //Gets the sum total of the specified TestResult method for contained test results.
    private function sumResultMethod($methodName)
    {
        $count = 0;
        foreach ($this->results as $result) {
            $count += call_user_func([$result, $methodName]);
        }
        return $count;
    }

    // Get an array, indexed by test filename, with the number of test methods it features.
    private function getMethodCounts()
    {
        $counts = [];
        foreach ($this->results as $result) {
            $file = $result->getFilename();
            if (!isset($counts[$file])) {
                $counts[$file] = 1;
            } else {
                $counts[$file]++;
            }
        }
        return $counts;
    }
}
