<?php

namespace Williams\TestTube;

class TestNameRegister
{
    private array $instances;

    //Registers a name for an instance of a test class.
    public function register($name, $instance)
    {
        $this->instances[$name] = $instance;
    }

    // Look up the name of an instance of a test class.
    public function lookup($instance)
    {
        return array_search($instance, $this->instances);
    }
}
