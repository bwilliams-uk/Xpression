<?php

namespace Williams\TestTube;

class TestDirectory
{

    public function __construct(
        private string $path
    ) {}

    // Get the full path to the directory
    public function getPath()
    {
        return $this->path;
    }

    // Get an array of files in the directory as TestFile objects.
    public function files()
    {
        $files = [];
        foreach (glob($this->path . '*.php') as $path) {
            $files[] = new TestFile($path);
        }
        return $files;
    }
}
