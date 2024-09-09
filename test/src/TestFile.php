<?php

namespace Williams\TestTube;

class TestFile
{
    public function __construct(
        private string $path
    ) {}

    //Create a TestIterator object for the file
    public function createTestIterator()
    {
        $instance = $this->instantiate();
        return new TestIterator($instance);
    }

    // Create an instance of the test file's anonymous class
    private function instantiate()
    {
        $class = include($this->path);
        $instance = new $class;
        $name = ActiveRequest::getFriendlyName($this->path);
        ActiveRequest::getTestNameRegister()->register($name, $instance);
        return $instance;
    }
}
