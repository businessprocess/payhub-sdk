<?php

namespace Payhub\Facade;

use Illuminate\Support\Facades\Facade;
use Payhub\Models\PaymentMethod;
use Payhub\Responses\OrderCreateResponse;
use Payhub\Models\Order;

/**
 *  * @method static OrderCreateResponse create(Order $order)
 *  * @method static array<Order> getList()
 *  * @method static Order getById(string $id)
 *  * @method static array<PaymentMethod> getPaymentMethods()
 */
class Payhub extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Payhub\Service\Payhub::class;
    }
}