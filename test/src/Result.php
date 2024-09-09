<?php

namespace Williams\TestTube;

use Williams\TestTube\IAssertionCounter;
use Williams\TestTube\IAssertionResultHandler;

class Result implements IAssertionCounter, IAssertionResultHandler
{
    private string $filename;
    private string $method;
    private int $assertions = 0;
    private int $passCount = 0;
    private int $failCount = 0;
    private array $failureMessages = [];

    public function label(string $filename, string $method)
    {
        $this->filename = $filename;
        $this->method = $method;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function pass(): bool
    {
        return ($this->failCount() === 0);
    }

    public function assertions(): int
    {
        return $this->assertions;
    }

    public function passCount(): int
    {
        return $this->passCount;
    }

    public function failCount(): int
    {
        return $this->failCount;
    }

    public function failureMessages(): array
    {
        return $this->failureMessages;
    }

    public function recordPass()
    {
        $this->assertions++;
        $this->passCount++;
    }

    public function recordFail($message)
    {
        $this->assertions++;
        $this->failCount++;
        $this->failureMessages[] = $message;
    }
}
