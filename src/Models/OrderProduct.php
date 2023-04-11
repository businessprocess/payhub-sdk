<?php

namespace Payhub\Models;

class OrderProduct extends Base
{
    protected int $productId;
    protected ?string $preview = null;
    protected string $name;
    protected ?string $nameFake = null;
    protected ?string $nameKey = null;
    protected string $price;
    protected int $count;
    protected mixed $sale = null;
    protected bool $isVirtual = false;

    protected mixed $salePercent = null;
    protected mixed $bonusPoint = null;
    protected mixed $bonusPersonal = null;
    protected bool $franchiseFeeVipvip = false;

    protected bool $singlePurchase = false;
    protected bool $universalRefill = false;
    protected mixed $universalRefillValue = null;
    protected bool $productBalanceTopUp = false;
    protected bool $balanceMoney = false;
    protected bool $productBalanceWellnessTopUp = false;
    protected mixed $balanceWellnessMoney = null;
    protected bool $productBalanceVipVipTopUp = false;
    protected mixed $balanceVipVipMoney = null;
    protected bool $productCrowdfunding = false;
    protected ?int $balanceCrowdfunding = null;
    protected array $categories = [];
    protected mixed $paymentsToRepresentive = null;
    protected mixed $paymentsToStock = null;
    protected bool $annualSubscriptionLookMe = false;

