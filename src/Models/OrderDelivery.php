<?php

namespace Payhub\Models;

class OrderDelivery extends Base
{
    protected ?string $type = null;

    protected ?string $country = null;

    protected ?string $city = null;

    protected ?string $address = null;

    protected ?string $postCode = null;

    protected mixed $price = null;

    protected ?int $days = null;

    public function toArray(): array
    {
        return [
            'type' => $this->getType(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'address' => $this->getAddress(),
            'postcode' => $this->getPostCode(),
            'price' => $this->getPrice(),
            'days' => $this->getDays(),
        ];
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): static
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getPrice(): mixed
    {
        return $this->price;
    }

    public function setPrice(mixed $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function setDays(?int $days): static
    {
        $this->days = $days;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }
}
