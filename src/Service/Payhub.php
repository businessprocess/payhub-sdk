<?php

namespace Payhub\Service;

use Payhub\Contracts\HttpClient;
use Payhub\Exceptions\PayhubCreateOrderException;
use Payhub\Http\GuzzleClient;
use Payhub\Models\Order;
use Payhub\Models\PaymentMethod;
use Payhub\Models\PaymentTurnover;
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
    public function create(Order $order, bool $fast = false): OrderCreateResponse
    {
        try {
            $method = $fast ? 'pay' : 'create';

            $response = $this->client->post("order/$method", $order->toArray());
        } catch (\Illuminate\Http\Client\RequestException $e) {
            throw new PayhubCreateOrderException(
                $e->response->json('message') ?? $e->getMessage(),
                $e->response->status(),
                $e->response->json()
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
            throw new PayhubCreateOrderException(
                $errors['message'] ?? $e->getMessage(),
                $e->getResponse()->getStatusCode(),
                $errors
            );
        }

        return new OrderCreateResponse($response);
    }

    /**
     * @return array<Order>
     */
    public function getList(): array
    {
        $response = $this->client->get('order/list');

        return array_map(fn ($item) => new Order($item), $response);
    }

    public function getById($id): Order
    {
        $response = $this->client->get("order/$id");

        return new Order($response);
    }

    public function check($checkoutId): array
    {
        return $this->client->get("order/check/$checkoutId");
    }

    public function link($checkoutId): string
    {
        return $this->client->config('url').$checkoutId;
    }

    /**
     * @return array<PaymentMethod>
     */
    public function getPaymentMethods(): array
    {
        $response = $this->client->get('payment-method/list');

        return array_map(fn ($item) => new PaymentMethod($item), $response);
    }

    public function getTurnover($method = 'stripe'): PaymentTurnover
    {
        $response = $this->client->get("payment/$method/turnover");

        return new PaymentTurnover($response);
    }

    public function webhook(): Webhook
    {
        return $this->webhook;
    }
}
