<?php
namespace Williams\Xpression\Utilities;

class FileUtils{
    public static function existsOrFail(string $path, string $exceptionType){
        if (!file_exists($path)) throw new $exceptionType("File does not exist at path '$path'");
    }

    public static function returnsCallableOrFail(string $path, string $exceptionType){
        static::existsOrFail($path,$exceptionType);
        $content = include($path);
        if (!is_callable($content)) throw new $exceptionType("Included file does not return callable at '$path'");
        return $content;
    }
}