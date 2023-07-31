<?php

namespace Payhub\Http;

abstract class BaseClient
{
    protected array $config;

    public function processOptions($config): void
    {
        if (! isset($config['url'])) {
            throw new \InvalidArgumentException('Url is required');
        }

        if (! isset($config['token'])) {
            throw new \InvalidArgumentException('Token is required');
        }

        if (! isset($config['key'])) {
            throw new \InvalidArgumentException('Key is required');
        }

        $this->config = $config;
    }

    public function config($key)
    {
        return $this->config[$key] ?? null;
    }

    public function getUrl($url): string
    {
        return str_replace('{key}', $this->config['key'], $url);
    }
}
