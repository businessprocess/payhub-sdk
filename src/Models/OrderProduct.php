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

    protected bool $preorder = false;

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

    protected mixed $codeActivationSoftware = null;

    protected ?string $partnerReward = null;

    protected ?array $franchiseFee = null;

    protected ?array $supplements = null;

    protected mixed $vipvipCompanyId = null;

    protected ?array $expirationPeriod = null;

    protected ?bool $autoExtensionBS = null;

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
            'preorder' => $this->isPreorder(),

            'sale_percent' => $this->getSalePercent(),
            'bonus_point' => $this->getBonusPoint(),
            'bonus_personal' => $this->getBonusPersonal(),
            'franchise_fee_vipvip' => $this->isFranchiseFeeVipvip(),
            'franchise_fee' => $this->getFranchiseFee(),
            'partner_reward' => $this->getPartnerReward(),

            'expirationPeriod' => $this->getExpirationPeriod(),
            'autoExtensionBS' => $this->getAutoExtensionBS(),

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
            'code_activation_software' => $this->getCodeActivationSoftware(),
            'supplements' => $this->getSupplements(),
            'vipvipCompanyId' => $this->getVipvipCompanyId(),
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
        if ($preview && ! filter_var($preview, FILTER_VALIDATE_URL)) {
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

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNameFake(): ?string
    {
        return $this->nameFake;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getSale(): mixed
    {
        return $this->sale;
    }

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

    public function isSinglePurchase(): bool
    {
        return $this->singlePurchase;
    }

    public function isUniversalRefill(): bool
    {
        return $this->universalRefill;
    }

    public function getUniversalRefillValue(): mixed
    {
        return $this->universalRefillValue;
    }

    public function isProductBalanceTopUp(): bool
    {
        return $this->productBalanceTopUp;
    }

    public function isBalanceMoney(): bool
    {
        return $this->balanceMoney;
    }

    public function isProductBalanceWellnessTopUp(): bool
    {
        return $this->productBalanceWellnessTopUp;
    }

    public function getBalanceWellnessMoney(): mixed
    {
        return $this->balanceWellnessMoney;
    }

    public function isProductBalanceVipVipTopUp(): bool
    {
        return $this->productBalanceVipVipTopUp;
    }

    public function getBalanceVipVipMoney(): mixed
    {
        return $this->balanceVipVipMoney;
    }

    public function isProductCrowdfunding(): bool
    {
        return $this->productCrowdfunding;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getPaymentsToRepresentive(): mixed
    {
        return $this->paymentsToRepresentive;
    }

    public function getPaymentsToStock(): mixed
    {
        return $this->paymentsToStock;
    }

    public function isAnnualSubscriptionLookMe(): bool
    {
        return $this->annualSubscriptionLookMe;
    }

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

    public function setCodeActivationSoftware(mixed $codeActivationSoftware): static
    {
        $this->codeActivationSoftware = $codeActivationSoftware;

        return $this;
    }

    public function getCodeActivationSoftware(): mixed
    {
        return $this->codeActivationSoftware;
    }

    public function setPartnerReward(?string $partnerReward): static
    {
        $this->partnerReward = $partnerReward;

        return $this;
    }

    public function getPartnerReward(): ?string
    {
        return $this->partnerReward;
    }

    public function getFranchiseFee(): ?array
    {
        return $this->franchiseFee;
    }

    public function setFranchiseFee(?array $franchiseFee): void
    {
        $this->franchiseFee = $franchiseFee;
    }

    public function getSupplements(): ?array
    {
        return $this->supplements;
    }

    public function setSupplements(?array $supplements): void
    {
        $this->supplements = $supplements;
    }

    public function getVipvipCompanyId(): mixed
    {
        return $this->vipvipCompanyId;
    }

    public function setVipvipCompanyId(mixed $vipvipCompanyId): void
    {
        $this->vipvipCompanyId = $vipvipCompanyId;
    }

    public function getExpirationPeriod(): ?array
    {
        return $this->expirationPeriod;
    }

    public function setExpirationPeriod(?array $expirationPeriod): void
    {
        $this->expirationPeriod = $expirationPeriod;
    }

    public function getAutoExtensionBS(): ?bool
    {
        return $this->autoExtensionBS;
    }

    public function setAutoExtensionBS(?bool $autoExtensionBS): void
    {
        $this->autoExtensionBS = $autoExtensionBS;
    }

    public function isPreorder(): bool
    {
        return $this->preorder;
    }

    public function setPreorder(bool $preorder): void
    {
        $this->preorder = $preorder;
    }
}
