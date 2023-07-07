<?php

namespace Payhub\Exceptions;

class PayhubCreateOrderException extends \Exception
{
    protected array $errors = [];

    public function __construct($response, int $code = 0)
    {
        $message = $response['message'] ?? 'Server error';

        $this->errors = $response['errors'] ?? [];

        parent::__construct($message, $code);
    }

    public function errors()
    {
        return $this->errors;
    }
}
