<?php

namespace Payhub\Models;

class OrderClient extends Base
{
    protected string $firstName;
    protected string $secondName;
    protected string $email;
    protected string $phone;
    protected string $country;
    protected ?string $city = null;
    protected ?string $address = null;
    protected ?string $postCode = null;

    public function toArray(): array
    {
        return [
            'firstname' => $this->getFirstName(),
            'secondname' => $this->getSecondName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'address' => $this->getAddress(),
            'postcode' => $this->getPostCode(),
        ];
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): static
    {
        $this->secondName = $secondName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
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
}
