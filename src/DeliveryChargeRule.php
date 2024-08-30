<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

interface DeliveryChargeRule
{
    public function calculateCharge(float $subtotal): float;
}