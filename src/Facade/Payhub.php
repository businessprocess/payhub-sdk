<?php

namespace Payhub\Facade;

use Illuminate\Support\Facades\Facade;
use Payhub\Models\Order;
use Payhub\Models\PaymentMethod;
use Payhub\Models\PaymentTurnover;
use Payhub\Responses\OrderCreateResponse;
use Payhub\Service\Webhook;

/**
 *  * @method static OrderCreateResponse create(Order $order, bool $fast = false)
 *  * @method static array<Order> getList()
 *  * @method static Order getById(string $id)
 *  * @method static array<PaymentMethod> getPaymentMethods()
 *  * @method static Webhook webhook()
 *  * @method static array check($checkoutId)
 *  * @method static string link($checkoutId)
 *  * @method static PaymentTurnover getTurnover($method = 'stripe')
 */
class Payhub extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Payhub\Service\Payhub::class;
    }
}
