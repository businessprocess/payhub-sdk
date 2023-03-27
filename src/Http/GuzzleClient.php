<?php

namespace Payhub\Http;

use Payhub\Contracts\HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class GuzzleClient extends BaseClient implements HttpClient
{
    private \GuzzleHttp\Client $http;

    public function __construct(array $config = [])
    {
        $this->processOptions($config);

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->config['url'],
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $this->config['token'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                RequestOptions::CONNECT_TIMEOUT => $config['connect_timeout'] ?? 80,
                RequestOptions::TIMEOUT => $config['timeout'] ?? 30,
                'http_errors' => true,
            ],
        ]);
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
        $response = $this->getHttp()->get($this->getUrl($uri), [RequestOptions::QUERY => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function post(string $uri, array $options = []): array
    {
        $response = $this->getHttp()->post($this->getUrl($uri), [RequestOptions::JSON => $options]);

        return json_decode($response->getBody()->getContents(), true);
    }
}