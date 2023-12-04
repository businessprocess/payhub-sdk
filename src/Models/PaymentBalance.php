<?php

namespace Payhub\Models;

/**
 * @method mixed stripeSkylab()
 * @method mixed stripeMoretime()
 * @method mixed stripeMiraverde()
 */
class PaymentBalance
{
    /**
     * @var array|mixed
     */
    private mixed $balances;

    public function __construct($balances = [])
    {
        $this->balances = $balances ?? [];
    }

    public function toArray(): array
    {
        return $this->balances;
    }

    public function inPercentToArray(): array
    {
        $total = array_sum($this->balances);

        return array_map(function ($balance) use ($total) {
            return $balance / $total * 100;
        }, $this->balances);
    }

    public function getBalance($key)
    {
        return $this->balances[$key] ?? null;
    }

    public function __call($name, $arguments)
    {
        return $this->getBalance(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $name)), '_'));
    }
}
