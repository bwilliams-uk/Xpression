<?php

namespace Williams\Xpression\Environment\FunctionLibrary;

use Williams\Xpression\Exceptions\FunctionException;

class FunctionLibraryEntry
{
    private string $name;
    private string | null $class = null;
    private bool $enabled = true;

    public function __construct(string $name, string $class = null, bool $enabled = true)
    {
        $this->name = $name;
        $this->class = $class;
        $this->enabled = $enabled;
    }

    public function getName(){
        return $this->name;
    }

    public function createClassInstance()
    {
        return new $this->class;
    }

    public function disable()
    {
        $this->enabled = false;
    }

    public function enable()
    {
        $this->enabled = true;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function enabledOrFail()
    {
        if (!$this->isEnabled()) {
            throw new FunctionException("Function '$this->name' is disabled.");
        }
    }
}
