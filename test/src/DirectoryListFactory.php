<?php

namespace Williams\TestTube;

class DirectoryListFactory
{

    //Create a TestDirectoryListObject relative to a given root directory.
    public static function create($testsPath)
    {
        $list = new DirectoryList();
        foreach (static::getFolders($testsPath) as $folder) {
            $path = $testsPath . $folder . '\\';
            $directory = new TestDirectory($path);
            $list->append($directory);
        }
        return $list;
    }

    //Get folder names in given directory
    private static function getFolders($dir)
    {
        $contents = scandir($dir);
        $filter = fn($item) => is_dir($dir . '/' . $item . '/');
        return array_diff(array_filter($contents, $filter), ['.', '..']);
    }
}
