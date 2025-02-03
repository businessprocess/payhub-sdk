<?php

namespace Payhub\Models;

class Payment
{
    public const BALANCE = 'balance';

    public const REAL_BALANCE = 'real_balance';

    public const CASHBACK = 'cashback';

    public const CASHBACK_STORE = 'cashback_store';

    public const BALANCE_SECOND_PAYMENT = 'balance_second_payment';

    public const GATEWAYS = [
        self::BALANCE,
        self::REAL_BALANCE,
        self::CASHBACK,
        self::CASHBACK_STORE,
        self::BALANCE_SECOND_PAYMENT,
    ];

    protected ?string $gateway;

    protected mixed $amount;

    public function __construct($data = [])
    {
        $this->gateway = $data['gateway'] ?? null;
        $this->amount = $data['amount'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'gateway' => $this->getGateway(),
            'amount' => $this->getAmount(),
        ];
    }

    public function getGateway(): ?string
    {
        if (in_array($this->gateway, static::GATEWAYS)) {
            return $this->gateway;
        }
        throw new \InvalidArgumentException("Payment [$this->gateway] not supported");
    }

    public function getAmount(): mixed
    {
        if ($this->amount < 0) {
            throw new \InvalidArgumentException('Payment amount must be more than zero');
        }

        return $this->amount;
    }

    public function setGateway(?string $gateway): Payment
    {
        $this->gateway = $gateway;

        return $this;
    }

    public function setAmount(mixed $amount): Payment
    {
        $this->amount = $amount;

        return $this;
    }
}
