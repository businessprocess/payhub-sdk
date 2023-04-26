<?php

namespace Payhub\Responses;

use DateTime;

class OrderCreateResponse
{
    protected string $link;
    protected string $checkoutId;
    protected DateTime $dateExpired;
    protected string $message;

    public function __construct($params)
    {
        $this->checkoutId = $params['checkout_id'];
        $this->link = $params['link'];
        $this->dateExpired = date_create_from_format('Y-m-d H:i:s', $params['date_expired']);
        $this->message = $params['message'];
    }

    public function toArray(): array
    {
        return [
            'checkoutId' => $this->getCheckoutId(),
            'link' => $this->getLink(),
            'dateExpired' => $this->getDateExpired(),
            'message' => $this->getMessage(),
        ];
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return DateTime
     */
    public function getDateExpired(): DateTime
    {
        return $this->dateExpired;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getCheckoutId(): string
    {
        return $this->checkoutId;
    }
}