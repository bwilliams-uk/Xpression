<?php

//Defines the interface of a result object used by TestBase

namespace Williams\TestTube;

interface IAssertionResultHandler
{
    public function recordPass(); //Records a passed assertion in the result
    public function recordFail($message); // Records a failed assertion in the result
}
