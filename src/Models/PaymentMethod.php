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

    protected string $category;

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
}