    public function toArray(): array
    {
        return [
            'product_id' => $this->getProductId(),
            'preview' => $this->getPreview(),
            'name' => $this->getName(),
            'name_fake' => $this->getNameFake(),
            'name_key' => $this->getNameKey(),
            'price' => $this->getPrice(),
            'count' => $this->getCount(),
            'sale' => $this->getSale(),
            'is_virtual' => $this->isVirtual(),

            'sale_percent' => $this->getSalePercent(),
            'bonus_point' => $this->getBonusPoint(),
            'bonus_personal' => $this->getBonusPersonal(),
            'franchise_fee_vipvip' => $this->isFranchiseFeeVipvip(),

            'singlePurchase' => $this->isSinglePurchase(),
            'universalRefill' => $this->isUniversalRefill(),
            'universalRefillValue' => $this->getUniversalRefillValue(),
            'productBalanceTopUp' => $this->isProductBalanceTopUp(),
            'balanceMoney' => $this->isBalanceMoney(),
            'productBalanceWellnessTopUp' => $this->isProductBalanceWellnessTopUp(),
            'balanceWellnessMoney' => $this->getBalanceWellnessMoney(),
            'productBalanceVipVipTopUp' => $this->isProductBalanceVipVipTopUp(),
            'balanceVipVipMoney' => $this->getBalanceVipVipMoney(),
            'productCrowdfunding' => $this->isProductCrowdfunding(),
            'balanceCrowdfunding' => $this->getBalanceCrowdfunding(),
            'categories' => $this->getCategories(),
            'paymentsToRepresentive' => $this->getPaymentsToRepresentive(),
            'paymentsToStock' => $this->getPaymentsToStock(),
            'annualSubscriptionLookMe' => $this->isAnnualSubscriptionLookMe(),
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
    public function getPreview(): ?string
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

    public function setNameKey(?string $nameKey): static
    {
        $this->nameKey = $nameKey;
        return $this;
    }

    public function getNameKey(): ?string
    {
        return $this->nameKey;
    }

    public function setSinglePurchase(bool $singlePurchase = true): static
    {
        $this->singlePurchase = $singlePurchase;
        return $this;
    }

    public function setUniversalRefill(bool $universalRefill = true): static
    {
        $this->universalRefill = $universalRefill;
        return $this;
    }

    public function setUniversalRefillValue(mixed $universalRefillValue): static
    {
        $this->universalRefillValue = $universalRefillValue;
        return $this;
    }

    public function setProductBalanceTopUp(bool $productBalanceTopUp = true): static
    {
        $this->productBalanceTopUp = $productBalanceTopUp;
        return $this;
    }

    public function setBalanceMoney(bool $balanceMoney = true): static
    {
        $this->balanceMoney = $balanceMoney;
        return $this;
    }

    public function setProductBalanceWellnessTopUp(bool $productBalanceWellnessTopUp = true): static
    {
        $this->productBalanceWellnessTopUp = $productBalanceWellnessTopUp;
        return $this;
    }

    public function setBalanceWellnessMoney(mixed $balanceWellnessMoney): static
    {
        $this->balanceWellnessMoney = $balanceWellnessMoney;
        return $this;
    }

    public function setProductBalanceVipVipTopUp(bool $productBalanceVipVipTopUp = true): static
    {
        $this->productBalanceVipVipTopUp = $productBalanceVipVipTopUp;
        return $this;
    }

    public function setBalanceVipVipMoney(mixed $balanceVipVipMoney): static
    {
        $this->balanceVipVipMoney = $balanceVipVipMoney;
        return $this;
    }

    public function setProductCrowdfunding(bool $productCrowdfunding = true): static
    {
        $this->productCrowdfunding = $productCrowdfunding;
        return $this;
    }

    public function setBalanceCrowdfunding(?int $balanceCrowdfunding): static
    {
        $this->balanceCrowdfunding = $balanceCrowdfunding;
        return $this;
    }

    public function setCategories(array $categories): static
    {
        $this->categories = $categories;
        return $this;
    }

    public function setPaymentsToRepresentive(mixed $paymentsToRepresentive): static
    {
        $this->paymentsToRepresentive = $paymentsToRepresentive;
        return $this;
    }

    public function setPaymentsToStock(mixed $paymentsToStock): static
    {
        $this->paymentsToStock = $paymentsToStock;
        return $this;
    }

    public function setAnnualSubscriptionLookMe(bool $annualSubscriptionLookMe = true): static
    {
        $this->annualSubscriptionLookMe = $annualSubscriptionLookMe;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSinglePurchase(): bool
    {
        return $this->singlePurchase;
    }

    /**
     * @return bool
     */
    public function isUniversalRefill(): bool
    {
        return $this->universalRefill;
    }

    /**
     * @return mixed
     */
    public function getUniversalRefillValue(): mixed
    {
        return $this->universalRefillValue;
    }

    /**
     * @return bool
     */
    public function isProductBalanceTopUp(): bool
    {
        return $this->productBalanceTopUp;
    }

    /**
     * @return bool
     */
    public function isBalanceMoney(): bool
    {
        return $this->balanceMoney;
    }

    /**
     * @return bool
     */
    public function isProductBalanceWellnessTopUp(): bool
    {
        return $this->productBalanceWellnessTopUp;
    }

    /**
     * @return mixed
     */
    public function getBalanceWellnessMoney(): mixed
    {
        return $this->balanceWellnessMoney;
    }

    /**
     * @return bool
     */
    public function isProductBalanceVipVipTopUp(): bool
    {
        return $this->productBalanceVipVipTopUp;
    }

    /**
     * @return mixed
     */
    public function getBalanceVipVipMoney(): mixed
    {
        return $this->balanceVipVipMoney;
    }

    /**
     * @return bool
     */
    public function isProductCrowdfunding(): bool
    {
        return $this->productCrowdfunding;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getPaymentsToRepresentive(): mixed
    {
        return $this->paymentsToRepresentive;
    }

    /**
     * @return mixed
     */
    public function getPaymentsToStock(): mixed
    {
        return $this->paymentsToStock;
    }

    /**
     * @return bool
     */
    public function isAnnualSubscriptionLookMe(): bool
    {
        return $this->annualSubscriptionLookMe;
    }

    /**
     * @return int|null
     */
    public function getBalanceCrowdfunding(): ?int
    {
        return $this->balanceCrowdfunding;
    }

    public function setSalePercent(mixed $salePercent): static
    {
        $this->salePercent = $salePercent;
        return $this;
    }

    public function setBonusPoint(mixed $bonusPoint): static
    {
        $this->bonusPoint = $bonusPoint;
        return $this;
    }

    public function setBonusPersonal(mixed $bonusPersonal): static
    {
        $this->bonusPersonal = $bonusPersonal;
        return $this;
    }

    public function setFranchiseFeeVipvip(bool $franchiseFeeVipvip = true): static
    {
        $this->franchiseFeeVipvip = $franchiseFeeVipvip;
        return $this;
    }

    public function getSalePercent(): mixed
    {
        return $this->salePercent;
    }

    public function getBonusPoint(): mixed
    {
        return $this->bonusPoint;
    }

    public function getBonusPersonal(): mixed
    {
        return $this->bonusPersonal;
    }

    public function isFranchiseFeeVipvip(): bool
    {
        return $this->franchiseFeeVipvip;
    }
}
