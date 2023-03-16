<?php

namespace Payhub\Http;

use Payhub\Contracts\HttpClient;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class Client implements HttpClient
{
    protected PendingRequest|Factory $http;

    private array $config;

    public function __construct(Factory $factory, array $config = [])
    {
        $this->processOptions($config);

        $this->http = $factory->asJson()
            ->baseUrl($this->config['url'])
            ->withToken($this->config['token'])
            ->timeout(30);
    }

    /**
     * @return Factory|PendingRequest
     */
    public function getHttp(): Factory|PendingRequest
    {
        return $this->http;
    }

    /**
     * @param $config
     * @return void
     */
    public function processOptions($config): void
    {
        if (!isset($config['url'])) {
            throw new \InvalidArgumentException('Url is required');
        }

        if (!isset($config['token'])) {
            throw new \InvalidArgumentException('Token is required');
        }
        $this->config = $config;
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function get(string $uri, array $options = []): array
    {
        return $this->getHttp()->get($uri, $options)->throw()->json();
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function post(string $uri, array $options = []): array
    {
        return $this->getHttp()->post($uri, $options)->throw()->json();
    }
}