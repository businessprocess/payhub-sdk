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

        $url = parse_url($config['url']);

        $config['url'] = sprintf('%s://%s/', $url['scheme'], $url['host']);

        $this->config = $config;
    }

    public function config($key)
    {
        return $this->config[$key] ?? null;
    }

    public function getUrl($url): string
    {
        return "api/v1/$url";
    }
}
