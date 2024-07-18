<?php

namespace Payhub\Models;

class PaymentMethod extends Base implements \ArrayAccess, \JsonSerializable
{
    protected mixed $id;

    protected string $title;

    protected string $key;

    protected ?string $icon;

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

    protected array $config = [];

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'key' => $this->getKey(),
            'active' => $this->isActive(),
            'icon' => $this->getIcon(),
            'countries' => $this->getCountries(),
            'confirmation' => $this->isConfirmation(),
            'real_money' => $this->isRealMoney(),
            'credit' => $this->isCredit(),
            'acquiring' => $this->isAcquiring(),
            'cashless' => $this->isCashless(),
            'voucher' => $this->isVoucher(),
            'cryptocurrency' => $this->isCryptocurrency(),
            'category' => $this->getCategory(),
            'config' => $this->getConfig(),
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function getConfig($key = null): mixed
    {
        if ($key) {
            return $this->config[$key] ?? null;
        }
        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function getBankAccount(): ?array
    {
        return $this->getConfig('bank_account');
    }

    public function __toArray(): array
    {
        return $this->toArray();
    }

    public function toString(): string
    {
        return $this->getTitle();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function __isset(string $name): bool
    {
        return $this->$name !== null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->__isset($offset);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->$offset;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->$offset = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->$offset = null;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
