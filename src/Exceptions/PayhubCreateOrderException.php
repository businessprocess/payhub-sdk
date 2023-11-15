<?php

namespace Payhub\Exceptions;

class PayhubCreateOrderException extends \Exception
{
    protected ?array $errors = [];

    public function __construct(string $message = 'Server error', int $code = 0, ?array $errors = [])
    {
        $this->errors = $errors ?? [];

        parent::__construct($message, $code);
    }

    public function errors()
    {
        return $this->errors;
    }
}
