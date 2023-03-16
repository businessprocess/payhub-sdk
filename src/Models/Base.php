<?php

namespace Payhub\Models;

abstract class Base
{
    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            $method = 'set' . str_camel_case($key);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }

    public function __toArray(): array
    {
        return $this->toArray();
    }
}