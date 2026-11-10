<?php

namespace Payhub\Models;

use ArgumentCountError;
use GeoService\Support\Collection;

class OrderProductCollection
{
    protected array $items = [];

    public function __construct($params = [])
    {
        foreach ($params as $product) {
            $this->push(new OrderProduct($product));
        }
    }

    public function push(OrderProduct $product): void
    {
        $this->items[] = $product;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function map(callable $callback)
    {
        $keys = array_keys($this->items);

        try {
            $items = array_map($callback, $this->items, $keys);
        } catch (ArgumentCountError) {
            $items = array_map($callback, $this->items);
        }

        $items = array_combine($keys, $items);

        return function_exists('collect') ? collect($items) : new Collection($items);
    }

    public function toArray(): array
    {
        if ($this->count()) {
            return $this->map(fn (OrderProduct $product) => $product->toArray())->toArray();
        }

        throw new \LogicException('Order must contain at least one product');
    }
}
