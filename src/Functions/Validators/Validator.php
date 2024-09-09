<?php

namespace Williams\Xpression\Functions\Validators;

use Williams\Xpression\Exceptions\ParameterException;

class Validator
{
    protected string|null $exceptionMessage = null;

    protected function fail($message)
    {
        $message = $this->exceptionMessage ?? $message;
        throw new ParameterException($message);
    }

    public function withMessage(string|null $message)
    {
        $this->exceptionMessage = $message;
        return $this;
    }

    public function clearMessage(){
        $this->exceptionMessage = null;
        return $this;
    }
}
