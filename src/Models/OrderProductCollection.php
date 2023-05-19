<?php

namespace Payhub\Models;

use ArgumentCountError;

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

        return collect(array_combine($keys, $items));
    }

    public function toArray(): array
    {
        if ($this->count()) {
            return $this->map(fn (OrderProduct $product) => $product->toArray())->toArray();
        }

        throw new \LogicException('Order must contain at least one product');
    }
}
