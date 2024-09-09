<?php

/* Purpose: To create an interface of a user-created test class
that may be used by Williams\TestTube\Executor.php. 
*/

namespace Williams\TestTube;

use Williams\TestTube\ITest;

class TestAdapter
{

    //Store the parameters passed to the method between $this->prepare() and $this->execute()
    private array $parameters;

    //The name of the method containing the test:
    private $method;

    //The instance of the underlying test class:
    private ITest $instance;

    public function __construct($method, ITest $instance)
    {
        $this->method = $method;
        $this->instance = $instance;
    }

    //Prepare the test method for execution
    public function prepare()
    {
        $this->instance->setResult(new Result);
        $parameters = $this->getParameters();
        $this->setup($parameters);
        $this->parameters = $parameters;
    }

    //Execute the test method
    public function execute()
    {
        call_user_func_array([$this->instance, $this->method], $this->parameters);
    }

    //Get the result of the test
    public function getResult()
    {
        $result = $this->instance->getResult();
        $name = ActiveRequest::getTestNameRegister()->lookup($this->instance);
        $result->label($name, $this->method);
        return $result;
    }

    //Obtain parameters as an array from the test's boot method.
    private function getParameters()
    {
        $parameters = $this->instance->boot();
        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }
        return $parameters;
    }

    //Pass the parameters through the test's setup method if it exists.
    private function setup($parameters)
    {
        if (method_exists($this->instance, 'setup')) {
            $this->instance->setup(...$parameters);
        }
    }
}
