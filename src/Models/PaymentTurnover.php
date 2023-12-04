<?php

namespace Payhub\Models;

/**
 * @method mixed stripeSkylab()
 * @method mixed stripeMoretime()
 * @method mixed stripeMiraverde()
 */
class PaymentTurnover
{
    /**
     * @var array|mixed
     */
    private mixed $turnover;

    public function __construct($turnover = [])
    {
        $this->turnover = $turnover ?? [];
    }

    public function toArray(): array
    {
        return $this->turnover;
    }

    public function inPercentToArray(): array
    {
        $total = array_sum($this->turnover);

        return array_map(function ($balance) use ($total) {
            return $balance / $total * 100;
        }, $this->turnover);
    }

    public function getTurnover($key)
    {
        return $this->turnover[$key] ?? null;
    }

    public function __call($name, $arguments)
    {
        return $this->getTurnover(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $name)), '_'));
    }
}
