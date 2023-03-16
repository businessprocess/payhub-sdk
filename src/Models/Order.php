<?php

namespace Payhub\Models;

use Payhub\Support\Normalizer;

class Order extends Base
{
    protected bool $type = true;
    protected array $paymentMethods;
    protected mixed $orderId;
    protected mixed $total;
    protected mixed $sale;
    protected ?string $callbackUrl;
    protected string $language;
    protected string $date;

    protected OrderClient $client;
    protected OrderDelivery $delivery;
    protected OrderProductCollection $products;
    private Normalizer $normalizer;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->client = new OrderClient($params['client'] ?? []);
        $this->delivery = new OrderDelivery($params['delivery'] ?? []);
        $this->products = new OrderProductCollection($params['products'] ?? []);
        $this->normalizer = new Normalizer;
    }

    public function normalize(Base $model): Base
    {
        $this->normalizer->build($model);

        return $model;
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'paymentMethods' => $this->type,
            'orderId' => $this->type,
            'total' => $this->type,
            'sale' => $this->sale,
            'client' => $this->normalize($this->client)->toArray(),
            'delivery' => $this->normalize($this->delivery)->toArray(),
            'products' => $this->products->toArray(),
        ]);
    }

    public static function make($params = []): static
    {
        return new static($params);
    }

    public function isSandbox(): bool
    {
        return !$this->type;
    }

    public function sandbox(): static
    {
        $this->type = false;

        return $this;
    }

    public function setType($type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPaymentMethods(): array
    {
        return $this->paymentMethods;
    }

    public function setPaymentMethods(array $paymentMethods): static
    {
        $this->paymentMethods = $paymentMethods;

        return $this;
    }

    public function getOrderId(): mixed
    {
        return $this->orderId;
    }

    public function setOrderId(mixed $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getTotal(): mixed
    {
        return $this->total;
    }

    public function setTotal(mixed $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getSale(): mixed
    {
        return $this->sale;
    }

    public function setSale(mixed $sale): static
    {
        $this->sale = $sale;

        return $this;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(?string $callbackUrl): static
    {
        if ($callbackUrl && !filter_var($callbackUrl, FILTER_VALIDATE_URL)) {
            throw new \LogicException('Callback must be a url');
        }

        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(\DateInterval $date): static
    {
        $this->date = $date->format('Y-m-d');

        return $this;
    }

    /**
     * @return OrderClient
     */
    public function getClient(): OrderClient
    {
        return $this->client;
    }

    /**
     * @param OrderClient $client
     */
    public function setClient(OrderClient $client): void
    {
        $this->client = $client;
    }

    /**
     * @return OrderDelivery
     */
    public function getDelivery(): OrderDelivery
    {
        return $this->delivery;
    }

    /**
     * @param OrderDelivery $delivery
     */
    public function setDelivery(OrderDelivery $delivery): void
    {
        $this->delivery = $delivery;
    }

    /**
     * @return OrderProductCollection
     */
    public function getProducts(): OrderProductCollection
    {
        return $this->products;
    }

    /**
     * @param OrderProductCollection $products
     */
    public function setProducts(OrderProductCollection $products): void
    {
        $this->products = $products;
    }
}