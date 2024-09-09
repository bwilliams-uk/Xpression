<?php
//Defines the interface expected of a result sent to Aggregator. 

namespace Williams\TestTube;

interface IAssertionCounter
{
    public function assertions(): int; //The number of assertions in the test
    public function passCount(): int; //The number of successful assertions.
    public function failCount(): int; // number of failed assertions.
    public function failureMessages(): array; //An array of failure messages.
}
