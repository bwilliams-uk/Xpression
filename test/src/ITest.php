<?php

//Defines the interface of a user test class as expected by TestAdapter and TestIterator.

namespace Williams\TestTube;

interface ITest
{
    public function boot(); // Objects returned by boot are passed as parameters to both the setup and run methods
    public function useMethods(): array; // Returns Array of methods to treat as test methods.
    public function setResult($result); //Inject the Result Object
    public function getResult(); //Returns the Test Result
}
