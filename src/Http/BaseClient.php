<?php

namespace Payhub\Http;

abstract class BaseClient
{
    protected array $config;

    public function processOptions($config): void
    {
        $host = request()->getSchemeAndHttpHost();

        if (isset($config['app_eu_url']) && isset($config['eu_url']) && $host === $config['app_eu_url']) {
            $config['url'] = $config['eu_url'];
        } elseif (isset($config['app_ru_url']) && isset($config['ru_url']) && $host === $config['app_ru_url']) {
            $config['url'] = $config['ru_url'];
        }

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
