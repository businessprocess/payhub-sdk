<?php

namespace Payhub\Responses;

use DateTime;

class OrderCreateResponse
{
    protected string $link;

    protected string $checkoutId;

    protected ?int $orderId;

    protected DateTime $dateExpired;

    protected ?string $message;

    public function __construct($params)
    {
        $this->checkoutId = $params['checkout_id'];
        $this->orderId = $params['order_id'];
        $this->link = $params['link'];
        $this->dateExpired = date_create_from_format('Y-m-d H:i:s', $params['date_expired']);
        $this->message = $params['message'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'checkoutId' => $this->getCheckoutId(),
            'orderId' => $this->getOrderId(),
            'link' => $this->getLink(),
            'dateExpired' => $this->getDateExpired(),
            'message' => $this->getMessage(),
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
}
