<?php
namespace Williams\Xpression\Utilities;

class ClassUtils{

    public static function existsOrFail($className,$exceptionType): void
    {
        if (!class_exists($className)) {
            throw new $exceptionType("Class '$className' does not exist.");
        }
    }

    public static function extendsOrFail($childClassName,$parentClassName,$exceptionType): void
    {
        if (!in_array($parentClassName, class_parents($childClassName))) {
            throw new $exceptionType("Class '$childClassName' does not extend '$parentClassName'.");
        }
    }

}