<?php

namespace Payhub\Models;

class OrderProduct extends Base
{
    protected int $productId;
    protected ?string $preview;
    protected string $name;
    protected ?string $nameFake;
    protected string $price;
    protected int $count;
    protected mixed $sale;
    protected bool $isVirtual = false;

    public function toArray(): array
    {
        return [
            'productId' => $this->getProductId(),
            'preview' => $this->getPreview(),
            'name' => $this->getName(),
            'name_fake' => $this->getNameFake(),
            'price' => $this->getPrice(),
            'count' => $this->getCount(),
            'sale' => $this->getSale(),
            'is_virtual' => $this->isVirtual(),
        ];
    }

    public function setProductId(int $productId): static
    {
        $this->productId = $productId;

        return $this;
    }

    public function setIsVirtual(bool $isVirtual): static
    {
        $this->isVirtual = $isVirtual;

        return $this;
    }

    public function setPreview(?string $preview): static
    {
        if ($preview && !filter_var($preview, FILTER_VALIDATE_URL)) {
            throw new \LogicException('Preview must be a url');
        }

        $this->preview = $preview;

        return $this;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function setCount(int $count): static
    {
        if ($count < 1) {
            throw new \LogicException('The number of products cannot be less than zero');
        }
        $this->count = $count;

        return $this;
    }

    public function setSale(mixed $sale): static
    {
        $this->sale = $sale;

        return $this;
    }

    public function setNameFake(?string $nameFake): static
    {
        $this->nameFake = $nameFake;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getNameFake(): ?string
    {
        return $this->nameFake;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getSale(): mixed
    {
        return $this->sale;
    }

    /**
     * @return bool
     */
    public function isVirtual(): bool
    {
        return $this->isVirtual;
    }
}