<?php

namespace Payhub\Http;

use GuzzleHttp\RequestOptions;
use Payhub\Contracts\HttpClient;

class GuzzleClient extends BaseClient implements HttpClient
{
    private \GuzzleHttp\Client $http;

    public function __construct(array $config = [])
    {
        $this->processOptions($config);

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->config('url'),
            RequestOptions::HEADERS => [
                'Authorization' => $this->config('token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                RequestOptions::CONNECT_TIMEOUT => $this->config('connect_timeout') ?? 80,
                RequestOptions::TIMEOUT => $this->config('timeout') ?? 30,
                'http_errors' => true,
            ],
        ]);
    }

    public function getHttp(): \GuzzleHttp\Client
    {
        return $this->http;
    }

    public function get(string $uri, array $options = []): ?array
    {
        $response = $this->getHttp()->get($this->getUrl($uri), [RequestOptions::QUERY => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function post(string $uri, array $options = []): ?array
    {
        $response = $this->getHttp()->post($this->getUrl($uri), [RequestOptions::JSON => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function put(string $uri, array $options = []): ?array
    {
        $response = $this->getHttp()->put($this->getUrl($uri), [RequestOptions::JSON => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function delete(string $uri, array $options = []): ?array
    {
        $response = $this->getHttp()->delete($this->getUrl($uri), [RequestOptions::JSON => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
