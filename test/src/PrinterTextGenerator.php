<?php

namespace Williams\TestTube;

class PrinterTextGenerator
{
    private string $failuresHead = 'The following assertions were unsuccessful:';
    private string $author = 'TestTube: Created by Ben Williams.';

    private array $plurals = [
        'file' => 'files',
        'test' => 'tests',
        'assertion' => 'assertions',
    ];


    public function failuresHead()
    {
        return $this->failuresHead;
    }

    public function author()
    {
        return $this->author;
    }

    public function fileSummary($fileCount)
    {
        $filesText = $this->plural('file', $fileCount);
        return "$fileCount test $filesText found.";
    }

    public function countSummary($testCount, $assertionCount, $passCount, $failCount)
    {
        // Set singular or plural text
        $testText = $this->plural('test', $testCount);
        $assertionText = $this->plural('assertion', $assertionCount);

        return "$testCount $testText ($assertionCount $assertionText). $passCount Passed, $failCount Failed.";
    }

    private function plural($text, $int)
    {
        if ($int === 1) {
            return $text;
        }
        return $this->plurals[$text];
    }
}
