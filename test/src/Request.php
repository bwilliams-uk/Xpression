<?php

namespace Williams\TestTube;

class Request
{

    private string $rootPath; //Full path of TestTube project root
    private string $testDir; //Name of test directory, relative to root.
    private array $args; // Command Line Arguments
    private TestNameRegister $testNameRegister;

    public function __construct($rootPath, $testDir, $args)
    {
        $this->rootPath = $rootPath;
        $this->testDir = $testDir;
        $this->args = $args;
        $this->testNameRegister = new TestNameRegister();
    }

    public function getTestNameRegister()
    {
        return $this->testNameRegister;
    }

    public function getRootPath()
    {
        return $this->rootPath;
    }

    public function getTestDir()
    {
        return $this->testDir;
    }

    public function directoryList()
    {
        return DirectoryListFactory::create($this->getTestPath());
    }

    //Removes the test directory from a path name, leaving a relative location.
    public function getFriendlyName($path)
    {
        $path = realpath($path);
        $path = str_replace($this->getTestPath(), '', $path);
        $path = trim($path, '\\/');
        return $path;
    }

    //Get the full path of the test folder
    public function getTestPath()
    {
        $path = $this->getRootPath() . '\\' . $this->getTestDir() . '\\';
        return realpath($path) . '\\';
    }
}
