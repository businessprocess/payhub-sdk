<?php

namespace Payhub\Responses;

use DateTime;

class OrderCreateResponse
{
    public const STATUS_PAID = 1;

    protected string $link;

    protected string $checkoutId;

    protected array $checkoutData = [];

    protected array $paymentData = [];

    protected int $status;

    protected ?int $orderId;

    protected DateTime $dateExpired;

    protected ?string $message;

    protected array $payment = [];

    public function __construct($params)
    {
        $this->checkoutId = $params['checkout_id'];
        $this->orderId = $params['order_id'];
        $this->link = $params['link'];
        $this->dateExpired = date_create_from_format('Y-m-d H:i:s', $params['date_expired']);
        $this->message = $params['message'] ?? null;
        $this->checkoutData = $params['checkout_data'] ?? [];
        $this->paymentData = $params['payment_data'] ?? [];
        $this->status = $params['status'] ?? 0;
        $this->payment = $params['payment'] ?? [];
    }

    public function toArray(): array
    {
        return [
            'checkoutId' => $this->getCheckoutId(),
            'orderId' => $this->getOrderId(),
            'checkout_data' => $this->getCheckoutData(),
            'payment_data' => $this->getPaymentData(),
            'status' => $this->getStatus(),
            'link' => $this->getLink(),
            'dateExpired' => $this->getDateExpired(),
            'message' => $this->getMessage(),
            'payment' => $this->getPayment(),
        ];
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getDateExpired(): DateTime
    {
        return $this->dateExpired;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getCheckoutId(): string
    {
        return $this->checkoutId;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function getCheckoutData(): array
    {
        return $this->checkoutData;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function isPaid(): bool
    {
        return (int) $this->getStatus() === static::STATUS_PAID;
    }

    public function getPaymentData(): array
    {
        return $this->paymentData;
    }

    public function getPayment(): array
    {
        return $this->payment;
    }

    public function getPaymentAmount()
    {
        return $this->payment['amount'] ?? null;
    }

    public function getPaymentRate()
    {
        return $this->payment['rate'] ?? null;
    }

    public function getPaymentCurrencyCode()
    {
        return $this->payment['currency_code'] ?? null;
    }
}
