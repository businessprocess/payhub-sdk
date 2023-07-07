<?php

namespace Payhub\Service;

use Payhub\Contracts\HttpClient;
use Payhub\Exceptions\PayhubCreateOrderException;
use Payhub\Http\GuzzleClient;
use Payhub\Models\Order;
use Payhub\Models\PaymentMethod;
use Payhub\Responses\OrderCreateResponse;

class Payhub
{
    protected HttpClient $client;

    protected Webhook $webhook;

    public function __construct(array $config = [], ?HttpClient $client = null)
    {
        $this->client = $client ?? new GuzzleClient($config);

        $this->webhook = new Webhook($this->client);
    }

    /**
     * @throws PayhubCreateOrderException
     */
    public function create(Order $order): OrderCreateResponse
    {
        try {
            $response = $this->client->post('order/{key}/create', $order->toArray());
        } catch (\Illuminate\Http\Client\RequestException $e) {
            throw new PayhubCreateOrderException(
                $e->response->json(),
                $e->response->status()
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new PayhubCreateOrderException(
                json_decode($e->getResponse()->getBody()->getContents(), true),
                $e->getResponse()->getStatusCode()
            );
        }

        return new OrderCreateResponse($response);
    }

    /**
     * @return array<Order>
     */
    public function getList(): array
    {
        $response = $this->client->get('order/{key}');

        return array_map(fn ($item) => new Order($item), $response);
    }

    public function getById($id): Order
    {
        $response = $this->client->get("order/{key}/$id");

        return new Order($response);
    }

    public function check($checkoutId): array
    {
        return $this->client->get("order/{key}/check/$checkoutId");
    }

    /**
     * @return array<PaymentMethod>
     */
    public function getPaymentMethods(): array
    {
        $response = $this->client->get('payment-method/list');

        return array_map(fn ($item) => new PaymentMethod($item), $response);
    }

    public function webhook(): Webhook
    {
        return $this->webhook;
    }
}
