<?php

namespace Williams\TestTube;

class Printer
{
    private $aggregator;
    private PrinterTextGenerator $textGenerator;

    public function __construct()
    {
        $this->textGenerator = new PrinterTextGenerator();
    }

    public function retrieveFrom(ResultAggregator $aggregator)
    {
        $this->aggregator = $aggregator;
    }

    public function print()
    {
        //$this->newLine(1);
        //$this->author();
        $this->newLine(1);
        $this->fileSummary();
        if ($this->aggregator->testCount() > 0) {
            $this->countSummary();
            $this->newLine(1);
            $this->failures();
        } else {
            $this->newLine();
        }
    }

    private function fileSummary()
    {
        $files = $this->aggregator->fileCount();
        echo $this->textGenerator->fileSummary($files);
        $this->newLine();
    }

    private function countSummary()
    {
        // Get count values
        $agg = $this->aggregator;
        $tests = $agg->testCount();
        $assertions = $agg->assertionCount();
        $passes = $agg->passCount();
        $fails = $agg->failCount();

        echo $this->textGenerator->countSummary($tests, $assertions, $passes, $fails);
        $this->newLine(1);
    }

    private function failures()
    {
        //Do nothing if no failures.
        if (!$this->aggregator->failCount()) return;

        $this->failuresHead();
        $this->failuresBody();
        $this->newLine();
    }

    private function failuresHead()
    {
        echo $this->textGenerator->failuresHead();
        $this->newLine(2);
    }

    private function failuresBody()
    {
        //Print Failure Messages
        foreach ($this->aggregator->failureMessages() as $message) {
            echo $message;
            $this->newLine();
        }
    }

    private function newLine($n = 1)
    {
        echo str_repeat(PHP_EOL, $n);
    }

    private function author()
    {
        echo $this->textGenerator->author();
        $this->newLine();
    }
}
