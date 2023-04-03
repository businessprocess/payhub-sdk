<?php

namespace Payhub\Http;

use GuzzleHttp\RequestOptions;
use Payhub\Contracts\HttpClient;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class Client extends BaseClient implements HttpClient
{
    protected PendingRequest|Factory $http;

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
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function get(string $uri, array $options = []): array
    {
        return $this->getHttp()->get($this->getUrl($uri), $options)->throw()->json();
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function post(string $uri, array $options = []): array
    {
        return $this->getHttp()->post($this->getUrl($uri), $options)->throw()->json();
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function put(string $uri, array $options = []): array
    {
        return $this->getHttp()->put($this->getUrl($uri), $options)->throw()->json();
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function delete(string $uri, array $options = []): array
    {
        return $this->getHttp()->delete($this->getUrl($uri), $options)->throw()->json();
    }
}