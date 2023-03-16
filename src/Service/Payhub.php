<?php

namespace Payhub\Service;

use Payhub\Contracts\HttpClient;
use Payhub\Http\GuzzleClient;
use Payhub\Models\Order;
use Payhub\Models\PaymentMethod;
use Payhub\Responses\OrderCreateResponse;

class Payhub
{
    protected HttpClient $client;

    protected ?string $key = null;

    public function __construct(array $config = [], ?HttpClient $client = null)
    {
        $this->client = $client ?? new GuzzleClient($config);

        $this->setKey($config['key'] ?? null);
    }

    private function getKey(): string
    {
        if (is_null($this->key)) {
            throw new \InvalidArgumentException('Resource key is required');
        }
        return $this->key;
    }

    public function setKey(mixed $key): static
    {
        $this->key = $key;

        return $this;
    }

    private function getUrl($url): string
    {
        return str_replace('{key}', $this->getKey(), $url);
    }

    public function create(Order $order): OrderCreateResponse
    {
        $response = $this->client->post($this->getUrl('order/{key}/create'), $order->toArray());

        return new OrderCreateResponse($response);
    }

    /**
     * @return array<Order>
     */
    public function getList(): array
    {
        $response = $this->client->get($this->getUrl('order/{key}'));

        return array_map(fn($item) => new Order($item), $response);
    }

    public function getById($id): Order
    {
        $response = $this->client->get($this->getUrl("order/{key}/$id"));

        return new Order($response);
    }

    /**
     * @return array<PaymentMethod>
     */
    public function getPaymentMethods(): array
    {
        $response = $this->client->get('payment-method/list');

        return array_map(fn($item) => new PaymentMethod($item), $response);
    }
}