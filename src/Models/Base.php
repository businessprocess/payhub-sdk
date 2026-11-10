<?php

namespace Payhub\Models;

abstract class Base
{
    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            $method = 'set'.static::camelCase($key);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }

    public function toArray(): array
    {
        return [];
    }

    protected static function camelCase(string $value): string
    {
        $words = explode(' ', str_replace(['-', '_'], ' ', $value));

        return lcfirst(implode(array_map('ucfirst', $words)));
    }

    public function __toArray(): array
    {
        return $this->toArray();
    }
}
