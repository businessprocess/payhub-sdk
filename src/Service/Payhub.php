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

    public function __construct(array $config = [], ?HttpClient $client = null)
    {
        $this->client = $client ?? new GuzzleClient($config);
    }

    public function create(Order $order): OrderCreateResponse
    {
        $response = $this->client->post('order/{key}/create', $order->toArray());

        return new OrderCreateResponse($response);
    }

    /**
     * @return array<Order>
     */
    public function getList(): array
    {
        $response = $this->client->get('order/{key}');

        return array_map(fn($item) => new Order($item), $response);
    }

    public function getById($id): Order
    {
        $response = $this->client->get("order/{key}/$id");

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