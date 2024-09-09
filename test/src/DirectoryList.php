<?php

namespace Williams\TestTube;

class DirectoryList
{
    private array $testDirectories = [];
    private int $cursor = 0;

    //Add a TestDirectory to the list
    public function append(TestDirectory $testDirectory)
    {
        $this->testDirectories[] = $testDirectory;
    }

    //Iterate over directories in the list
    public function fetch()
    {
        if (isset($this->testDirectories[$this->cursor])) {
            $directory = $this->testDirectories[$this->cursor];
            $this->cursor++;
            return $directory;
        }
        $this->cursor = 0;
        return false;
    }
}
