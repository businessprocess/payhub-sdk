<?php

namespace Payhub\Http;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use OidcAuth\Service\OidcService;
use Payhub\Contracts\HttpClient;

class Client extends BaseClient implements HttpClient
{
    protected PendingRequest|Factory $http;

    public function __construct(Factory $factory, OidcService $service, array $config = [])
    {
        $this->processOptions($config);

        $this->http = $factory->asJson()
            ->acceptJson()
            ->baseUrl($this->config('url'))
            ->timeout($this->config('timeout') ?? 30)
            ->withHeaders([
                'authorization' => $this->config('token') ?? $service->serviceToken(),
            ]);

    }

    public function getHttp(): Factory|PendingRequest
    {
        return $this->http;
    }

    public function get(string $uri, array $options = []): ?array
    {
        return $this->getHttp()->get($this->getUrl($uri), $options)->throw()->json();
    }

    public function post(string $uri, array $options = []): ?array
    {
        return $this->getHttp()->post($this->getUrl($uri), $options)->throw()->json();
    }

    public function put(string $uri, array $options = []): ?array
    {
        return $this->getHttp()->put($this->getUrl($uri), $options)->throw()->json();
    }

    public function delete(string $uri, array $options = []): ?array
    {
        return $this->getHttp()->delete($this->getUrl($uri), $options)->throw()->json();
    }
}
