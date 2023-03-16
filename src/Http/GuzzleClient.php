<?php

namespace Payhub\Http;

use Payhub\Contracts\HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class GuzzleClient implements HttpClient
{
    private \GuzzleHttp\Client $http;

    private array $config;

    public function __construct(array $config = [])
    {
        $this->processOptions($config);

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->config['url'],
            RequestOptions::HEADERS => [
                'Authorization' => $this->config['token'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                RequestOptions::CONNECT_TIMEOUT => $config['connect_timeout'] ?? 80,
                RequestOptions::TIMEOUT => $config['timeout'] ?? 30,
                'http_errors' => true,
            ],
        ]);
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
     * @return \GuzzleHttp\Client
     */
    public function getHttp(): \GuzzleHttp\Client
    {
        return $this->http;
    }

    public function get(string $uri, array $options = []): array
    {
        $response = $this->getHttp()->get($uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function post(string $uri, array $options = []): array
    {
        $response = $this->getHttp()->post($uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}