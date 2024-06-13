<?php

namespace Payhub\Models;

class PaymentMethod extends Base
{
    protected mixed $id;

    protected string $title;

    protected string $key;

    protected bool $active;

    protected array $countries;

    protected bool $confirmation;

    protected bool $real_money;

    protected bool $credit;

    protected bool $acquiring;

    protected bool $cashless;

    protected bool $voucher;

    protected bool $cryptocurrency;

    protected string $category;

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'key' => $this->getKey(),
            'active' => $this->isActive(),
            'countries' => $this->getCountries(),
            'confirmation' => $this->isConfirmation(),
            'real_money' => $this->isRealMoney(),
            'credit' => $this->isCredit(),
            'acquiring' => $this->isAcquiring(),
            'cashless' => $this->isCashless(),
            'voucher' => $this->isVoucher(),
            'cryptocurrency' => $this->isCryptocurrency(),
            'category' => $this->getCategory(),
        ];
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function setCountries(array $countries): void
    {
        $this->countries = $countries;
    }

    public function isConfirmation(): bool
    {
        return $this->confirmation;
    }

    public function setConfirmation(bool $confirmation): void
    {
        $this->confirmation = $confirmation;
    }

    public function isRealMoney(): bool
    {
        return $this->real_money;
    }

    public function setRealMoney(bool $real_money): void
    {
        $this->real_money = $real_money;
    }

    public function isCredit(): bool
    {
        return $this->credit;
    }

    public function setCredit(bool $credit): void
    {
        $this->credit = $credit;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function isAcquiring(): bool
    {
        return $this->acquiring;
    }

    public function setAcquiring(bool $acquiring): void
    {
        $this->acquiring = $acquiring;
    }

    public function isCashless(): bool
    {
        return $this->cashless;
    }

    public function setCashless(bool $cashless): void
    {
        $this->cashless = $cashless;
    }

    public function isVoucher(): bool
    {
        return $this->voucher;
    }

    public function setVoucher(bool $voucher): void
    {
        $this->voucher = $voucher;
    }

    public function isCryptocurrency(): bool
    {
        return $this->cryptocurrency;
    }

    public function setCryptocurrency(bool $cryptocurrency): void
    {
        $this->cryptocurrency = $cryptocurrency;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
