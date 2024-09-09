<?php

namespace Williams\TestTube;

class Executor
{
    private ResultAggregator $resultAggregator;

    // Set the result aggregator which receives test result
    public function sendTo(ResultAggregator $aggregator)
    {
        $this->resultAggregator = $aggregator;
    }

    //Coordinate the preparation,execution and result delivery of a Test Method.
    public function executeTest(TestAdapter $test): void
    {
        $test->prepare();
        $test->execute();
        $result = $test->getResult();
        $this->resultAggregator->send($result);
    }

    //Execute all tests in a TestFile Instance
    public function executeFile(TestFile $file)
    {
        $testIterator = $file->createTestIterator();
        while ($test = $testIterator->next()) {
            $this->executeTest($test);
        }
    }

    // Execute all tests in an array of TestFile Instances
    public function executeFiles(array $files)
    {
        foreach ($files as $file) {
            $this->executeFile($file);
        }
    }
}
