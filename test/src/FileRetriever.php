<?php

namespace Williams\TestTube;

class FileRetriever
{
    public function fromDirectoryList(DirectoryList $directoryList)
    {
        $files = [];
        while ($directory = $directoryList->fetch()) {
            $files = array_merge($files, $directory->files());
        }
        return $files;
    }
}
