<?php

namespace Payhub\Models;

use Payhub\Support\Normalizer;

class Order extends Base
{
    protected bool $type = true;
    protected array $paymentMethods = [];
    protected array $payments = [];
    protected mixed $orderId = null;
    protected mixed $total;
    protected mixed $sale = null;
    protected ?string $callbackUrl = null;
    protected ?string $redirectSuccess = null;
    protected ?string $redirectFail = null;
    protected ?string $resource = null;
    protected string $language;
    protected string $date;

    protected mixed $salePercent = null;
    protected ?int $showroomId = null;
    protected ?string $source = null;
    protected ?int $promotionId = null;

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
        return [
            'type' => $this->getType(),
            'payment_methods' => $this->getPaymentMethods(),
            'payments' => $this->getPayments(),
            'order_id' => $this->getOrderId(),
            'total' => $this->getTotal(),
            'sale' => $this->getSale(),
            'date' => $this->getDate(),
            'callback_url' => $this->getCallbackUrl(),
            'redirect_success' => $this->getRedirectSuccess(),
            'redirect_fail' => $this->getRedirectFail(),
            'resource' => $this->getResource(),

            'sale_percent' => $this->getSalePercent(),
            'showroom_id' => $this->getShowroomId(),
            'source' => $this->getSource(),
            'promotion_id' => $this->getPromotionId(),

            'client' => $this->normalize($this->getOrderClient())->toArray(),
            'delivery' => $this->normalize($this->getOrderDelivery())->toArray(),
            'products' => $this->getOrderProducts()->toArray(),
        ];
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

    public function getType(): bool
    {
        return $this->type;
    }

    public function getPaymentMethods(): array
    {
        return $this->paymentMethods;
    }

    public function setPaymentMethods($methods): static
    {
        $this->paymentMethods = is_array($methods) ? $methods : func_get_args();

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
        if (!empty($this->payments)) {
            $total = array_reduce(
                $this->payments,
                fn($carry, $payment) => $carry + (float)$payment['amount'],
                0
            );

            if ($total >= $this->total) {
                throw new \LogicException(
                    'The amount of payments cannot be greater than or equal to the amount of the order'
                );
            }
        }
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
        $this->callbackUrl = $this->isUrl($callbackUrl);

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

    public function setDate(\DateTimeInterface|string $date): static
    {
        $this->date = is_string($date) ? $date : $date->format('Y-m-d H:i:s');

        return $this;
    }

    /**
     * @return OrderClient
     */
    public function getOrderClient(): OrderClient
    {
        return $this->client;
    }

    public function setOrderClient(OrderClient $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return OrderDelivery
     */
    public function getOrderDelivery(): OrderDelivery
    {
        return $this->delivery;
    }

    public function setOrderDelivery(OrderDelivery $delivery): static
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getOrderProducts(): OrderProductCollection
    {
        return $this->products;
    }

    public function setOrderProducts(OrderProductCollection $products): static
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedirectSuccess(): ?string
    {
        return $this->redirectSuccess;
    }

    public function setRedirectSuccess(?string $redirectSuccess): static
    {
        $this->redirectSuccess = $this->isUrl($redirectSuccess);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedirectFail(): ?string
    {
        return $this->redirectFail;
    }

    public function setRedirectFail(?string $redirectFail): static
    {
        $this->redirectFail = $this->isUrl($redirectFail);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(?string $resource): static
    {
        $this->resource = $this->isUrl($resource);

        return $this;
    }

    private function isUrl($url)
    {
        if ($url && !filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \LogicException("Parameter [$url] must be a url");
        }
        return $url;
    }

    /**
     * @return mixed
     */
    public function getSalePercent(): mixed
    {
        return $this->salePercent;
    }

    public function setSalePercent(mixed $salePercent): static
    {
        $this->salePercent = $salePercent;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShowroomId(): ?int
    {
        return $this->showroomId;
    }

    public function setShowroomId(int $showroomId): static
    {
        $this->showroomId = $showroomId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): static
    {
        $this->source = $source;

        return $this;
    }


    public function getPromotionId(): ?int
    {
        return $this->promotionId;
    }

    public function setPromotionId(int $promotionId): static
    {
        $this->promotionId = $promotionId;

        return $this;
    }

    public function setPayments(array $payments): Order
    {
        foreach ($payments as $payment) {
            $this->payments[] = is_array($payment) ? new Payment($payment) : $payment;
        }
        return $this;
    }

    public function getPayments(): array
    {
        return array_map(fn(Payment $payment) => $payment->toArray(), $this->payments);
    }
}